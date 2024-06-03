<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiDatosNutriologo;
use App\Models\ApiDatosPaciente;
use App\Models\ApiNutriologoPaciente;
use App\Models\ApiPersona;
use App\Models\User;

class ListadoPacientes_VistaDirector extends Controller
{
    public function enlistar($id_nutriologo)
    {
        //La obtencion del user queda pendiente
        
        //Obtener nombre del alumno
        $idPersona = ApiDatosNutriologo::where('id_nutriologo', $id_nutriologo)->value('id_persona');
        if (!$idPersona) {
            return response()->json([
                'Error' => 'El ID de este alumno no existe.'
            ], 404);
        }
        $datosNutriologo = ApiPersona::find($idPersona);
        
        //Obtener grupo del alumno
        $grupoNutriologo = ApiDatosNutriologo::where('id_nutriologo', $id_nutriologo)->value('datos_alumno');
        
        //Obtener cantidad total de pacientes del alumno
        $cantidadPacientes = ApiNutriologoPaciente::where('id_nutriologo', $id_nutriologo)->count();

        //Obtener los datos de los pacientes del alumno
        $pacientesIds = ApiNutriologoPaciente::where('id_nutriologo', $id_nutriologo)->pluck('id_paciente');
        $datosPacientes = ApiDatosPaciente::whereIn('id_dato_paciente', $pacientesIds)->pluck('id_persona');
        $infoPacientes = ApiPersona::whereIn('persona_id', $datosPacientes)->get();

        return[
            'Datos del alumno' => $datosNutriologo,
            'Grupo del alumno' => $grupoNutriologo,
            'Cantidad de pacientes del alumno' => $cantidadPacientes,
            'Datos de sus pacientes' => $infoPacientes
        ];
    }
}
