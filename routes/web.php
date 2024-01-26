<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class);

Route::controller(MenuController::class)->group(function(){
    Route::get('menu','index')->name('menu.index');
});

