<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'دائن',
        'مدين',
        'رصيد_الدائن',
        'رصيد_المدين',
        'البيان',
        'main_record_id',
        'نوع_الحساب_دائن',
        'نوع_الحساب_مدين',
        'passport_id',
        'coin_id',
        'is_second_entry',
        'created_at', // Allow setting the creation date
    ];

    // Define the relationship to find the counterpart entry
    public function counterpart()
    {
        return $this->hasOne(Calculation::class, 'main_record_id');
    }

    // Listen to the events
    protected static function booted()
    {
        static::created(function ($calculation) {
            // Check if this is the original entry
            if (!$calculation->is_second_entry) {
                // Create the second entry
                $secondEntry = $calculation->replicate();

                // Mark this as a second entry to prevent further recursion
                $secondEntry->is_second_entry = true;

                // Swap دائن and مدين values
                $secondEntry->دائن = $calculation->مدين;
                $secondEntry->مدين = $calculation->دائن;

                // Swap نوع_الحساب_دائن and نوع_الحساب_مدين values
                $secondEntry->نوع_الحساب_دائن = $calculation->نوع_الحساب_مدين;
                $secondEntry->نوع_الحساب_مدين = $calculation->نوع_الحساب_دائن;

                // Set دائن to 0 and مدين to the original دائن value
                $secondEntry['رصيد_الدائن'] = $calculation['رصيد_المدين'];
                $secondEntry['رصيد_المدين'] = $calculation['رصيد_الدائن'];

                // Set the main_record_id to the original calculation id
                $secondEntry->main_record_id = $calculation->id;

                // Save the second entry
                $secondEntry->save();
            }
        });

        static::deleting(function ($calculation) {
            if (!$calculation->is_second_entry && $calculation->counterpart) {
                // Safeguard: Only delete the counterpart if it's not the one initiating the deletion
                $calculation->counterpart->delete();
            }
        });
    }

    public function accountDain()
    {
        return $this->belongsTo(Account::class, 'دائن');
    }

    public function accountMadin()
    {
        return $this->belongsTo(Account::class, 'مدين');
    }

    public function accountTypeDain()
    {
        return $this->belongsTo(AccountTypes::class, 'نوع_الحساب_دائن');
    }

    public function accountTypeMadin()
    {
        return $this->belongsTo(AccountTypes::class, 'نوع_الحساب_مدين');
    }

    public function passport()
    {
        return $this->belongsTo(Passport::class);
    }

    public function coin()
    {
        return $this->belongsTo(Coin::class);
    }
}

