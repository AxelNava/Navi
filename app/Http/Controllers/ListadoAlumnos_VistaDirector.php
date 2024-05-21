<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiDatosNutriologo;
use App\Models\ApiPersona;

class ListadoAlumnos_VistaDirector extends Controller
{
    public function enlistar(){
        //La obtencion del user queda pendiente
        
        //Obtener cantidad total de alumnos
        $cantidadAlumnos = ApiDatosNutriologo::count();

        //Obtener datos de los Nutriologos activos --- idPersona -> ID/Nombre/Edad/Genero -> datos_alumno
        $idPersona = ApiDatosNutriologo::pluck('id_persona');
        $alumnos = ApiPersona::whereIn('persona_id', $idPersona)->get()->keyBy('persona_id');
        $datosAlumnos = ApiDatosNutriologo::select('id_nutriologo', 'id_persona', 'datos_alumno')->get();

        // Combinar los datos en la estructura deseada
        $resultado = $datosAlumnos->map(function ($item) use ($alumnos) {
            return [
                'Nutriologo' => $alumnos->get($item->id_persona),
                'Datos del alumno' => $item->datos_alumno,
                'ID Nutriologo' => $item->id_nutriologo
            ];
        });

        return response()->json([
            'Total de alumnos' => $cantidadAlumnos,
            'Nutriologos' => $resultado
        ]);
    }
}
