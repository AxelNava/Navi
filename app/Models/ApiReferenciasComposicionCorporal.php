<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiReferenciasComposicionCorporal
 * 
 * @property int $id_ref_corp
 * @property string $nivel_composicion
 * @property float $valor_normal_inicio
 * @property float $valor_normal_fin
 * @property int $fin_nivel_bajo
 * @property int $fin_nivel_normal
 * @property float $fin_nivel_alto
 *
 * @package App\Models
 */
class ApiReferenciasComposicionCorporal extends Model
{
	protected $table = 'api_referencias_composicion_corporal';
	protected $primaryKey = 'id_ref_corp';
	public $timestamps = false;

	protected $casts = [
		'valor_normal_inicio' => 'float',
		'valor_normal_fin' => 'float',
		'fin_nivel_bajo' => 'int',
		'fin_nivel_normal' => 'int',
		'fin_nivel_alto' => 'float'
	];

	protected $fillable = [
		'nivel_composicion',
		'valor_normal_inicio',
		'valor_normal_fin',
		'fin_nivel_bajo',
		'fin_nivel_normal',
		'fin_nivel_alto'
	];
}
