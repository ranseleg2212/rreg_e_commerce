<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Products\Show;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Products\Create;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CompleteOrderController;
use App\Http\Controllers\InsertarOrdenController;
use App\Http\Controllers\ProductoControlController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MostrarPedidoController;
use App\Http\Controllers\SolicitudCreditoController;
use App\Http\Controllers\CarritoConsultaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//!
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');


Auth::routes();

// !SOLICITUD DE CREDITO
Route::get('/financiar', [SolicitudCreditoController::class,'formulario'])
    ->name('financiar')
    ->middleware('auth');

Route::get('/solicitud', [SolicitudCreditoController::class, 'create'])
    ->name('enviar_solicitud')
    ->middleware('auth');

// *administrador
Route::get('/solicitud/{id}', [SolicitudCreditoController::class, 'mostrar_uno'])
    ->name('mostrar_una_solicitud')
    ->middleware('auth', 'admin');

Route::put('SolicitudCredito/{solicitud}/anular', [SolicitudCreditoController::class, 'anular'])
    ->name('solicitud-creditos.anular')
    ->middleware('auth', 'admin');

Route::put('SolicitudCredito/{solicitudCredito}', [SolicitudCreditoController::class, 'update'])
    ->name('solicitud-creditos.update')
    ->middleware('auth', 'admin');

Route::get('SolicitudCredito/{id}/edit', [SolicitudCreditoController::class, 'editar'])
    ->name('solicitud-creditos.edit')
    ->middleware('auth', 'admin');

Route::get('/solicitudes', [SolicitudCreditoController::class, 'mostrar'])
    ->name('mostrar_solicitudes')
    ->middleware('auth', 'admin');

// !USUARIO
Route::get('/usuarios', [UsuarioController::class, 'mostrar_usuarios'])
    ->name('control_user')
    ->middleware('auth', 'admin');

Route::get('/editar_usuario/{id}', [UsuarioController::class, 'editar_usuario'])
    ->name('editar_user')
    ->middleware('auth', 'admin');

Route::put('/editar_usuario/{usuarioed}', [UsuarioController::class, 'save_user'])
    ->name('guardar_user')
    ->middleware('auth', 'admin');

// !PRODUCTOS
Route::get('/productosbusqueda', App\Http\Livewire\Products\Index::class)
    ->name('buscar_producto');

Route::get('/products/{product}', Show::class)
    ->name('products.show');

Route::put('/producto_editar/{product}', [ProductoControlController::class, 'editar_producto'])
    ->name('editar_producto')
    ->middleware('auth', 'admin');

Route::get('/productom/{id}', [ProductoControlController::class, 'mostrar_producto'])
    ->name('mostrar_producto');

//* administrador
Route::post('/guardar', [ProductoControlController::class, 'save'])
    ->name('products.create')
    ->middleware('auth', 'admin');

Route::get('/crear', Create::class)
    ->name('pcreate')
    ->middleware('auth', 'admin');

Route::get('/producto/{product}', [ProductoControlController::class, 'editar'])
    ->name('editar_prod')
    ->middleware('auth', 'admin');

Route::get('/productos', [ProductoControlController::class, 'mostrar_productos'])
    ->name('mostrar_productos')
    ->middleware('auth', 'admin');

// !CARRITOS

Route::get('/carritos', [CarritoConsultaController::class, 'mostrar_carritos'])
    ->name('mostrar_carritos')
    ->middleware('auth', 'admin');

Route::get('/carrito/{id}', [CarritoConsultaController::class, 'mostrar_carrito'])
    ->name('mostrar_carrito')
    ->middleware('auth', 'admin');

Route::delete('/carrito/{cart_id}/producto/{product_id}', [CarritoConsultaController::class, 'deleteProduct'])
->name('eliminar_producto')
->middleware('auth', 'admin');


// !PEDIDOS
Route::put('/confirmacion/{cart}/{id}/{total}', [PedidoController::class, 'guardar'])
    ->name('order.save');

Route::get('/pedidos/{usuario}', [PedidoController::class, 'mostrar_pedidos_usuario'])
    ->name('control_pedido_cliente')
    ->middleware('auth');

Route::get('/detallepedido/{id}', [PedidoController::class, 'detalle'])
    ->name('detalle_pedido_cliente')
    ->middleware('auth');

// *administrador
Route::get('/administrador', [PedidoController::class, 'pedidos_inicio'])
    ->name('admin')
    ->middleware('auth', 'admin');

Route::put('/estado_pedido/{pedido}', [PedidoController::class, 'estado'])
    ->name('editar_estado_pedido')
    ->middleware('auth', 'admin');

Route::get('/pedidos', [PedidoController::class, 'mostrar_pedidos'])
    ->name('control_pedido')
    ->middleware('auth', 'admin');

Route::get('/detalle/{id}', [PedidoController::class, 'detalle_pedido'])
    ->name('detalle_pedido')
    ->middleware('auth', 'admin');

// !CARRITO DE COMPRAS
Route::get('/checkout/{id}', Checkout::class)
    ->name('checkout')
    ->middleware('check');

