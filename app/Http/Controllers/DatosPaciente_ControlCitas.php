<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApiDatosPaciente;
use App\Models\ApiControlCita;
use Illuminate\Support\Facades\DB;

class DatosPaciente_ControlCitas extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
                ->where('id_dato_paciente',$id)
                ->select('id_cita','id_paciente','id_registro_consulta','peso',
                'IMC','masa_grasa_corporal','porcentaje_grasa_corporal',
                'masa_muscular_kg','agua_corpolar','circunferencia_cintura','circunferencia_cadera','fecha_cita','hora_cita',
                'fecha_prox_cita','control_musculo','control_grasa','expediente','fecha_nacimiento','nombre','edad','genero')
                ->get();
                // return ApiDatosPaciente::where('id_dato_paciente', $id)->get();
                return response()->json(compact('data'),200);
            }
            return response()->json(['data'=> 'No se ha encontrado el paciente'],200);
        }
        return response()->json(['data'=> 'Identificador incorrecto'],200);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
