<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiMasaMagraGrasaSegmental
 * 
 * @property float $id_masa
 * @property int $id_registro
 * @property float $brazo_derecho
 * @property float $brazo_izquierdo
 * @property string $brazo_derecho_evaluacion
 * @property string $brazo_izquierdo_evaluacion
 * @property float $tronco
 * @property string $tronco_evaluacion
 * @property float $pierna_derecha
 * @property float $pierna_izquierda
 * @property string $pierna_derecha_evaluacion
 * @property string $pierna_izquierda_evaluacion
 * @property float $brazo_grasa_derecho_porcen
 * @property float $brazo_grasa_derecho_valor
 * @property string $brazo_grasa_derecho_evaluacion
 * @property float $brazo_grasa_izquierdo_porcen
 * @property float $brazo_grasa_izquierdo_valor
 * @property string $brazo_grasa_izquierdo_evaluacion
 * @property float $tronco_grasa_porcen
 * @property float $tronco_grasa_valor
 * @property string|null $tronco_grasa_evaluacion
 * @property float $pierna_grasa_derecha_porcen
 * @property float $pierna_grasa_derecha_valor
 * @property string $pierna_grasa_derecha_evaluacion
 * @property float $pierna_grasa_izquierda_porcen
 * @property float $pierna_grasa_izquierda_valor
 * @property string $pierna_grasa_izquierda_evaluacion
 * 
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiMasaMagraGrasaSegmental extends Model
{
	protected $table = 'api_masa_magra_grasa_segmental';
	protected $primaryKey = 'id_masa';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_masa' => 'float',
		'id_registro' => 'int',
		'brazo_derecho' => 'float',
		'brazo_izquierdo' => 'float',
		'tronco' => 'float',
		'pierna_derecha' => 'float',
		'pierna_izquierda' => 'float',
		'brazo_grasa_derecho_porcen' => 'float',
		'brazo_grasa_derecho_valor' => 'float',
		'brazo_grasa_izquierdo_porcen' => 'float',
		'brazo_grasa_izquierdo_valor' => 'float',
		'tronco_grasa_porcen' => 'float',
		'tronco_grasa_valor' => 'float',
		'pierna_grasa_derecha_porcen' => 'float',
		'pierna_grasa_derecha_valor' => 'float',
		'pierna_grasa_izquierda_porcen' => 'float',
		'pierna_grasa_izquierda_valor' => 'float'
	];

	protected $fillable = [
		'id_registro',
		'brazo_derecho',
		'brazo_izquierdo',
		'brazo_derecho_evaluacion',
		'brazo_izquierdo_evaluacion',
		'tronco',
		'tronco_evaluacion',
		'pierna_derecha',
		'pierna_izquierda',
		'pierna_derecha_evaluacion',
		'pierna_izquierda_evaluacion',
		'brazo_grasa_derecho_porcen',
		'brazo_grasa_derecho_valor',
		'brazo_grasa_derecho_evaluacion',
		'brazo_grasa_izquierdo_porcen',
		'brazo_grasa_izquierdo_valor',
		'brazo_grasa_izquierdo_evaluacion',
		'tronco_grasa_porcen',
		'tronco_grasa_valor',
		'tronco_grasa_evaluacion',
		'pierna_grasa_derecha_porcen',
		'pierna_grasa_derecha_valor',
		'pierna_grasa_derecha_evaluacion',
		'pierna_grasa_izquierda_porcen',
		'pierna_grasa_izquierda_valor',
		'pierna_grasa_izquierda_evaluacion'
	];

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_registro');
	}
}
