<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiDatosNutriologo
 * 
 * @property int $id_nutriologo
 * @property int $id_persona
 * @property string $datos_alumno
 * 
 * @property ApiPersona $api_persona
 *
 * @package App\Models
 */
class ApiDatosNutriologo extends Model
{
	protected $table = 'api_datos_nutriologo';
	protected $primaryKey = 'id_nutriologo';
	public $timestamps = false;

	protected $casts = [
		'id_persona' => 'int'
	];

	protected $fillable = [
		'id_persona',
		'datos_alumno'
	];

	public function api_persona()
	{
		return $this->belongsTo(ApiPersona::class, 'id_persona');
	}
	public function api_nutriologo_paciente(){
		return $this->hasMany(ApiNutriologoPaciente::class, 'id_nutriologo');
	}
}
