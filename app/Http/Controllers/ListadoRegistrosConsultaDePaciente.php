<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ListadoRegistrosConsultaDePaciente extends Controller
{
    public function listar_registros($id_paciente)
    {
        $ids_registros = DB::table('api_control_citas')
            ->leftJoin('api_datos_paciente', 'api_datos_paciente.id_dato_paciente', '=', 'api_control_citas.id_paciente')
            ->leftJoin('api_persona', 'api_datos_paciente.id_persona', '=', 'api_persona.persona_id')
            ->where('api_control_citas.id_paciente', $id_paciente)
            ->select(
                DB::raw(
                    'DISTINCT api_control_citas.id_registro_consulta,api_control_citas.fecha_cita ,api_persona.nombre,api_persona.edad,api_persona.genero'
                )
            )->get();

        return response()->json(['data' => $ids_registros]);
    }
    public function listar_formularios_paciente($id_paciente)
    {
        return view('alumno.listado_formularios_paciente', compact('id_paciente'));
    }
}
