<?php

use App\Http\Controllers\AltaNutriologo;
use App\Http\Controllers\DatosPaciente_ControlCitas;
use App\Http\Controllers\ListadoPacientes_VistaAlumno;
use App\Http\Controllers\ListadoPacientes_VistaDirector;
use App\Http\Controllers\ListadoAlumnos_VistaDirector;
use App\Http\Controllers\NotaNutricionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReasignarPacienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DietaPaciente;
use App\Http\Controllers\ListadoPacientesRegistros;
use App\Http\Controllers\ListadoRegistrosConsultaDePaciente;
use App\Http\Controllers\ComentariosDirector;
use App\Http\Controllers\StatusAlumno;

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
Route::get('alumno/registro-paciente/{id_paciente}', [NotaNutricionController::class, 'buscar'])->name('registro-paciente');

Route::get('alumno/listado_pacientes_formularios/{id_paciente}', [ListadoRegistrosConsultaDePaciente::class, 'listar_formularios_paciente'])->name('listado_formularios');


Route::get('director/ListadoAlumnos', [ListadoAlumnos_VistaDirector::class, 'enlistar'])
	->name('listado_alumnos_Director');

Route::get('director/ListadoAlumnos/{id_nutriologo}', [ListadoPacientes_VistaDirector::class, 'enlistar'])
	->name('listado_pacientes_Director');

Route::get('controlCitas/{id}', [DatosPaciente_ControlCitas::class, 'show'])->name('control_citas');
Route::get('controlCitas/editar/{id}', [DatosPaciente_ControlCitas::class, 'edit'])->name('editar_control_citas');
Route::patch('controlCitas/actualizar/{id_cita}', [DatosPaciente_ControlCitas::class, 'update'])->name('control_citas_actualizar');

Route::get('alumno/agregar-paciente', function () {
	return view('alumno.agregar_paciente');
});

Route::get('alumno/agregar-consulta-paciente/{id_paciente}', [NotaNutricionController::class, 'get_base_paciente'])->name('registrar-consulta-paciente');

Route::get('alumno/modificar-registro/{id_registro}', [NotaNutricionController::class, 'buscar'])->name('modificar_registro_formulario');

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
Route::post('/nota-nutricion/crear-consulta-paciente/{id_paciente}', [NotaNutricionController::class, 'create_new_registro_formulario'])->name('nota-nutricion_crear_nueva_consulta_paciente');
Route::patch('/nota-nutricion/actualizar/{id}', [NotaNutricionController::class, 'actualizar'])->name('nota-nutricion_actualizar');

Route::get('dieta-paciente/buscar/{id}', [DietaPaciente::class, 'buscar'])->name('dieta-paciente_buscar');
Route::get('dieta-paciente/crear', function () {
	return view('alumno.agregar_dieta');
});
Route::post('dieta-paciente/crear', [DietaPaciente::class, 'crear'])->name('dieta-paciente_crear');


//Obtener formulario de registro de paciente para validar

//rutas para el director
Route::middleware(['auth', 'role:director'])->group(function () {
	//pagina de inicio del director
	Route::get('director/inicio', function () {
		return view('director.inicio');
	})->name('director.inicio');

	// Route::get('director/alumno/control-citas-paciente/{id}', function () {
	// 	return view('director.');
	// })->name('director-alumno-paciente-control-citas');

	// Route::get('director/lista_pacientes_alumno/{id_nutriologo}', function () {
	// 	return view('director.lista_pacientes_alumno');
	// })->name('director-lista-pacientes-alumno');

	//consumir la vista de listar pacientes de un nutriologo
	Route::get('director/lista_pacientes_alumno/{id_nutriologo}', [ListadoPacientes_VistaDirector::class, 'enlistarView'])
		->name('director-lista-pacientes-alumno-view');
	//consumir pacientes de un nutriologo
	Route::get('director/lista_pacientes_alumno_data/{idNutriologo}', [ListadoPacientes_VistaDirector::class, 'enlistar'])
		->name('director-lista-pacientes-alumno-data');

	// Route::get('director/lista_pacientes_alumno/{id_nutriologo}', function ($id_nutriologo) {
	// 	return view('director.lista_pacientes_alumno', ['id_nutriologo' => $id_nutriologo]);
	// })->name('director-lista-pacientes-alumno');

	//Consumir vista formularios de un paciente de un nutriologo
	Route::get('director/lista-formularios-paciente-alumno/{id_persona}', [ListadoRegistrosConsultaDePaciente::class, 'listar_formularios_paciente_director'])
		->name('director-formularios-paciente');
	//Obtener datos de los formularios de un paciente
	Route::get('director/registros-paciente/{id_paciente}', [ListadoRegistrosConsultaDePaciente::class, 'listar_registros_with_persona'])
		->name('listado-registros-paciente-alumno');

	Route::get('director/formulario_registro_paciente/{id_registro}', [NotaNutricionController::class, 'form_validation'])
		->name('formulario_validation_paciente');

	Route::patch('director/validar_registro_paciente/{id_registro}', [NotaNutricionController::class, 'validar_registro_consulta'])
		->name('validar_registro');

	//ir a la vista de reasignar paciente
	Route::get('director/reasignar-paciente', [ReasignarPacienteController::class, 'reasignarPaciente'])->name('reasignar_paciente');
	//Reasignar paciente
	Route::patch('director/reasignar-paciente-update/{id_paciente}',[ReasignarPacienteController::class,'actualizarReasignar'])->name('reasignar-paciente-update');
	//agregar comentario
	Route::post('director/comentario', [ComentariosDirector::class, 'store'])->name('agregar_comentario');

	//ir a la vista de datos del paciente en vista de director
	Route::get('director/control-citas-paciente/{id}', [DatosPaciente_ControlCitas::class, 'showViewDirector'])->name('director-paciente-control-citas');
	//traernos el json
	Route::get('director/controlCitas/{id}', [DatosPaciente_ControlCitas::class, 'showDirector']);
	//registrar alumno
	Route::post('registrar-alumno', [AltaNutriologo::class, 'store'])->name('registrar.alumno');

	//Ir a la vista cambiar status del alumno
	Route::get('director/status-alumno/{id_nutriologo}', [StatusAlumno::class, 'edit'])->name('director-status-alumno');
	//Obtener el status del alumno
	Route::get('director/status-alumno-json/{id_nutriologo}', [StatusAlumno::class, 'get_status'])->name('director-get-status-alumno');
	//Actualizar el status del alumno
	Route::patch('director/status-alumno/{id}', [StatusAlumno::class, 'update'])->name('actualizar-status-alumno');
});
//ver comentarios, se pone aquí para que no esté en el middleware
Route::get('director/comentario/{id_paciente}', [ComentariosDirector::class, 'show'])->name('ver_comentarios');
require __DIR__ . '/auth.php';
