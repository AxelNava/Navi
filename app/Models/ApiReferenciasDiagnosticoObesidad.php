<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiReferenciasDiagnosticoObesidad
 * 
 * @property int $id_referencia_obe
 * @property float $valor_normal_inicio
 * @property float $valor_normal_final
 *
 * @package App\Models
 */
class ApiReferenciasDiagnosticoObesidad extends Model
{
	protected $table = 'api_referencias_diagnostico_obesidad';
	protected $primaryKey = 'id_referencia_obe';
	public $timestamps = false;

	protected $casts = [
		'valor_normal_inicio' => 'float',
		'valor_normal_final' => 'float'
	];

	protected $fillable = [
		'valor_normal_inicio',
		'valor_normal_final'
	];
}
