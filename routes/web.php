<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LogisticaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/la_blanca', function () {
    return view('la_blanca');
})->name('la_blanca');

Route::get('/la_blanca_admin', function () {
    return view('la_blanca_admin');
})->middleware(['auth'])->name('la_blanca_admin');

Route::get('/la_blanca_work', function () {
    return view('la_blanca_work');
})->middleware(['auth'])->name('la_blanca_work');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('almacenes', AlmacenController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('logistica', LogisticaController::class);
    Route::resource('categorias', CategoriaController::class);
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


