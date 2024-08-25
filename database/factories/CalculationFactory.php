<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\AccountTypes;
use App\Models\Calculation;
use App\Models\Coin;
use App\Models\Passport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\calculation>
 */
class CalculationFactory extends Factory
{
    protected $model = \App\Models\Calculation::class;

    public function definition()
    {
        $this->faker = \Faker\Factory::create('ar_SA');
    
        $dainAccount = Account::inRandomOrder()->first();
        $madinAccount = Account::where('id', '!=', $dainAccount->id)->inRandomOrder()->first();
    
        $dainAccountType = AccountTypes::find($dainAccount->account_types_id);
        $madinAccountType = AccountTypes::find($madinAccount->account_types_id);
    
        $passport = Passport::inRandomOrder()->first();
        $coin = Coin::inRandomOrder()->first();
    
        return [
            'is_second_entry' => false,
            'دائن' => $dainAccount->id,
            'مدين' => $madinAccount->id,
            'رصيد_الدائن' => $this->faker->numberBetween(1000, 9999),
            'رصيد_المدين' => $this->faker->numberBetween(1000, 9999),
            'البيان' => $this->faker->sentence(),
            'نوع_الحساب_دائن' => $dainAccountType->id,
            'نوع_الحساب_مدين' => $madinAccountType->id,
            'passport_id' => $passport->id,
            'coin_id' => $coin->id,
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}