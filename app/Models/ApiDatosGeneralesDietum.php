<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiDatosGeneralesDietum
 * 
 * @property int $id_dieta
 * @property int $id_consulta_paciente
 * @property string|null $objetivos_dieta
 * @property string|null $tipo_dieta
 * @property float $kcal_dieta
 * @property float $prot_porcent_dieta
 * @property float $prot_kg_dia_dieta
 * @property float $lip_porcen_dieta
 * @property float $lip_g_dieta
 * @property float $hco_porcen_dieta
 * @property float $hco_g_dieta
 * @property string $suplementos
 * @property string $metas_smart
 * @property string|null $param_meta
 * @property string|null $educacion
 * @property string|null $monitoreo
 * 
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiDatosGeneralesDietum extends Model
{
	protected $table = 'api_datos_generales_dieta';
	protected $primaryKey = 'id_dieta';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_dieta' => 'int',
		'id_consulta_paciente' => 'int',
		'kcal_dieta' => 'float',
		'prot_porcent_dieta' => 'float',
		'prot_kg_dia_dieta' => 'float',
		'lip_porcen_dieta' => 'float',
		'lip_g_dieta' => 'float',
		'hco_porcen_dieta' => 'float',
		'hco_g_dieta' => 'float',
		'param_meta' => 'array',
	];

	protected $fillable = [
		'id_consulta_paciente',
		'objetivos_dieta',
		'tipo_dieta',
		'kcal_dieta',
		'prot_porcent_dieta',
		'prot_kg_dia_dieta',
		'lip_porcen_dieta',
		'lip_g_dieta',
		'hco_porcen_dieta',
		'hco_g_dieta',
		'suplementos',
		'metas_smart',
		'param_meta',
		'educacion',
		'monitoreo'
	];

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_consulta_paciente');
	}
}
