<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatosPaciente_ControlCitas;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/control-citas/{id}', [DatosPaciente_ControlCitas::class, 'show']);
