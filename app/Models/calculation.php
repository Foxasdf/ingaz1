<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calculation extends Model
{
    use HasFactory;
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
