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
        
    ];
    public function orders():HasMany
    {
            return $this ->hasMany(Order::class);
    }
    public function accountTypes():BelongsTo
{
    return $this->belongsTo(AccountTypes::class);
}
}
