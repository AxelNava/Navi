<?php

namespace App\Http\Controllers;

use App\Models\ApiControlCita;
use App\Models\ApiDatosPaciente;
use App\Models\ApiPersona;
use App\Models\ApiRegistroConsultum;

class ListadoRegistrosConsultaDePaciente extends Controller
{
    public function listar_registros($id_paciente)
    {
        $ids_registros = ApiRegistroConsultum::where('id_paciente', $id_paciente)->pluck('id_registro');
        $info_paciente = ApiDatosPaciente::find($id_paciente);
        $persona = ApiPersona::find($info_paciente->id_persona);
        $fechas_citas = ApiControlCita::whereIn('id_registro_consulta', $ids_registros)->pluck('fecha_cita');
        return response()->json([
            'data' => [
                'registros' => $ids_registros,
                'fechas_citas' => $fechas_citas,
                'info_paciente' => $info_paciente,
                'persona' => $persona
            ]
        ]);
    }
    public function listar_registros_with_persona($id_persona)
    {
        $info_paciente = ApiDatosPaciente::where('id_persona', $id_persona)->first();
        $ids_registros = ApiRegistroConsultum::where('id_paciente', $info_paciente->id_dato_paciente)->pluck('id_registro');
        $persona = ApiPersona::find($id_persona);
        $fechas_citas = ApiControlCita::whereIn('id_registro_consulta', $ids_registros)->pluck('fecha_cita');
        return response()->json([
            'data' => [
                'registros' => $ids_registros,
                'fechas_citas' => $fechas_citas,
                'info_paciente' => $info_paciente,
                'persona' => $persona
            ]
        ]);
    }
    public function listar_formularios_paciente($id_paciente)
    {
        return view('alumno.listado_formularios_paciente', compact('id_paciente'));
    }

    public function listar_formularios_paciente_director($id_persona)
    {
        return view('director.lista_formularios_paciente_alumno', compact('id_persona'));
    }

}
