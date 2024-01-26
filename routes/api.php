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
Route::resource('/adquiere', AdquiereController::class);
Route::resource('/categoria', CategoriaController::class);
Route::resource('/detalle', DetalleController::class);
Route::resource('/factura', FacturaController::class);
Route::resource('/farmacia', FarmaciaController::class);
Route::resource('/lote', LoteController::class);
Route::resource('/producto', ProductoController::class);
Route::resource('/proveedor', ProveedorController::class);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
