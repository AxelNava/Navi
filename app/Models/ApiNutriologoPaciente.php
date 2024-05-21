<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiNutriologoPaciente
 * 
 * @property int $id_primaria
 * @property int|null $id_paciente
 * @property int|null $id_nutriologo
 * 
 * @property ApiDatosNutriologo|null $api_datos_nutriologo
 * @property ApiDatosPaciente|null $api_datos_paciente
 *
 * @package App\Models
 */
class ApiNutriologoPaciente extends Model
{
	protected $table = 'api_nutriologo_paciente';
	protected $primaryKey = 'id_primaria';
	public $timestamps = false;

	protected $casts = [
		'id_paciente' => 'int',
		'id_nutriologo' => 'int'
	];

	protected $fillable = [
		'id_paciente',
		'id_nutriologo'
	];

	public function api_datos_nutriologo()
	{
		return $this->belongsTo(ApiDatosNutriologo::class, 'id_nutriologo');
	}

	public function api_datos_paciente()
	{
		return $this->belongsTo(ApiDatosPaciente::class, 'id_paciente');
	}
}
