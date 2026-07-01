<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\LabTest;
use App\Models\TestParameter;
use App\Models\ReferenceInterval;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;

class CsvDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Truncate tests, parameters, and intervals for a clean, idempotent run
        Schema::disableForeignKeyConstraints();
        \App\Models\ReportTemplateItem::truncate();
        \App\Models\ReportTemplate::truncate();
        ReferenceInterval::truncate();
        TestParameter::truncate();
        LabTest::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Parse CSV files safely using helper
        $masters = $this->parseCsv(base_path('data/tbl_lab_test_master.csv'));
        $details = $this->parseCsv(base_path('data/tbl_lab_test_details_master.csv'));

        // 3. Group detail rows by lab_test_id
        $detailsByMaster = [];
        foreach ($details as $detail) {
            $masterId = $detail['lab_test_id'] ?? '';
            if ($masterId !== '' && $masterId !== '0') {
                $detailsByMaster[$masterId][] = $detail;
            }
        }

        // 4. Track master IDs to find orphans
        $masterIds = [];
        foreach ($masters as $master) {
            if (!empty($master['id'])) {
                $masterIds[$master['id']] = true;
            }
        }

        // 5. Process master tests
        foreach ($masters as $master) {
            $masterId = $master['id'] ?? null;
            $testDesc = trim($master['test_description'] ?? '');
            $reportHead = trim($master['report_head'] ?? '');
            
            // Determine test name
            $testName = $testDesc !== '' ? $testDesc : ($reportHead !== '' ? $reportHead : 'Unknown Test');
            
            // Clean charges/prices
            $charges = trim($master['test_charges'] ?? '');
            $total = trim($master['total_amount'] ?? '');
            $price = 0.00;
            if ($total !== '' && strtolower($total) !== 'null') {
                $price = (float)$total;
            } elseif ($charges !== '' && strtolower($charges) !== 'null') {
                $price = (float)$charges;
            }

            // Get or create Category and Subcategory (to populate lookup tables)
            $this->getOrCreateCategory($reportHead, $master['report_sub_head'] ?? null);

            $masterDetails = $detailsByMaster[$masterId] ?? [];
            $detailCount = count($masterDetails);

            if ($detailCount === 0) {
                // Case A: No details - Simple billing test
                LabTest::create([
                    'name' => $testName,
                    'price' => $price,
                    'description' => $testDesc !== '' ? $testDesc : null,
                    'payment_method' => 'Cash'
                ]);
            } elseif ($detailCount === 1) {
                // Case B: 1 detail - Merge master and detail
                $detail = $masterDetails[0];
                $labTest = LabTest::create([
                    'name' => $testName,
                    'price' => $price,
                    'description' => $testDesc !== '' ? $testDesc : null,
                    'payment_method' => 'Cash'
                ]);
                $this->createParameterAndIntervals($labTest, $detail);
            } else {
                // Case C: Multiple details - Parent test + Child tests
                // Parent billing test
                $parentTest = LabTest::create([
                    'name' => $testName,
                    'price' => $price,
                    'description' => $testDesc !== '' ? $testDesc : null,
                    'payment_method' => 'Cash'
                ]);

                // Create a ReportTemplate for this group of tests automatically
                $template = \App\Models\ReportTemplate::firstOrCreate(
                    ['name' => $testName],
                    ['description' => $testDesc !== '' ? $testDesc : 'Auto-generated template from CSV data file']
                );

                // Detail tests (particulars)
                $sortOrder = 1;
                foreach ($masterDetails as $detail) {
                    $particularName = trim($detail['test_particulars'] ?? '');
                    if ($particularName === '' || strtolower($particularName) === 'null') {
                        continue;
                    }

                    $childTest = LabTest::create([
                        'name' => $particularName,
                        'price' => 0.00,
                        'description' => "Part of " . $parentTest->name,
                        'payment_method' => 'Cash'
                    ]);
                    $this->createParameterAndIntervals($childTest, $detail);

                    // Add to ReportTemplate
                    $unitVal = trim($detail['units'] ?? '');
                    $maleRef = trim($detail['male_value'] ?? '');
                    $femaleRef = trim($detail['female_value'] ?? '');
                    $refRange = $maleRef;
                    if ($femaleRef && $maleRef !== $femaleRef) {
                        $refRange = "M: $maleRef, F: $femaleRef";
                    } elseif ($femaleRef) {
                        $refRange = $femaleRef;
                    }

                    \App\Models\ReportTemplateItem::create([
                        'report_template_id' => $template->id,
                        'lab_test_id' => $childTest->id,
                        'name' => $childTest->name,
                        'category' => $reportHead !== '' ? $reportHead : 'General',
                        'subcategory' => trim($master['report_sub_head'] ?? ''),
                        'unit' => ($unitVal === 'NULL' || $unitVal === '') ? null : $unitVal,
                        'normal_value' => ($refRange === 'NULL' || $refRange === '') ? null : $refRange,
                        'biological_reference' => ($refRange === 'NULL' || $refRange === '') ? null : $refRange,
                        'sort_order' => $sortOrder++
                    ]);
                }
            }
        }

        // 6. Process orphaned detail rows (lab_test_id = 0 or invalid)
        $orphanedCount = 0;
        foreach ($details as $detail) {
            $masterId = $detail['lab_test_id'] ?? '';
            if ($masterId === '0' || $masterId === '' || !isset($masterIds[$masterId])) {
                $particularName = trim($detail['test_particulars'] ?? '');
                if ($particularName === '' || strtolower($particularName) === 'null') {
                    continue;
                }

                // Ensure "General" category exists
                $this->getOrCreateCategory('General');

                $orphanTest = LabTest::create([
                    'name' => $particularName,
                    'price' => 0.00,
                    'description' => 'Orphaned parameter',
                    'payment_method' => 'Cash'
                ]);
                $this->createParameterAndIntervals($orphanTest, $detail);
                $orphanedCount++;
            }
        }
    }

    /**
     * Parse CSV safely handling linebreaks in quotes
     */
    private function parseCsv(string $filePath): array
    {
        $rows = [];
        if (($handle = fopen($filePath, 'r')) !== FALSE) {
            $headers = fgetcsv($handle);
            if ($headers && count($headers) > 0) {
                // Trim UTF-8 BOM if present
                $headers[0] = preg_replace('/^[\x{FEFF}\x{FFFE}\x{EFBB}\x{BF}]/u', '', $headers[0]);
                $headers = array_map('trim', $headers);
            }
            while (($data = fgetcsv($handle)) !== FALSE) {
                $data = array_map('trim', $data);
                if (count($data) < count($headers)) {
                    $data = array_pad($data, count($headers), '');
                } else if (count($data) > count($headers)) {
                    $data = array_slice($data, 0, count($headers));
                }
                $rows[] = array_combine($headers, $data);
            }
            fclose($handle);
        }
        return $rows;
    }

    /**
     * Get or create Category and Subcategory dynamically
     */
    private function getOrCreateCategory(string $categoryName, ?string $subcategoryName = null): void
    {
        $categoryName = trim($categoryName);
        if ($categoryName === '' || strtolower($categoryName) === 'null') {
            $categoryName = 'General';
        }
        
        $category = Category::firstOrCreate(['name' => $categoryName]);
        
        if ($subcategoryName !== null) {
            $subcategoryName = trim($subcategoryName);
            if ($subcategoryName !== '' && strtolower($subcategoryName) !== 'null') {
                SubCategory::firstOrCreate([
                    'name' => $subcategoryName,
                    'category_id' => $category->id
                ]);
            }
        }
    }

    /**
     * Create parameter and reference interval models for a test
     */
    private function createParameterAndIntervals(LabTest $labTest, array $detail): void
    {
        $unitVal = trim($detail['units'] ?? '');
        if ($unitVal === 'NULL' || $unitVal === '') {
            $unitVal = null;
        } else {
            Unit::firstOrCreate(['name' => $unitVal]);
        }
        
        $maleRef = trim($detail['male_value'] ?? '');
        if ($maleRef === 'NULL' || $maleRef === '') $maleRef = null;
        
        $femaleRef = trim($detail['female_value'] ?? '');
        if ($femaleRef === 'NULL' || $femaleRef === '') $femaleRef = null;
        
        $maleRange = $this->parseRangeValue($maleRef);
        $femaleRange = $this->parseRangeValue($femaleRef);
        
        TestParameter::create([
            'lab_test_id' => $labTest->id,
            'unit' => $unitVal,
            'male_reference' => $maleRef,
            'female_reference' => $femaleRef,
            'male_min' => $maleRange['min'],
            'male_max' => $maleRange['max'],
            'female_min' => $femaleRange['min'],
            'female_max' => $femaleRange['max'],
            'is_immunoassay' => 0
        ]);
        
        if ($maleRef !== null) {
            ReferenceInterval::create([
                'lab_test_id' => $labTest->id,
                'gender' => 'Male',
                'age_min' => 0,
                'age_max' => 200,
                'age_type' => 'Years',
                'reference_text' => $maleRef,
                'min_value' => $maleRange['min'],
                'max_value' => $maleRange['max']
            ]);
        }
        
        if ($femaleRef !== null) {
            ReferenceInterval::create([
                'lab_test_id' => $labTest->id,
                'gender' => 'Female',
                'age_min' => 0,
                'age_max' => 200,
                'age_type' => 'Years',
                'reference_text' => $femaleRef,
                'min_value' => $femaleRange['min'],
                'max_value' => $femaleRange['max']
            ]);
        }
    }

    /**
     * Parse numeric range min/max values from range string
     */
    private function parseRangeValue(?string $val): array
    {
        if ($val === null || trim($val) === '' || strtolower(trim($val)) === 'null') {
            return ['min' => null, 'max' => null];
        }
        $val = trim($val);
        
        // Match standard min-max range (e.g. 13.5-18.0)
        if (preg_match('/^([0-9\.]+)\s*-\s*([0-9\.]+)$/', $val, $matches)) {
            return [
                'min' => (float)$matches[1],
                'max' => (float)$matches[2]
            ];
        }
        
        // Match less-than range (e.g. <5.0)
        if (preg_match('/^<\s*([0-9\.]+)$/', $val, $matches)) {
            return [
                'min' => null,
                'max' => (float)$matches[1]
            ];
        }
        
        // Match greater-than range (e.g. >10.0)
        if (preg_match('/^>\s*([0-9\.]+)$/', $val, $matches)) {
            return [
                'min' => (float)$matches[1],
                'max' => null
            ];
        }
        
        return ['min' => null, 'max' => null];
    }
}
