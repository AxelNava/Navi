<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiDatosPaciente
 * 
 * @property int $id_dato_paciente
 * @property int $id_persona
 * @property int $expediente
 * @property Carbon $fecha_nacimiento
 * 
 * @property ApiPersona $api_persona
 * @property Collection|ApiControlCita[] $api_control_citas
 * @property Collection|ApiRegistroConsultum[] $api_registro_consulta
 *
 * @package App\Models
 */
class ApiDatosPaciente extends Model
{
	protected $table = 'api_datos_paciente';
	protected $primaryKey = 'id_dato_paciente';
	public $timestamps = false;

	protected $casts = [
		'id_persona' => 'int',
		'expediente' => 'int',
		'fecha_nacimiento' => 'datetime'
	];

	protected $fillable = [
		'id_persona',
		'expediente',
		'fecha_nacimiento'
	];

	public function api_persona()
	{
		return $this->belongsTo(ApiPersona::class, 'id_persona');
	}

	public function api_control_citas()
	{
		return $this->hasMany(ApiControlCita::class, 'id_paciente');
	}

	public function api_registro_consulta()
	{
		return $this->hasMany(ApiRegistroConsultum::class, 'id_paciente');
	}
}
