<?php

namespace Database\Seeders;

use App\Models\coin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create some predefined coins
        $predefinedCoins = [
            ['coin' => 'USD', 'coin_price' => 100],
            ['coin' => 'EUR', 'coin_price' => 120],
            ['coin' => 'GBP', 'coin_price' => 140],
            ['coin' => 'JPY', 'coin_price' => 1],
        ];

        foreach ($predefinedCoins as $coin) {
            coin::create($coin);
        }

        // Create additional random coins
        Coin::factory()->count(6)->create();
    }
}
