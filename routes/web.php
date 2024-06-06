<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('paypal')->group(function () {
    Route::post('/create-order', [PayPalController::class, 'createOrder'])->name('paypal.createOrder');
    Route::post('/capture-order/{orderId}', [PayPalController::class, 'captureOrder'])->name('paypal.captureOrder');
    Route::get('/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');
    Route::get('/return', [PayPalController::class, 'return'])->name('paypal.return');
});

Route::get('/paypal', function () {
    return view('paypal');
});


require __DIR__.'/auth.php';
