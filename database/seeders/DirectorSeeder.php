<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

final class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        if (!Schema::hasTable('users')) {
            throw new \Exception("No existe la tabla persona, no se hará nada");
        };

        $nombre_director = 'Director';
        $apellido = 'Mendez';

        $data_persona = [
            'nombre' => $nombre_director,
            'edad' => 0,
            'genero' => 'M',
        ];
        DB::table('api_personas')->insert($data_persona);

        $persona_id = DB::table('api_personas')
            ->where('nombre', $nombre_director)->value('persona_id');

        $user = new User();
        $user->assignRole('director');
        $user->nombre = $nombre_director;
        $user->apellido = $apellido;
        $user->email = 'director@udem.com';
        $user->persona_id = $persona_id;
        $user->password = Hash::make('director12345');
        $user->save();
    }
}
