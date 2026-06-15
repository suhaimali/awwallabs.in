<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            [
                'name' => 'Complete Blood Count (CBC)',
                'unit' => 'mg/dL',
                'male_reference' => '70 - 100',
                'female_reference' => '70 - 100',
                'biological_reference' => '70 - 100',
                'male_min' => 70,
                'male_max' => 100,
                'female_min' => 70,
                'female_max' => 100,
                'critical_low' => 50,
                'critical_high' => 400,
                'is_immunoassay' => false,
            ],
            [
                'name' => 'Hemoglobin',
                'unit' => 'g/dL',
                'male_reference' => '13.0 - 17.0',
                'female_reference' => '12.0 - 15.0',
                'biological_reference' => '12.0 - 17.0',
                'male_min' => 13.0,
                'male_max' => 17.0,
                'female_min' => 12.0,
                'female_max' => 15.0,
                'critical_low' => 7.0,
                'critical_high' => 20.0,
                'is_immunoassay' => false,
            ],
            [
                'name' => 'Liver Function Test (LFT)',
                'unit' => 'IU/L',
                'male_reference' => '10 - 40',
                'female_reference' => '10 - 40',
                'biological_reference' => '10 - 40',
                'male_min' => 10,
                'male_max' => 40,
                'female_min' => 10,
                'female_max' => 40,
                'critical_low' => null,
                'critical_high' => 100,
                'is_immunoassay' => true,
            ]
        ];

        foreach ($parameters as $param) {
            $name = $param['name'];
            unset($param['name']);
            
            $labTest = \App\Models\LabTest::create([
                'name' => $name,
                'price' => rand(100, 1000),
                'description' => 'Dummy Lab Test',
            ]);
            
            $param['lab_test_id'] = $labTest->id;
            \App\Models\TestParameter::create($param);
        }
    }
}
