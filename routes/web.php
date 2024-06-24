<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LogisticaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductoController::class, 'inicio'])->name('home');
Route::get('/productos', [ProductoController::class, 'inicio'])->name('productos.index');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('/polos', [ProductoController::class, 'polos'])->name('polos');
Route::get('/pantalones', [ProductoController::class, 'pantalones'])->name('pantalones');
Route::get('/gorras', [ProductoController::class, 'gorras'])->name('gorras');
Route::get('/poleras', [ProductoController::class, 'poleras'])->name('poleras');
Route::get('/zapatillas', [ProductoController::class, 'zapatillas'])->name('zapatillas');
Route::get('/medias', [ProductoController::class, 'medias'])->name('medias');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CarritoController::class, 'processCheckout'])->name('processCheckout');

Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
Route::post('/favoritos', [FavoritoController::class, 'store'])->name('favoritos.store');
Route::delete('/favoritos/{id}', [FavoritoController::class, 'destroy'])->name('favoritos.destroy');

Route::get('/pedidos', [PedidoController::class, 'indice'])->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios.index');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::get('/comentarios/{id}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
Route::patch('/comentarios/{id}', [ComentarioController::class, 'update'])->name('comentarios.update');
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

Route::get('/boletas', [BoletaController::class, 'index'])->name('boletas.index');
Route::get('/boletas/{id}', [BoletaController::class, 'show'])->name('boletas.show');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/productos', ProductoController::class, ['as' => 'admin']);
    Route::resource('/admin/pedidos', PedidoController::class, ['as' => 'admin']);
    Route::resource('/admin/almacenes', AlmacenController::class, ['as' => 'admin']);
    Route::resource('/admin/logistica', LogisticaController::class, ['as' => 'admin']);
    Route::post('/admin/logistica/search', [LogisticaController::class, 'search'])->name('admin.logistica.search');
    Route::post('/admin/logistica/get-stock', [LogisticaController::class, 'getStockByAlmacen'])->name('admin.logistica.getStockByAlmacen');
    
    // Rutas de perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación con Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';


