<?php

namespace Database\Seeders;

use App\Models\AccountTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined types
        $predefinedTypes = ['زبون', 'مكتب', 'مورد', 'موظف'];

        // Create predefined types
        foreach ($predefinedTypes as $type) {
            AccountTypes::create(['النوع' => $type]);
        }
    }
}
