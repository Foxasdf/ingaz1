<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Passport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['استلام الجواز من الزبون', 'رفع موافقة', 'له موافقة', 'سافر', 'بصمة', 'تم التنغيذ', 'مرفوض'];

        return [
            'الحالة' => fake()->randomElement($types),
            'الاسم' => fake()->name(),
            'order_id' => Order::inRandomOrder()->first()?->id,
            'رقم الجواز' => fake()->numberBetween(0, 900000000),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    // public function configure()
    // {
    //     return $this->afterCreating(function (Passport $passport) {
    //         $dummyImagePath = public_path('dummy-passport-photo/dummy-passport-photo.jpg');

    //         try {
    //             $passport->addMedia($dummyImagePath)
    //                 ->preservingOriginal()
    //                 ->toMediaCollection('passport_photos');
    //         } catch (FileDoesNotExist $e) {
    //             Log::error('Dummy passport photo not found: ' . $e->getMessage());
    //         } catch (FileIsTooBig $e) {
    //             Log::error('Dummy passport photo is too big: ' . $e->getMessage());
    //         }
    //     });
    // }
}



