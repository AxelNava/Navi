<?php

use App\Http\Controllers\ListadoPacientes_VistaAlumno;
use App\Http\Controllers\ListadoPacientes_VistaDirector;
use App\Http\Controllers\ListadoAlumnos_VistaDirector;
use App\Http\Controllers\NotaNutricionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('director/inicio', function () {
    return view('director.inicio');
})->name('director.inicio');

Route::get("alumno/{id}/ListadoPacientes", [ListadoPacientes_VistaAlumno::class, 'enlistar'])->name('listado_pacientes_Alumnos');

Route::get('director/ListadoAlumnos', [ListadoAlumnos_VistaDirector::class, 'enlistar'])->name('listado_alumnos_Director');

Route::get('director/ListadoAlumnos/{id}', [ListadoPacientes_VistaDirector::class, 'enlistar'])->name('listado_pacientes_Director');

Route::get('alumno/inicio', function () {
    return view('alumno.inicio');
})->name('alumno.inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/nota-nutricion/buscar/{id}', [NotaNutricionController::class,'crear'])->name('nota-nutricion_buscar');
Route::post('/nota-nutricion/crear', [NotaNutricionController::class,'crear'])->name('nota-nutricion_crear');
Route::patch('/nota-nutricion/actualizar/{id}', [NotaNutricionController::class,'actualizar'])->name('nota-nutricion_actualizar');

require __DIR__ . '/auth.php';