<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiDieteticosFrecuenciaSemanal
 * 
 * @property int $id_dietetico
 * @property int $id_consulta_paciente
 * @property int $frutas
 * @property int $verduras
 * @property int $cereales_s_g
 * @property int $cereales_c_g
 * @property int $leguminosas
 * @property int $poa
 * @property int $lacteos
 * @property int $aceites_s_p
 * @property int $aceites_c_p
 * @property int $azucares
 * 
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiDieteticosFrecuenciaSemanal extends Model
{
	protected $table = 'api_dieteticos_frecuencia_semanal';
	protected $primaryKey = 'id_dietetico';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_dietetico' => 'int',
		'id_consulta_paciente' => 'int',
		'frutas' => 'int',
		'verduras' => 'int',
		'cereales_s_g' => 'int',
		'cereales_c_g' => 'int',
		'leguminosas' => 'int',
		'poa' => 'int',
		'lacteos' => 'int',
		'aceites_s_p' => 'int',
		'aceites_c_p' => 'int',
		'azucares' => 'int'
	];

	protected $fillable = [
		'id_consulta_paciente',
		'frutas',
		'verduras',
		'cereales_s_g',
		'cereales_c_g',
		'leguminosas',
		'poa',
		'lacteos',
		'aceites_s_p',
		'aceites_c_p',
		'azucares'
	];

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_consulta_paciente');
	}
}
