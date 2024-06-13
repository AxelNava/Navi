<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiDatosNutriologo;
use App\Models\ApiPersona;

class StatusAlumno extends Controller
{
    public function get_status(int $id_nutriologo)
    {
        $alumno = ApiDatosNutriologo::where('id_nutriologo', $id_nutriologo)->first();
        $nombre_alumno = ApiPersona::where('persona_id', $alumno->id_persona)->first()->nombre;
        return response()->json(['alumno' => $alumno, 'nombre_alumno']);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = ApiDatosNutriologo::where('id_nutriologo', $id)->first();
        $nombre_alumno = ApiPersona::where('persona_id', $alumno->id_persona)->first()->nombre;
        return view('director.modificar_status_alumno', compact('id', 'alumno', 'nombre_alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_alumno' => 'required'
        ]);
        $status_alumno = ApiDatosNutriologo::find($id);
        $status_alumno->status_alumno = $request->status_alumno;
        $status_alumno->save();
        return redirect()->route(
            'director-lista-pacientes-alumno-view',
            $status_alumno->id_nutriologo
        );
    }
}
