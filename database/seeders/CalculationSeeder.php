<?php

namespace Database\Seeders;

use App\Models\calculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calculation::factory()->count(25)->create();
    }
}
