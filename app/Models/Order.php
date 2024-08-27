<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [

     'اسم_الزبون',
      'وجهة_السفر',
      'نوع_التأشير',
    'عدد_مرات_الدخول',
    'الحالة',
    'account_id'
        
    ];
    public function account():BelongsTo{
        return $this->belongsTo(Account::class)->withDefault();
    }
    public function passports():HasMany
    {
            return $this ->hasMany(Passport::class);
    }
}
