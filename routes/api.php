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

Route::resource('/personal', PersonalController::class);

Route::get('/personal/imagen/{imagen}',[PersonalController::class,'image']);
Route::post('/personal/imagen/',[PersonalController::class,'imageUpload']);

Route::resource('/adquiere', AdquiereController::class);
Route::resource('/categoria', CategoriaController::class);

Route::get('/categoria/imagen/{imagen}',[CategoriaController::class,'image']);
Route::post('/categoria/imagen/',[CategoriaController::class,'imageUpload']);

Route::resource('/detalle', DetalleController::class);
Route::resource('/factura', FacturaController::class);
Route::resource('/farmacia', FarmaciaController::class);
Route::resource('/lote', LoteController::class);
Route::resource('/producto', ProductoController::class);

Route::get('/producto/imagen/{imagen}',[ProductoController::class,'image']);
Route::post('/producto/imagen/',[ProductoController::class,'imageUpload']);

Route::resource('/proveedor', ProveedorController::class);
Route::resource('/cliente', ProveedorController::class);

Route::get('/cliente/imagen/{imagen}',[ClienteController::class,'image']);
Route::post('/cliente/imagen/',[ClienteController::class,'imageUpload']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
