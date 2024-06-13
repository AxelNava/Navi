<?php

namespace App\Http\Controllers;

use App\Models\ApiDatosNutriologo;
use App\Models\ApiDatosPaciente;
use App\Models\ApiNutriologoPaciente;
use Illuminate\Http\Request;

class ReasignarPacienteController extends Controller
{
    public function reasignarPaciente(Request $request)
    {
        $id_alumno = $request->id_alumno;
        $id_paciente = $request->id_paciente;
        //Nutriologo activos
        $nutriologos = ApiDatosNutriologo::where('status_alumno', 'activo')
            ->leftJoin('api_persona', 'id_persona', '=', 'persona_id')
            ->get();
        return view('director.reasignar_paciente', compact('id_alumno', 'id_paciente', 'nutriologos'));
    }

    public function actualizarReasignar(Request $request, $id_paciente)
    {
        // Realiza las operaciones necesarias
        $values_validated = $request->validate([
            'id_paciente' => ['required', 'exists:api_datos_paciente,id_persona'],
            'id_nutriologo_anterior' => ['required', 'exists:api_datos_nutriologo,id_persona'],
            'id_nutriologo_nuevo' => ['required', 'exists:api_datos_nutriologo,id_nutriologo'],
        ]);
        $id_nutriologo_anterior = ApiDatosNutriologo::where('id_persona', $values_validated['id_nutriologo_anterior'])->first('id_nutriologo');
        $id_dato_paciente = ApiDatosPaciente::where('id_persona', $values_validated['id_paciente'])->first('id_dato_paciente');
        $row_nutriologo_paciente = ApiNutriologoPaciente::where([
            ['id_nutriologo', '=', $id_nutriologo_anterior->id_nutriologo],
            ['id_paciente', '=', $id_dato_paciente->id_dato_paciente]
        ])->first();

        if (!$row_nutriologo_paciente) {
            session()->flash('message', 'Actualización fallida');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->route('director.inicio');
        }

        $row_nutriologo_paciente->id_nutriologo = $values_validated['id_nutriologo_nuevo'];
        $result = $row_nutriologo_paciente->update();
        // Supongamos que tienes una variable $operacionExitosa que es true si la operación fue exitosa y false en caso contrario
        if ($result) {
            session()->flash('message', 'Actualización exitosa');
            session()->flash('alert-class', 'alert-success');
        } else {
            session()->flash('message', 'Actualización fallida');
            session()->flash('alert-class', 'alert-danger');
        }

        return redirect()->route('director.inicio');
    }
}
