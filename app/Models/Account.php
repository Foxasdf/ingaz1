<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'الاسم',
        'رقم الهاتف',
        'العنوان',
        'النوع',
        'account_types_id',
        
    ];
public function orders():HasMany
    {
            return $this ->hasMany(Order::class);
    }
public function accountTypes():BelongsTo
{
    return $this->belongsTo(AccountTypes::class);
}
public function calculationsDain(): HasMany
{
    return $this->hasMany(Calculation::class, 'دائن');
}

public function calculationsMadin(): HasMany
{
    return $this->hasMany(Calculation::class, 'مدين');
}
public function isDeletable(): bool
{
    // Check if this account has any related orders or calculations
    return $this->orders()->doesntExist() &&
           $this->calculationsDain()->doesntExist() &&
           $this->calculationsMadin()->doesntExist();
}
}
