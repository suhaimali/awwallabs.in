<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use App\Models\FlagTemplate;
use App\Models\ReferenceTemplate;
use App\Models\ResultTemplate;
use App\Models\LabTest;
use App\Models\TestParameter;
use App\Models\ReferenceInterval;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Secure Admin User
        User::updateOrCreate(
            ['email' => 'lab@gmail.com'],
            [
                'name' => 'Safwan',
                'password' => '12345678', // Auto-hashed via User model cast
            ]
        );
    }
}
