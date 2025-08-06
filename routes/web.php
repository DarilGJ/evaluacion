<?php

use App\Http\Controllers\FacturarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('facturar', FacturarController::class);
