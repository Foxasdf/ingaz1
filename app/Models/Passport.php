<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Passport extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable=[
        'الحالة',
        'الاسم',
      'رقم الجواز',
      'الاسم الاجنبي',
        'اسم الاب',
        'الشهرة',
      'اسم الاب اجنبي',
        'الشهرة اجنبي',
       'نوع الجواز',
     'الجنسية',
        'الجنس',
       'تاريخ الاستلام',
      'تاريخ الارسال',
        'تاريخ التسليم',
    ];
    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function registerMediaConversions(?Media $media = null): void
{
    $this
        ->addMediaConversion('preview')
        ->fit(Fit::Contain, 300, 300)
        ->nonQueued();
}
public function calculations()
{
    return $this->hasMany(Calculation::class);
}
}
