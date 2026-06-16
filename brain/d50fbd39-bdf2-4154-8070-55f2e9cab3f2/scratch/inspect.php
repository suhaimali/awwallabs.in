<?php
// Bootstrap Laravel
require __DIR__ . '/../../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LabTest;
use App\Models\TestParameter;
use App\Models\ReferenceInterval;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;

$tables = [
    'categories' => Category::class,
    'sub_categories' => SubCategory::class,
    'lab_tests' => LabTest::class,
    'test_parameters' => TestParameter::class,
    'reference_intervals' => ReferenceInterval::class,
    'units' => Unit::class,
];

echo "=== DATABASE SEEDING SUMMARY ===\n";
foreach ($tables as $name => $class) {
    $count = $class::count();
    echo "Table '$name' count: $count\n";
}

echo "\n--- Sample Lab Test with parameter and reference intervals ---\n";
$test = LabTest::with(['parameter', 'referenceIntervals'])->whereHas('parameter', function($q) {
    $q->whereNotNull('male_min')->orWhereNotNull('male_max');
})->first();
if ($test) {
    echo "Test Name: {$test->name}\n";
    echo "Price: {$test->price}\n";
    echo "Description: {$test->description}\n";
    if ($test->parameter) {
        echo "Parameter Unit: {$test->parameter->unit}\n";
        echo "Male Range: {$test->parameter->male_reference} (Min: {$test->parameter->male_min}, Max: {$test->parameter->male_max})\n";
        echo "Female Range: {$test->parameter->female_reference} (Min: {$test->parameter->female_min}, Max: {$test->parameter->female_max})\n";
    }
    echo "Reference Intervals Count: " . $test->referenceIntervals->count() . "\n";
    foreach ($test->referenceIntervals as $interval) {
        echo "  - Gender: {$interval->gender} | Age: {$interval->age_min}-{$interval->age_max} {$interval->age_type} | Range: {$interval->reference_text} (Min: {$interval->min_value}, Max: {$interval->max_value})\n";
    }
} else {
    echo "No tests with parameters found!\n";
}

echo "\n--- Sample Parent Lab Test (Multi-detail) ---\n";
// Find a test that represents a multi-detail group, e.g. CBC
$cbcParent = LabTest::where('name', 'CBC')->first();
if ($cbcParent) {
    echo "Parent Test: {$cbcParent->name} | Price: {$cbcParent->price}\n";
    $children = LabTest::where('description', 'like', 'Part of ' . $cbcParent->name)->get();
    echo "Child Particulars Count: " . $children->count() . "\n";
    foreach ($children->take(5) as $child) {
        echo "  - {$child->name} (Price: {$child->price})\n";
    }
} else {
    echo "CBC Parent not found.\n";
}

echo "\n--- Checking Category & Subcategory Listings ---\n";
$cats = Category::with('subCategories')->limit(5)->get();
foreach ($cats as $cat) {
    echo "Category: {$cat->name} (Subcategories: " . $cat->subCategories->pluck('name')->implode(', ') . ")\n";
}
