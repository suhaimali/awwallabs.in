<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labTest = \App\Models\LabTest::first();

        if (!$labTest) {
            $labTest = \App\Models\LabTest::create([
                'name' => 'Complete Blood Count (CBC) - RI',
                'price' => 500,
                'description' => 'Dummy Lab Test for RI',
            ]);
        }

        $intervals = [
            [
                'lab_test_id' => $labTest->id,
                'gender' => 'Male',
                'age_min' => 18,
                'age_max' => 60,
                'age_type' => 'Years',
                'reference_text' => 'Normal adult male',
                'min_value' => 13.5,
                'max_value' => 17.5,
            ],
            [
                'lab_test_id' => $labTest->id,
                'gender' => 'Female',
                'age_min' => 18,
                'age_max' => 60,
                'age_type' => 'Years',
                'reference_text' => 'Normal adult female',
                'min_value' => 12.0,
                'max_value' => 15.5,
            ],
            [
                'lab_test_id' => $labTest->id,
                'gender' => 'Both',
                'age_min' => 1,
                'age_max' => 12,
                'age_type' => 'Months',
                'reference_text' => 'Infants',
                'min_value' => 11.0,
                'max_value' => 14.0,
            ],
        ];

        foreach ($intervals as $interval) {
            \App\Models\ReferenceInterval::create($interval);
        }
    }
}
