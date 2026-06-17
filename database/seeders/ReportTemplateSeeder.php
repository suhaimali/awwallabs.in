<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReportTemplate;
use App\Models\LabTest;

class ReportTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. CBC Template
        $cbc = ReportTemplate::updateOrCreate(
            ['name' => 'Complete Blood Count (CBC)'],
            ['description' => 'Standard hemogram profile with basic blood cell indices']
        );
        $cbc->items()->delete();

        $cbcParams = [
            ['name' => 'Hemoglobin', 'category' => 'HEMATOLOGY', 'subcategory' => 'CBC Particulars', 'unit' => 'g/dl'],
            ['name' => 'RBC Count', 'category' => 'HEMATOLOGY', 'subcategory' => 'CBC Particulars', 'unit' => 'm/ul'],
            ['name' => 'WBC Count', 'category' => 'HEMATOLOGY', 'subcategory' => 'CBC Particulars', 'unit' => '/ul'],
            ['name' => 'Platelet Count', 'category' => 'HEMATOLOGY', 'subcategory' => 'CBC Particulars', 'unit' => '/ul'],
        ];

        foreach ($cbcParams as $idx => $param) {
            $test = LabTest::where('name', 'like', '%' . $param['name'] . '%')->first();
            $cbc->items()->create([
                'lab_test_id' => $test?->id,
                'category' => $param['category'],
                'subcategory' => $param['subcategory'],
                'name' => $test ? $test->name : $param['name'],
                'unit' => $param['unit'],
                'normal_value' => $test?->parameter?->male_reference,
                'biological_reference' => $test?->parameter?->biological_reference,
                'sort_order' => $idx,
            ]);
        }

        // 2. Lipid Profile Template
        $lipid = ReportTemplate::updateOrCreate(
            ['name' => 'Lipid Profile (Fasting)'],
            ['description' => 'Cardiovascular risk assessment lipid panel']
        );
        $lipid->items()->delete();

        $lipidParams = [
            ['name' => 'Total Cholesterol', 'category' => 'LIPID PROFILE', 'unit' => 'mg/dl'],
            ['name' => 'Triglycerides', 'category' => 'LIPID PROFILE', 'unit' => 'mg/dl'],
            ['name' => 'HDL Cholesterol', 'category' => 'LIPID PROFILE', 'unit' => 'mg/dl'],
            ['name' => 'LDL Cholesterol', 'category' => 'LIPID PROFILE', 'unit' => 'mg/dl'],
        ];

        foreach ($lipidParams as $idx => $param) {
            $test = LabTest::where('name', 'like', '%' . $param['name'] . '%')->first();
            $lipid->items()->create([
                'lab_test_id' => $test?->id,
                'category' => $param['category'],
                'subcategory' => null,
                'name' => $test ? $test->name : $param['name'],
                'unit' => $param['unit'],
                'normal_value' => $test?->parameter?->male_reference,
                'biological_reference' => $test?->parameter?->biological_reference,
                'sort_order' => $idx,
            ]);
        }

        // 3. Thyroid Profile Template
        $thyroid = ReportTemplate::updateOrCreate(
            ['name' => 'Thyroid Profile (T3, T4, TSH)'],
            ['description' => 'Basic thyroid function screening panel']
        );
        $thyroid->items()->delete();

        $thyroidParams = [
            ['name' => 'T3', 'category' => 'ENDOCRINOLOGY', 'unit' => 'ng/dl'],
            ['name' => 'T4', 'category' => 'ENDOCRINOLOGY', 'unit' => 'ug/dl'],
            ['name' => 'TSH', 'category' => 'ENDOCRINOLOGY', 'unit' => 'uIU/ml'],
        ];

        foreach ($thyroidParams as $idx => $param) {
            $test = LabTest::where('name', 'TSH')
                ->orWhere('name', 'like', '%Thyroid Stimulating%')
                ->orWhere('name', 'T3')
                ->orWhere('name', 'T4')
                ->where('name', 'like', '%' . $param['name'] . '%')
                ->first();
            
            $thyroid->items()->create([
                'lab_test_id' => $test?->id,
                'category' => $param['category'],
                'subcategory' => null,
                'name' => $test ? $test->name : $param['name'],
                'unit' => $param['unit'],
                'normal_value' => $test?->parameter?->male_reference,
                'biological_reference' => $test?->parameter?->biological_reference,
                'sort_order' => $idx,
            ]);
        }
    }
}
