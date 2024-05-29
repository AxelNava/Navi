<?php

use App\Http\Controllers\DatosPaciente_ControlCitas;
use App\Http\Controllers\ListadoPacientes_VistaAlumno;
use App\Http\Controllers\ListadoPacientes_VistaDirector;
use App\Http\Controllers\ListadoAlumnos_VistaDirector;
use App\Http\Controllers\NotaNutricionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudiantesController;

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

Route::get('controlCitas/{id}', [DatosPaciente_ControlCitas::class, 'show'])->name('control_citas');
Route::patch('controlCitas/actualizar/{id_cita}', [DatosPaciente_ControlCitas::class, 'update'])->name('control_citas_actualizar');

Route::get('alumno/agregar-paciente', function () {
	return view('alumno.agregar_paciente');
});

Route::get('alumno/inicio', function () {
	return view('alumno.inicio');
})->name('alumno.inicio');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/nota-nutricion/buscar/{id}', [NotaNutricionController::class, 'buscar'])->name('nota-nutricion_buscar');
Route::post('/nota-nutricion/crear', [NotaNutricionController::class, 'crear'])->name('nota-nutricion_crear');
Route::patch('/nota-nutricion/actualizar/{id}', [NotaNutricionController::class, 'actualizar'])->name('nota-nutricion_actualizar');

//rutas para el director
Route::middleware(['auth', 'role:director'])->group(function () {
	//pagina de inicio del director
	Route::get('director/inicio', function () {
		return view('director.inicio');
	})->name('director.inicio');
	//registrar alumno
	Route::post('registrar-alumno', [UserController::class, 'createUser'])->name('registrar.alumno');
});

require __DIR__ . '/auth.php';
