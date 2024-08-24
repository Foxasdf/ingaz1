<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\AccountTypes;
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
        if (!$dainAccount) {
            throw new \Exception('No accounts found in the database.');
        }

        $madinAccount = Account::where('id', '!=', $dainAccount->id)->inRandomOrder()->first();
        if (!$madinAccount) {
            throw new \Exception('Not enough accounts in the database. At least two are required.');
        }

        // Debug information
        Log::info('Dain Account:', ['id' => $dainAccount->id, 'account_types_id' => $dainAccount->account_types_id]);
        Log::info('Madin Account:', ['id' => $madinAccount->id, 'account_types_id' => $madinAccount->account_types_id]);

        $dainAccountType = AccountTypes::find($dainAccount->account_types_id);
        $madinAccountType = AccountTypes::find($madinAccount->account_types_id);

        if (!$dainAccountType || !$madinAccountType) {
            Log::error('Account type not found', [
                'dain_account_type_id' => $dainAccount->account_types_id,
                'madin_account_type_id' => $madinAccount->account_types_id,
                'dain_account_type' => $dainAccountType,
                'madin_account_type' => $madinAccountType
            ]);
            throw new \Exception('Account type not found for one or both accounts.');
        }

        $amount = $this->faker->numberBetween(1, 1000000);

        $passport = Passport::inRandomOrder()->first();
        if (!$passport) {
            throw new \Exception('No passports found in the database.');
        }

        $coin = Coin::inRandomOrder()->first();
        if (!$coin) {
            throw new \Exception('No coins found in the database.');
        }

        return [
            'is_second_entry' => false,
            'دائن' => $dainAccount->id,
            'مدين' => $madinAccount->id,
            'رصيد_الدائن'=>$this->faker->numberBetween(1000, 9999),
            'رصيد_المدين'=>$this->faker->numberBetween(1000, 9999),
            'البيان' => $this->faker->sentence(),
            'رقم_السجل_الاساسي' => $this->faker->unique()->numberBetween(1000, 9999),          
            'نوع_الحساب_دائن' => $dainAccountType->id,
            'نوع_الحساب_مدين' => $madinAccountType->id,
            'passport_id' => $passport->id,
            'coin_id' => $coin->id,
        ];
    }

    // ... rest of the class remains the same
}