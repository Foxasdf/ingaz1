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

     'اسم الزبون',
      'وجهة السفر',
      'نوع التأشير',
    'عدد مرات الدخول',
    'الحالة',
        
    ];
    public function account():BelongsTo{
        return $this->belongsTo(Account::class)->withDefault();
    }
    public function passports():HasMany
    {
            return $this ->hasMany(Passport::class);
    }
}
