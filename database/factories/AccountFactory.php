<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\AccountTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['ماجد', 'ايمن', 'خالد', 'محمد', 'احمد', 'فاطمة', 'مريم']; // Add more names as needed

        return [
            'الاسم' => $this->faker->randomElement($names),
            'رقم الهاتف' => $this->faker->numberBetween(0, 90000000),
            'العنوان' => $this->faker->sentence(),
            'account_types_id' => function () {
                return AccountTypes::inRandomOrder()->first()->id;
            },
        ];
    }
}