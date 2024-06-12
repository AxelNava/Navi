<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ApiDatosPaciente;
use App\Models\ApiControlCita;
use Illuminate\Support\Facades\DB;

class DatosPaciente_ControlCitas extends Controller
{

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		if (is_numeric($id)) {
			$data_paciente = ApiDatosPaciente::where('id_dato_paciente', $id)->count();
			if ($data_paciente > 0) {
				$data = DB::table('api_control_citas')
					->leftJoin('api_datos_paciente', 'api_datos_paciente.id_dato_paciente', '=', 'api_control_citas.id_paciente')
					->leftJoin('api_persona', 'api_datos_paciente.id_persona', 'api_persona.persona_id')
					->where('id_dato_paciente', $id)
					->select(
						'id_cita',
						'id_paciente',
						'id_registro_consulta',
						'peso',
						'IMC',
						'masa_grasa_corporal',
						'porcentaje_grasa_corporal',
						'masa_muscular_kg',
						'agua_corpolar',
						'circunferencia_cintura',
						'circunferencia_cadera',
						'fecha_cita',
						'hora_cita',
						'fecha_prox_cita',
						'control_musculo',
						'control_grasa',
						'expediente',
						'fecha_nacimiento',
						'nombre',
						'edad',
						'genero'
					)
					->get();
				// return ApiDatosPaciente::where('id_dato_paciente', $id)->get();
				return response()->json(compact('data'), 200);
			}
			return response()->json(['data' => 'No se ha encontrado el paciente'], 200);
		}
		return response()->json(['data' => 'Identificador incorrecto'], 200);
	}

	//mostrar datos en vista de director
	public function showDirector(string $id_persona)
	{
		if (is_numeric($id_persona)) {
			$data_paciente = ApiDatosPaciente::where('id_persona', $id_persona)->first();
			if ($data_paciente) {
				$id_dato_paciente = $data_paciente->id_dato_paciente;
				$data = DB::table('api_control_citas')
					->leftJoin('api_datos_paciente', 'api_datos_paciente.id_dato_paciente', '=', 'api_control_citas.id_paciente')
					->leftJoin('api_persona', 'api_datos_paciente.id_persona', 'api_persona.persona_id')
					->where('id_dato_paciente', $id_dato_paciente)
					->select(
						'id_cita',
						'id_paciente',
						'id_registro_consulta',
						'peso',
						'IMC',
						'masa_grasa_corporal',
						'porcentaje_grasa_corporal',
						'masa_muscular_kg',
						'agua_corpolar',
						'circunferencia_cintura',
						'circunferencia_cadera',
						'fecha_cita',
						'hora_cita',
						'fecha_prox_cita',
						'control_musculo',
						'control_grasa',
						'expediente',
						'fecha_nacimiento',
						'nombre',
						'edad',
						'genero'
					)
					->get();
				return response()->json(compact('data'), 200);
			}
			return response()->json(['data' => 'No se ha encontrado el paciente'], 200);
		}
		return response()->json(['data' => 'Identificador incorrecto'], 200);
	}

	//ir a la vista
	public function showView($id)
	{
		return view('alumno.mostrar_control_citas_paciente', compact('id'));
	}
	//ir a la vista
	public function showViewDirector($id)
	{
		return view('director.mostrar_control_citas_paciente_director', compact('id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		if (is_numeric($id)) {
			$data_paciente = ApiDatosPaciente::where('id_dato_paciente', $id)->count();
			if ($data_paciente > 0) {
				$data = DB::table('api_control_citas')
					->leftJoin('api_datos_paciente', 'api_datos_paciente.id_dato_paciente', '=', 'api_control_citas.id_paciente')
					->leftJoin('api_persona', 'api_datos_paciente.id_persona', 'api_persona.persona_id')
					->where('id_dato_paciente', $id)
					->select(
						'id_cita',
						'id_paciente',
						'id_registro_consulta',
						'peso',
						'IMC',
						'masa_grasa_corporal',
						'porcentaje_grasa_corporal',
						'masa_muscular_kg',
						'agua_corpolar',
						'circunferencia_cintura',
						'circunferencia_cadera',
						'fecha_cita',
						'hora_cita',
						'fecha_prox_cita',
						'control_musculo',
						'control_grasa',
						'expediente',
						'fecha_nacimiento',
						'nombre',
						'edad',
						'genero'
					)
					->get();
				return view('alumno.modificar_control_citas', compact('data'));
			}
			return view('alumno.modificar_control_citas', compact('data'));
		}
		return view('alumno.modificar_control_citas', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id_paciente)
	{
		$iterator = $request->request->getIterator();
		$array_copy = array_slice($iterator->getArrayCopy(), 2);

		$ids_registro = $array_copy['id_registro'];
		foreach ($ids_registro as $index => $id_registro) {
			$control_cita_registro = ApiControlCita::find($array_copy['id_cita'][$index]);
			$control_cita_registro->fecha_cita = $array_copy['fecha_cita'][$index];
			$control_cita_registro->peso = $array_copy['peso'][$index];
			$control_cita_registro->IMC = $array_copy['IMC'][$index];
			$control_cita_registro->masa_grasa_corporal = $array_copy['masa_grasa_corporal'][$index];
			$control_cita_registro->porcentaje_grasa_corporal = $array_copy['porcentaje_grasa_corporal'][$index];
			$control_cita_registro->masa_muscular_kg = $array_copy['masa_muscular_kg'][$index];
			$control_cita_registro->agua_corpolar = $array_copy['agua_corpolar'][$index];
			$control_cita_registro->circunferencia_cintura = $array_copy['circunferencia_cintura'][$index];
			$control_cita_registro->circunferencia_cadera = $array_copy['circunferencia_cadera'][$index];
			$control_cita_registro->fecha_prox_cita = $array_copy['fecha_prox_cita'][$index];
			$control_cita_registro->update();
		}
		$ids_nuevas_citas = $array_copy['id_registro_to_create'] ?? [];
		if (count($ids_nuevas_citas) > 0) {
			$offset_array = count($ids_registro);
			foreach ($ids_nuevas_citas as $index => $id_registro) {
				$control_cita_registro = new ApiControlCita();
				$control_cita_registro->id_registro_consulta = $id_registro;
				$control_cita_registro->id_paciente = $id_paciente;
				$control_cita_registro->fecha_cita = $array_copy['fecha_cita'][$index + $offset_array];
				$control_cita_registro->hora_cita = Carbon::today();
				$control_cita_registro->peso = $array_copy['peso'][$index + $offset_array];
				$control_cita_registro->IMC = $array_copy['IMC'][$index + $offset_array];
				$control_cita_registro->masa_grasa_corporal = $array_copy['masa_grasa_corporal'][$index + $offset_array];
				$control_cita_registro->porcentaje_grasa_corporal = $array_copy['porcentaje_grasa_corporal'][$index + $offset_array];
				$control_cita_registro->masa_muscular_kg = $array_copy['masa_muscular_kg'][$index + $offset_array];
				$control_cita_registro->agua_corpolar = $array_copy['agua_corpolar'][$index + $offset_array];
				$control_cita_registro->circunferencia_cintura = $array_copy['circunferencia_cintura'][$index + $offset_array];
				$control_cita_registro->circunferencia_cadera = $array_copy['circunferencia_cadera'][$index + $offset_array];
				$control_cita_registro->fecha_prox_cita = $array_copy['fecha_prox_cita'][$index + $offset_array];
				$control_cita_registro->save();
			}
			return redirect()
				->route('alumno-paciente-control-citas', $id_paciente)
				->with('success', 'Se han modificado correctamente los registros de control de citas y agregado nuevos');
		}
		return redirect()
			->route('alumno-paciente-control-citas', $id_paciente)
			->with('success', 'Se ha modificado correctamente los datos del control de citas');
	}
}
