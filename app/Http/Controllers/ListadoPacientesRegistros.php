<?php

namespace App\Http\Controllers;

use App\Models\ApiDatosNutriologo;
use App\Models\ApiDatosPaciente;
use App\Models\ApiNutriologoPaciente;
use App\Models\ApiPersona;

class ListadoPacientesRegistros extends Controller
{
    public function listar($id_persona_nutriologo)
    {
        $id_persona_nutriologo = auth()->user()->persona_id ?? $id_persona_nutriologo;
        $id_nutriologo = ApiDatosNutriologo::where('id_persona', $id_persona_nutriologo)->first()->id_nutriologo;
        $ids_pacientes = ApiNutriologoPaciente::where('id_nutriologo', '=', $id_nutriologo)
            ->pluck('id_paciente');
        $ids_personas_paciente = ApiDatosPaciente::whereIn('id_dato_paciente', $ids_pacientes)
            ->pluck('id_persona');
        $datos_pacientes = ApiPersona::whereIn('persona_id', $ids_personas_paciente)->get();
        return response()->json(['data' => $datos_pacientes]);
    }
}
