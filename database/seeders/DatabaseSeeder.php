<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountTypes;
use App\Models\Order;
use App\Models\Passport;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AccountTypesSeeder::class,
            AccountSeeder::class,
            OrderSeeder::class,
            PassportSeeder::class,
            CoinSeeder::class,
            CalculationSeeder::class,
            
        ]);
    }
}
