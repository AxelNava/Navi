<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiResultadoDiagnostico
 * 
 * @property int $id_resultado
 * @property int $id_consulta_paciente
 * @property string|null $reque_ener
 * @property float $reque_proteina
 * @property float $reque_kg_dia
 * @property string $dx_nutricio
 * 
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiResultadoDiagnostico extends Model
{
	protected $table = 'api_resultado_diagnostico';
	protected $primaryKey = 'id_resultado';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_resultado' => 'int',
		'id_consulta_paciente' => 'int',
		'reque_proteina' => 'float',
		'reque_kg_dia' => 'float'
	];

	protected $fillable = [
		'id_consulta_paciente',
		'reque_ener',
		'reque_proteina',
		'reque_kg_dia',
		'dx_nutricio'
	];

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_consulta_paciente');
	}
}
