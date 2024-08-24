<?php

namespace Database\Factories;

use App\Models\coin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\coin>
 */
class CoinFactory extends Factory
{
    protected $model = coin::class;

    public function definition()
    {
        return [
            'coin' => $this->faker->unique()->currencyCode(),
            'coin_price' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
