<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiComposicionCorporalDiagnosticoObesidad
 * 
 * @property int $id_comp_corp
 * @property int $id_consulta_paciente
 * @property float $peso
 * @property float $masa_muscular
 * @property float $mas_grasa_corporal
 * @property float $act
 * @property float $imc
 * @property float $pgc
 * @property float $rcc
 * @property int $metabolismo_kcal_basal
 * 
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiComposicionCorporalDiagnosticoObesidad extends Model
{
	protected $table = 'api_composicion_corporal_diagnostico_obesidad';
	protected $primaryKey = 'id_comp_corp';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_comp_corp' => 'int',
		'id_consulta_paciente' => 'int',
		'peso' => 'float',
		'masa_muscular' => 'float',
		'mas_grasa_corporal' => 'float',
		'act' => 'float',
		'imc' => 'float',
		'pgc' => 'float',
		'rcc' => 'float',
		'metabolismo_kcal_basal' => 'int'
	];

	protected $fillable = [
		'id_consulta_paciente',
		'peso',
		'masa_muscular',
		'mas_grasa_corporal',
		'act',
		'imc',
		'pgc',
		'rcc',
		'metabolismo_kcal_basal'
	];

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_consulta_paciente');
	}
}
