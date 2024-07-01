<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\GestoruserController;
use App\Http\Controllers\LogisticaController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsTrabajador;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PedidoUsuarioController;
use Illuminate\Support\Facades\Route;



// Rutas de productos y categorías
Route::get('/', [ProductoController::class, 'inicio'])->name('home');
Route::get('/productos', [ProductoController::class, 'inicio'])->name('productos.index');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/filtrar', [ProductoController::class, 'filtrarPorPrecio'])->name('productos.filtrar');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('/polos', [ProductoController::class, 'polos'])->name('polos');
Route::get('/pantalones', [ProductoController::class, 'pantalones'])->name('pantalones');
Route::get('/gorras', [ProductoController::class, 'gorras'])->name('gorras');
Route::get('/poleras', [ProductoController::class, 'poleras'])->name('poleras');
Route::get('/zapatillas', [ProductoController::class, 'zapatillas'])->name('zapatillas');
Route::get('/medias', [ProductoController::class, 'medias'])->name('medias');

// Rutas para el carrito de compras
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CarritoController::class, 'processCheckout'])->name('processCheckout');

// Rutas de pedidos
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

// Rutas de comentarios
Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios.index');


// Rutas de boletas
Route::get('/boletas', [BoletaController::class, 'index'])->name('boletas.index');
Route::get('/boletas/{id}', [BoletaController::class, 'show'])->name('boletas.show');

// Rutas del pie de página
Route::get('/contactanos', [PaginaController::class, 'contactanos'])->name('contactanos');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/ofertas-promociones', [PaginaController::class, 'ofertasPromociones'])->name('ofertasPromociones');
Route::get('/nuestra-historia', [PaginaController::class, 'nuestraHistoria'])->name('nuestraHistoria');

// Rutas de administración (requieren autenticación)
Route::middleware('auth')->group(function () {

    // Rutas de perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rutas de comentarios
    Route::get('/comentarios/{id}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
    Route::put('/comentarios/{id}', [ComentarioController::class, 'update'])->name('comentarios.update');
    Route::post('/productos/{producto_id}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

    Route::get('/pedidos', [PedidoUsuarioController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{numeroPedido}', [PedidoUsuarioController::class, 'show'])->name('pedidos.detalles');
});

// Rutas de administración (requieren autenticación)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/productos', ProductoController::class, ['as' => 'admin']);
    Route::resource('/admin/pedidos', PedidoController::class, ['as' => 'admin']);
    Route::resource('/admin/almacenes', AlmacenController::class, ['as' => 'admin']);
    Route::resource('/admin/logistica', LogisticaController::class, ['as' => 'admin']);
    Route::resource('/admin/gestorUsers', GestoruserController::class, ['as' => 'admin']);
    Route::post('/admin/logistica/search', [LogisticaController::class, 'search'])->name('admin.logistica.search');
    Route::post('/admin/logistica/get-stock', [LogisticaController::class, 'getStockByAlmacen'])->name('admin.logistica.getStockByAlmacen');
    Route::get('/admin/pedidos', [PedidoController::class, 'adminIndex'])->name('admin.pedidos.index');
    Route::get('admin/pedidos/{numero_pedido}/{numero_envio}', [PedidoController::class, 'show'])->name('admin.pedidos.show');
    Route::patch('/admin/pedidos/{numeroPedido}/{numeroEnvio}/update-estado', [PedidoController::class, 'updateEstado'])->name('admin.pedidos.updateEstado');

    
});

Route::middleware(['auth', 'trabajador'])->group(function () {
    
    // Otras rutas para trabajadores
});
// Rutas de autenticación con Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';



