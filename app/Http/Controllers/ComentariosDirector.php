<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiComentarioDirector;
use App\Models\ApiControlCita;
use Illuminate\Support\Facades\Log;

class ComentariosDirector extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // $request->validate(
        //     [
        //         'id_registro' => ['required']
        //     ]
        // );
        $comentario = new ApiComentarioDirector();
        $comentario->id_registro = $request->id_registro;
        $comentario->comentario = $request->comentario;
        $comentario->save();
        return back()->with('success', 'Se ha guardado el comentario');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_paciente)
    {
        Log::info('id_paciente: ' . $id_paciente);
        $registros = ApiControlCita::where('id_paciente', $id_paciente)
            ->select('id_registro_consulta')->distinct()->get();
        $comentarios = ApiComentarioDirector::whereIn('id_registro', $registros)->get();
        return response()->json(['data' => $comentarios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'comentario' => 'required|accepted'
        ]);
        $comentario_director = new ApiComentarioDirector();
        $comentario_director->id = $id;
        $comentario_director->comentario = $request->comentario;
        $comentario_director->save();
        return view('')->with('success', 'Se ha actualizado el comentario');
    }
}
