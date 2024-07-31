<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountTypes extends Model
{
    use HasFactory;
    protected $fillable = ['النوع'];
    public function accounts():HasMany
{
    return $this->hasMany(Account::class);
}
public function calculationsDain()
{
    return $this->hasMany(Calculation::class, 'نوع_الحساب_دائن');
}

public function calculationsMadin()
{
    return $this->hasMany(Calculation::class, 'نوع_الحساب_مدين');
}

}
