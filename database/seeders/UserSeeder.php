<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$data = [
			[
				'nombre' => 'Director',
				'persona_id' => 42,
				'apellido' => '',
				'email' => 'director@udem.com',
				'password' => Hash::make('Director12345')
			],
			[
				'nombre' => 'Diego',
				'persona_id' => 32,
				'apellido' => 'Mendoza',
				'email' => 'diegomendoza@udem.com',
				'password' => Hash::make('Diego12345')
			]
		];
		DB::table('users')->insert($data);
		//insertar los roles
		$data_role = [
			[
				'role_id' => 1,
				'model_type' => 'App\Models\User',
				'model_id' => 1
			],
			[
				'role_id' => 2,
				'model_type' => 'App\Models\User',
				'model_id' => 2
			]
		];
		DB::table('model_has_roles')->insert($data_role);
	}
}
