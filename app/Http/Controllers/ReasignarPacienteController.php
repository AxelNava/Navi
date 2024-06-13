<?php

namespace App\Http\Controllers;

use App\Models\ApiDatosNutriologo;
use Illuminate\Http\Request;

class ReasignarPacienteController extends Controller
{
    public function reasignarPaciente(Request $request)
    {
        $id_alumno = $request->id_alumno;
        $id_paciente = $request->id_paciente;
        //Nutriologo activos
        $nutriologos = ApiDatosNutriologo::where('status_alumno','activo')->all();
        return view('director.reasignar_paciente', compact('id_alumno', 'id_paciente', 'nutriologos'));
    }

    public function actualizarReasignar()
    {
        // Realiza las operaciones necesarias
        $operacionExitosa = true;
        // Supongamos que tienes una variable $operacionExitosa que es true si la operación fue exitosa y false en caso contrario
        if ($operacionExitosa) {
            session()->flash('message', 'Actualización exitosa');
            session()->flash('alert-class', 'alert-success');
        } else {
            session()->flash('message', 'Actualización fallida');
            session()->flash('alert-class', 'alert-danger');
        }

        return redirect()->route('director.inicio');
    }
}
