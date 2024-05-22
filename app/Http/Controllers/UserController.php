<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        dd($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        session()->flash('success', 'Alumno registrado correctamente');
        return redirect()->route('director.inicio');
        /*return response()->json([
            'success' => true,
            'user' => $user,
            'message' => 'User created successfully'
        ]);*/
    }
}
