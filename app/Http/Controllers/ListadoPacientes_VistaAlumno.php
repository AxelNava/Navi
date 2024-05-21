<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiDatosNutriologo;
use App\Models\ApiDatosPaciente;
use App\Models\ApiNutriologoPaciente;
use App\Models\ApiPersona;
use App\Models\User;

class ListadoPacientes_VistaAlumno extends Controller
{
    public function enlistar($id)
    {
        //La obtencion del user queda pendiente
        //$user = User::all();
        
        //Obtener datos del nutriologo --- ID/Nombre/Edad/Genero
        $idPersona = ApiDatosNutriologo::where('id_nutriologo', $id)->value('id_persona');
        if (!$idPersona) {
            return response()->json([
                'Error' => 'El ID del nutriologo no existe.'
            ], 404);
        }
        $datosNutriologo = ApiPersona::find($idPersona);

        //Obtener cantidad de pacientes del nutriologo
        $cantidadPacientes = ApiNutriologoPaciente::where('id_nutriologo', $id)->count();

        //Obtener datos de los pacientes del nutriologo --- idPaciente -> idPersona -> ID/Nombre/Edad/Genero
        $pacientesIds = ApiNutriologoPaciente::where('id_nutriologo', $id)->pluck('id_paciente');
        $datosPacientes = ApiDatosPaciente::whereIn('id_dato_paciente', $pacientesIds)->pluck('id_persona');
        $infoPacientes = ApiPersona::whereIn('persona_id', $datosPacientes)->get();

        return [
            'Datos del nutriologo' => $datosNutriologo,
            'Cantidad de pacientes del nutriologo' => $cantidadPacientes,
            'Datos de sus pacientes' => $infoPacientes,
            //'User' => $user
        ];
    }
}
