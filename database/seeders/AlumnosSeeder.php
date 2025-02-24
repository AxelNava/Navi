<?php

namespace Database\Seeders;

use App\enums\Genero;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

final class AlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('users')) {
            throw new \Exception("No existe la tabla persona, no se hará nada");
        };

        $nombre_alumno = 'Axel';
        $apellido = 'apellido';
        $edad = 21;
        $genero = Genero::MASCULINO->value;
        $email = 'email@email.com';
        $password = 'password';

        $data_persona = [
            'nombre' => $nombre_alumno,
            'edad' => $edad,
            'genero' => $genero,
        ];
        DB::table('api_personas')->insert($data_persona);

        $persona_id = DB::table('api_personas')
            ->where('nombre', $nombre_alumno)->value('persona_id');

        $user = new User();
        $user->assignRole('alumno');
        $user->nombre = $nombre_alumno;
        $user->apellido = $apellido;
        $user->email = $email;
        $user->persona_id = $persona_id;
        $user->password = Hash::make($password);
        $user->save();


    }
}
