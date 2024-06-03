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
    public function enlistar()
    {
        //La obtencion del user queda pendiente
        $idPersona = auth()->user()->persona_id;

        //Obtener datos del nutriologo --- ID/Nombre/Edad/Genero
        $id = ApiDatosNutriologo::where('id_persona', $idPersona)->value('id_nutriologo');

        $datosNutriologo = ApiPersona::find($idPersona);

        //Obtener cantidad de pacientes del nutriologo
        $cantidadPacientes = ApiNutriologoPaciente::where('id_nutriologo', $id)->count();

        //Obtener datos de los pacientes del nutriologo --- idPaciente -> idPersona -> ID/Nombre/Edad/Genero
        $pacientesIds = ApiNutriologoPaciente::where('id_nutriologo', $id)->pluck('id_paciente');
        $datosPacientes = ApiDatosPaciente::whereIn('id_dato_paciente', $pacientesIds)->pluck('id_persona');
        $infoPacientes = ApiPersona::whereIn('persona_id', $datosPacientes)->get();

        return view('alumno.inicio', [
            'data' => [
                'Datos del nutriologo' => $datosNutriologo,
                'Cantidad_pacientes_nutriologo' => $cantidadPacientes,
                'Datos_pacientes_persona' => $infoPacientes,
                'Datos_paciente' => $pacientesIds
            ]
        ]);
    }
}
