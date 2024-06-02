<?php

namespace App\Http\Controllers;

use App\Models\ApiDatosNutriologo;
use App\Models\ApiPersona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AltaNutriologo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
			'nombre' => ['required', 'string', 'max:255'],
			'apellido' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
			'password' => ['required', 'string', 'min:8'],
		]);
        $person = new ApiPersona();
        $nutriologo = new ApiDatosNutriologo();

        $person->nombre = $request->nombre . $request->apellido;
        $person->edad = $request->edad;
        $person->genero = $request->sexo;
        $person->save();
        
        $nutriologo->datos_alumno = '""';
        $nutriologo->id_persona = $person->persona_id;
        $nutriologo->save();
       

		$user = User::create([
			'nombre' => $request->nombre,
			'apellido' => $request->apellido,
            'persona_id' =>$person->persona_id,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		//darle el rol de alumno
		$user->assignRole('alumno');

		session()->flash('success', 'Alumno registrado correctamente');
		return redirect()->route('director.inicio');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
