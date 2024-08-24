<?php


use App\Http\Controllers\web\CalculationController;
use App\Http\Controllers\web\AccountTypesController;
use App\Http\Controllers\web\AccountController as AccountController;
use App\Http\Controllers\web\OrderController;
use App\Http\Controllers\web\PassportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Account routes
Route::prefix('accounts')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('accounts');
    Route::get('/create', [AccountController::class, 'create'])->name('account-create'); // For creating new accounts
    Route::post('/', [AccountController::class, 'store'])->name('account-store'); // To store new accounts
    Route::get('/{id}', [AccountController::class, 'show'])->name('account-profile');
    Route::get('/{id}/edit', [AccountController::class, 'edit'])->name('account-edit'); // For editing accounts
    Route::put('/{id}', [AccountController::class, 'update'])->name('account-update'); // To update accounts
    Route::delete('/{id}', [AccountController::class, 'destroy'])->name('account-delete'); // To delete accounts
});
// Order routes
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders');
    Route::get('/create', [OrderController::class, 'create'])->name('orders-create'); // Add this line
    Route::post('/', [OrderController::class, 'store'])->name('orders-store'); // Add this line for storing the order
    Route::get('/{id}', [OrderController::class, 'show'])->name('order-details');
    Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('orders-edit');
    Route::put('/{id}', [OrderController::class, 'update'])->name('orders-update');
    Route::delete('/{id}', [OrderController::class, 'delete'])->name('order-delete');
});
// Passport routes
Route::prefix('passports')->group(function () {
Route::get('/', [PassportController::class, 'index'])->name('passports-index');
Route::get('/{id}', [PassportController::class, 'show'])->name('passport-details');
Route::put('/{id}', [PassportController::class, 'update'])->name('passport-update');
Route::delete('/{id}', [PassportController::class, 'destroy'])->name('passport-delete');
});


Route::prefix('account-types')->group(function () {
    Route::get('/', [AccountTypesController::class, 'index'])->name('account-types.index');
    Route::get('/create', [AccountTypesController::class, 'create'])->name('account-types.create'); // Add this for the create form
    Route::post('/', [AccountTypesController::class, 'store'])->name('account-types.store'); // To handle form submissions
    Route::get('/{id}', [AccountTypesController::class, 'show'])->name('account-types.show');
    Route::get('/{id}/edit', [AccountTypesController::class, 'edit'])->name('account-types.edit');
    Route::put('/{id}', [AccountTypesController::class, 'update'])->name('account-types.update');
    Route::delete('/{id}', [AccountTypesController::class, 'destroy'])->name('account-types.destroy');
});

Route::prefix('calculations')->group(function () {
    Route::get('/', [CalculationController::class, 'index'])->name('calculations.index');
    Route::get('/create', [CalculationController::class, 'create'])->name('calculations.create');
    Route::post('/', [CalculationController::class, 'store'])->name('calculations.store');
    Route::get('/{id}', [CalculationController::class, 'show'])->name('calculations.show');
    Route::get('/{id}/edit', [CalculationController::class, 'edit'])->name('calculations.edit');
    Route::put('/{id}', [CalculationController::class, 'update'])->name('calculations.update');
    Route::delete('/{id}', [CalculationController::class, 'destroy'])->name('calculations.destroy');
    Route::get('/accounts/by-type/{accountTypeId}', [CalculationController::class, 'getAccountsByType']);
});


Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->name('admin.dashboard');