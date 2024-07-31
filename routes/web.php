<?php

use App\Http\Controllers\web\AccountController as AccountController;
use App\Http\Controllers\web\OrderController;
use App\Http\Controllers\web\PassportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/accounts', [AccountController::class, 'index'])->name('accounts');
Route::get('/account/{id}', [AccountController::class, 'show'])->name('account-profile');

// Order routes
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders');
    Route::get('/{id}', [OrderController::class, 'show'])->name('order-details');
    Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('orders-edit');
    Route::put('/{id}', [OrderController::class, 'update'])->name('orders-update');
    Route::delete('/{id}', [OrderController::class, 'delete'])->name('order-delete');

});
// Order routes
Route::prefix('passports')->group(function () {
Route::get('/', [PassportController::class, 'index'])->name('passports-index');
Route::get('/{id}', [PassportController::class, 'show'])->name('passport-details');
Route::put('/{id}', [PassportController::class, 'update'])->name('passport-update');
Route::delete('/{id}', [PassportController::class, 'destroy'])->name('passport-delete');
});