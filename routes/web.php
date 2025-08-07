<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('facturar', FacturarController::class);
Route::resource('cliente', ClienteController::class);
