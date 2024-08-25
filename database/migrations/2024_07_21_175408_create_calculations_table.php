<?php

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
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_second_entry')->default(false);
            $table->unsignedBigInteger('دائن');
            $table->unsignedBigInteger('مدين');
            $table->bigInteger('رصيد_الدائن');
            $table->bigInteger("رصيد_المدين");
            $table->string('البيان');
            $table->unsignedBigInteger('main_record_id')->nullable(); // Changed from رقم السجل الاساسي to main_record_id
            
            $table->unsignedBigInteger('نوع_الحساب_دائن');
            $table->unsignedBigInteger('نوع_الحساب_مدين');
            $table->unsignedBigInteger('passport_id');
            $table->unsignedBigInteger('coin_id');
    
            $table->foreign('دائن')->references('id')->on('accounts');
            $table->foreign('مدين')->references('id')->on('accounts');
            $table->foreign('نوع_الحساب_دائن')->references('id')->on('account_types');
            $table->foreign('نوع_الحساب_مدين')->references('id')->on('account_types');
            $table->foreign('passport_id')->references('id')->on('passports');
            $table->foreign('coin_id')->references('id')->on('coins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
