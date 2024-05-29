<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiControlCita
 * 
 * @property int $id_cita
 * @property int $id_paciente
 * @property int $id_registro_consulta
 * @property float $peso
 * @property float $IMC
 * @property float $masa_grasa_corporal
 * @property float $porcentaje_grasa_corporal
 * @property float $masa_muscular_kg
 * @property float $agua_corpolar
 * @property int $circunferencia_cintura
 * @property int $circunferencia_cadera
 * @property Carbon $fecha_cita
 * @property Carbon $hora_cita
 * @property Carbon $fecha_prox_cita
 * @property float $control_musculo
 * @property float $control_grasa
 * 
 * @property ApiDatosPaciente $api_datos_paciente
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiControlCita extends Model
{
	protected $table = 'api_control_citas';
	protected $primaryKey = 'id_cita';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_cita' => 'int',
		'id_paciente' => 'int',
		'id_registro_consulta' => 'int',
		'peso' => 'float',
		'IMC' => 'float',
		'masa_grasa_corporal' => 'float',
		'porcentaje_grasa_corporal' => 'float',
		'masa_muscular_kg' => 'float',
		'agua_corpolar' => 'float',
		'circunferencia_cintura' => 'int',
		'circunferencia_cadera' => 'int',
		'fecha_cita' => 'datetime',
		'hora_cita' => 'datetime',
		'fecha_prox_cita' => 'datetime',
		'control_musculo' => 'float',
		'control_grasa' => 'float'
	];

	protected $fillable = [
		'id_paciente',
		'id_registro_consulta',
		'peso',
		'IMC',
		'masa_grasa_corporal',
		'porcentaje_grasa_corporal',
		'masa_muscular_kg',
		'agua_corpolar',
		'circunferencia_cintura',
		'circunferencia_cadera',
		'fecha_cita',
		'hora_cita',
		'fecha_prox_cita',
		'control_musculo',
		'control_grasa'
	];

	public function api_datos_paciente()
	{
		return $this->belongsTo(ApiDatosPaciente::class, 'id_paciente');
	}

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_registro_consulta');
	}
}
