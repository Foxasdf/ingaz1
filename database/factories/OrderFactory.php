<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('ar_SA');
        $names=['صالح السالم','أبو جراح','أبو عدي','عبد الرحمن','ماجد ','أبو علاء','أبو غازي'];
        $des=['سعودية','لبنان','عمان','تركيا'];
        $type=['زيارة عائلية','حج','عمرة'];
        $count=['مرة','عدة مرات','ذهاب وأياب'];
        $status=['تحت التنفيذ','منتهي'];
        return [       
            'account_id'=> Account::inRandomOrder()->first()?->id,
            'اسم الزبون'=> fake()->randomElement($names),
             'وجهة السفر'=>fake()->randomElement($des),
             'نوع التأشير'=>fake()->randomElement( $type),
           'عدد مرات الدخول'=>fake()->randomElement( $count),
           'الحالة'=>fake()->randomElement( $status),
        ];
    }
}
