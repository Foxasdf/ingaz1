<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Order;
use App\Models\Passport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(50)->create();
        Order::factory()
            ->has(Passport::factory()->count(4))
            ->create();


    }
}
