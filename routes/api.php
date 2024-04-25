<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\AdquiereController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class,'login']);

Route::resource('/adquiere', AdquiereController::class);
Route::resource('/categoria', CategoriaController::class);

Route::get('/categoria/imagen/{imagen}',[CategoriaController::class,'image']);
Route::post('/categoria/imagen/',[CategoriaController::class,'imageUpload']);

Route::get('/categoria/productos/{id}',[CategoriaController::class,'productos']);//ruta que devuelve toda la informacion de los productos cuya categoria sea igual al $id

Route::resource('/detalle', DetalleController::class);
Route::resource('/factura', FacturaController::class);
Route::get('/factura/detallar/{id}',[FacturaController::class,'detallar']);
Route::get('/adquiere/detallar/{id}',[AdquiereController::class,'detallar']);

Route::resource('/farmacia', FarmaciaController::class);
Route::resource('/lote', LoteController::class);
Route::resource('/producto', ProductoController::class);

Route::get('/producto/imagen/{imagen}',[ProductoController::class,'image']);
Route::post('/producto/imagen/',[ProductoController::class,'imageUpload']);
Route::get('/producto/listar/',[ProductoController::class,'listar_nombres']);
Route::put('/producto/stock/{id}',[ProductoController::class,'updatestock']);

Route::put('/producto/stock/{id}',[ProductoController::class,'updatestockplus']);

Route::resource('/proveedor', ProveedorController::class);
Route::resource('/cliente', ClienteController::class);

Route::get('/cliente/imagen/{imagen}',[ClienteController::class,'image']);
Route::post('/cliente/imagen/',[ClienteController::class,'imageUpload']);

Route::get('/user/imagen/{imagen}',[UserController::class,'image']);
Route::post('/user/imagen/',[UserController::class,'imageUpload']);

Route::group(['middleware' => 'auth:api'], function() {
      
      Route::get('logout', 'AuthController@logout');
      Route::get('user', 'AuthController@user');
      
Route::resource('/user', UserController::class);


});


