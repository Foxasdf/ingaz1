<?php

namespace Database\Factories;

use App\Models\AccountTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountTypes>
 */
class AccountTypesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AccountTypes::class;

    public function definition(): array
    {
        $types = ['زبون', 'مكتب', 'مورد', 'موظف'];

        return [
            'النوع' => $this->faker->randomElement($types),
        ];
    }
}
