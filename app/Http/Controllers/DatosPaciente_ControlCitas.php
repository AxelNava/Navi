<?php

namespace App\Http\Controllers;

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

    public function showView($id)
    {
        return view('alumno.mostrar_control_citas_paciente', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_cita)
    {
        $paciente = ApiControlCita::findOrFail($id_cita);
        if (!$paciente) {
            return response()->json(['data' => 'No se ha encontrado el paciente'], 200);
        }
        $fills_values = $request->validate([
            'peso' => ['required', 'decimal:0,2'],
            'IMC' => ['required', 'decimal:0,2'],
            'masa_grasa_corporal' => ['required', 'decimal:0,2'],
            'porcentaje_grasa_corporal' => ['required', 'decimal:0,2'],
            'masa_muscular_kg' => ['required', 'decimal:0,2'],
            'agua_corpolar' => ['required', 'decimal:0,2'],
            'circunferencia_cintura' => ['required', 'numeric', 'max:32767'],
            'circunferencia_cadera' => ['required', 'numeric', 'max:32767'],
            'fecha_cita' => ['required', 'date_format:Y-m-d'],
            'hora_cita' => ['required', 'date_format:H:i'],
            'fecha_prox_cita' => ['required', 'date_format:Y-m-d'],
            'control_musculo' => ['required', 'decimal:0,2'],
            'control_grasa' => ['required', 'decimal:0,2'],
        ]);

        $result = $paciente->update($fills_values);
        if ($result) {
            return response()->json('Se han actualizado los datos');
        }
        return response()->json('Ha habido un error, no se han actualizado los datos');
    }
}
