<?php

use App\Http\Controllers\AltaNutriologo;
use App\Http\Controllers\DatosPaciente_ControlCitas;
use App\Http\Controllers\ListadoPacientes_VistaAlumno;
use App\Http\Controllers\ListadoPacientes_VistaDirector;
use App\Http\Controllers\ListadoAlumnos_VistaDirector;
use App\Http\Controllers\NotaNutricionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DietaPaciente;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\ListadoPacientesRegistros;
use App\Http\Controllers\ListadoRegistrosConsultaDePaciente;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('director/inicio', function () {
	return view('director.inicio');
})->name('director.inicio');

Route::get("alumno/{id}/ListadoPacientes", [ListadoPacientes_VistaAlumno::class, 'enlistar'])
	->name('listado_pacientes_Alumnos');
Route::get('alumno/listado-registros-pacientes/{id_persona_nutriologo}', [ListadoPacientesRegistros::class, 'listar'])
	->name('listado-pacientes');
Route::get('alumno/registros-paciente/{id_paciente}', [ListadoRegistrosConsultaDePaciente::class, 'listar_registros'])
	->name('listado-registros-paciente');
Route::get('alumno/ListadoRegistroPacientes/', function () {
	return view('alumno.listado_registros_pacientes');
});


Route::get('director/ListadoAlumnos', [ListadoAlumnos_VistaDirector::class, 'enlistar'])
	->name('listado_alumnos_Director');

Route::get('director/ListadoAlumnos/{id_nutriologo}', [ListadoPacientes_VistaDirector::class, 'enlistar'])
	->name('listado_pacientes_Director');

Route::get('controlCitas/{id}', [DatosPaciente_ControlCitas::class, 'show'])->name('control_citas');
Route::patch('controlCitas/actualizar/{id_cita}', [DatosPaciente_ControlCitas::class, 'update'])->name('control_citas_actualizar');

Route::get('alumno/agregar-paciente', function () {
	return view('alumno.agregar_paciente');
});

Route::get('alumno/inicio', [ListadoPacientes_VistaAlumno::class, 'enlistar'])->name('alumno.inicio');

// Route::get('alumno/control-citas-paciente/{id}', function () {
// 	return view('alumno.mostrar_control_citas_paciente');
// })->name('alumno-paciente-control-citas');

//2
Route::get('alumno/control-citas-paciente/{id}', [DatosPaciente_ControlCitas::class, 'showView'])->name('alumno-paciente-control-citas');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/nota-nutricion/buscar/{id}', [NotaNutricionController::class, 'buscar'])->name('nota-nutricion_buscar');
//crear dieta
Route::post('/nota-nutricion/crear', [NotaNutricionController::class, 'crear'])->name('nota-nutricion_crear');
Route::patch('/nota-nutricion/actualizar/{id}', [NotaNutricionController::class, 'actualizar'])->name('nota-nutricion_actualizar');

Route::get('dieta-paciente/buscar/{id}', [DietaPaciente::class, 'buscar'])->name('dieta-paciente_buscar');
Route::get('dieta-paciente/crear', function () {
	return view('alumno.agregar_dieta');
});
Route::post('dieta-paciente/crear', [DietaPaciente::class, 'crear'])->name('dieta-paciente_crear');

//rutas para el director
Route::middleware(['auth', 'role:director'])->group(function () {
	//pagina de inicio del director
	Route::get('director/inicio', function () {
		return view('director.inicio');
	})->name('director.inicio');

	// Route::get('director/alumno/control-citas-paciente/{id}', function () {
	// 	return view('director.');
	// })->name('director-alumno-paciente-control-citas');

	Route::get('director/lista_pacientes_alumno/{id_nutriologo}', function () {
		return view('director.lista_pacientes_alumno');
	})->name('director-lista-pacientes-alumno');

	//registrar alumno
	Route::post('registrar-alumno', [AltaNutriologo::class, 'store'])->name('registrar.alumno');
});

require __DIR__ . '/auth.php';
