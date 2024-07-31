<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountTypes;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have AccountTypes
        if (AccountTypes::count() == 0) {
            $this->call(AccountTypesSeeder::class);
        }

        // Create 10 accounts without orders
        Account::factory()
            ->count(10)
            ->create();

        // Create 5 accounts, each with 3 orders
        Account::factory()
            ->has(Order::factory()->count(3))
            ->count(5)
            ->create();

        // Create accounts for each AccountType
        AccountTypes::all()->each(function ($accountType) {
            Account::factory()
                ->count(3)
                ->create(['account_types_id' => $accountType->id]);
        });
    }
}
