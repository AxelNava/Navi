<?php

namespace App\Http\Controllers;

use App\Models\ApiRegistroConsultum;

class ListadoRegistrosConsultaDePaciente extends Controller
{
    public function listar_registros($id_paciente)
    {
        $ids_registros = ApiRegistroConsultum::where('id_paciente', $id_paciente)->get('id_registro');

        return response()->json(['data' => $ids_registros]);
    }
    public function listar_formularios_paciente($id_paciente)
    {
        return view('alumno.listado_formularios_paciente', compact('id_paciente'));
    }
}
