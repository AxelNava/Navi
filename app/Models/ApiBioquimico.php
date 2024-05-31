<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiBioquimico
 * 
 * @property int $id_bioquimico
 * @property int $id_consulta_paciente
 * @property int $glucosa
 * @property int $hbAc1
 * @property float $TG
 * @property float $CT
 * @property float $HDL
 * @property float $LDL
 * @property int $AST_perc
 * @property float $ALT
 * @property float $THS
 * @property float $T3
 * @property float $T4
 * @property float $Hb
 * @property float $hierro
 * @property float $transferrina
 * @property float $t3_libre
 * @property float $t4_libre
 * @property int $hto
 * @property float $B12
 * @property float $folatos
 * @property float $PT
 * @property float $albumina
 * @property float $Ca
 * @property string $otros
 * 
 * @property ApiRegistroConsultum $api_registro_consultum
 *
 * @package App\Models
 */
class ApiBioquimico extends Model
{
	protected $table = 'api_bioquimicos';
	protected $primaryKey = 'id_bioquimico';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_bioquimico' => 'int',
		'id_consulta_paciente' => 'int',
		'glucosa' => 'int',
		'hbAc1' => 'int',
		'TG' => 'float',
		'CT' => 'float',
		'HDL' => 'float',
		'LDL' => 'float',
		'AST_perc' => 'int',
		'ALT' => 'float',
		'THS' => 'float',
		'T3' => 'float',
		'T4' => 'float',
		'Hb' => 'float',
		'hierro' => 'float',
		'transferrina' => 'float',
		't3_libre' => 'float',
		't4_libre' => 'float',
		'hto' => 'int',
		'B12' => 'float',
		'folatos' => 'float',
		'PT' => 'float',
		'albumina' => 'float',
		'Ca' => 'float',
	];

	protected $fillable = [
		'id_consulta_paciente',
		'glucosa',
		'hbAc1',
		'TG',
		'CT',
		'HDL',
		'LDL',
		'AST_perc',
		'ALT',
		'THS',
		'T3',
		'T4',
		'Hb',
		'hierro',
		'transferrina',
		't3_libre',
		't4_libre',
		'hto',
		'B12',
		'folatos',
		'PT',
		'albumina',
		'Ca',
		'otros',
	];

	public function api_registro_consultum()
	{
		return $this->belongsTo(ApiRegistroConsultum::class, 'id_consulta_paciente');
	}
}
