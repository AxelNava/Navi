<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosPaciente_ControlCitas;
use App\Http\Controllers\NotaNutricionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/control-citas/{id}', [DatosPaciente_ControlCitas::class, 'show']);
Route::get('/nota-nutricion/buscar/{id}', [NotaNutricionController::class, 'buscar']);

