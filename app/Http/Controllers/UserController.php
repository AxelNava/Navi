<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function createUser(Request $request)
	{
		$request->validate([
			'nombre' => ['required', 'string', 'max:255'],
			'apellido' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
			'password' => ['required', 'string', 'min:8'],
		]);

		$user = User::create([
			'nombre' => $request->nombre,
			'apellido' => $request->apellido,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		//darle el rol de alumno
		$user->assignRole('alumno');

		session()->flash('success', 'Alumno registrado correctamente');
		return redirect()->route('director.inicio');
	}
}
