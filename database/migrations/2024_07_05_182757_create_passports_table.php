<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('الحالة');
            $table->string( 'الاسم');
            $table->string('رقم الجواز');
            $table->string( 'الاسم الاجنبي')->nullable();
            $table->string('اسم الاب')->nullable();
            $table->string('الشهرة')->nullable();
            $table->string('اسم الاب اجنبي')->nullable();
            $table->string('الشهرة اجنبي')->nullable();
            $table->string('نوع الجواز')->nullable();
            $table->string('الجنسية')->nullable();
            $table->string('الجنس')->nullable();
            $table->date('تاريخ الاستلام')->nullable();
            $table->date('تاريخ الارسال')->nullable();
            $table->date('تاريخ التسليم')->nullable();

 
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passports');
    }
};
