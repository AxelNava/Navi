<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiRegistroConsultum
 * 
 * @property int $id_registro
 * @property int $no_consulta_paciente
 * @property int $id_paciente
 * @property string $motivo_consulta
 * @property string|null $sintoma_gastro
 * @property string $apego_plan_anterior_barr_apego
 * @property string|null $motivacion
 * @property string $hidratacion
 * @property string $sintomas_generales
 * @property int $consulta_actual
 * 
 * @property ApiDatosPaciente $api_datos_paciente
 * @property Collection|ApiBioquimico[] $api_bioquimicos
 * @property Collection|ApiComposicionCorporalDiagnosticoObesidad[] $api_composicion_corporal_diagnostico_obesidads
 * @property Collection|ApiControlCita[] $api_control_citas
 * @property Collection|ApiDatosGeneralesDietum[] $api_datos_generales_dieta
 * @property Collection|ApiDieteticosFrecuenciaSemanal[] $api_dieteticos_frecuencia_semanals
 * @property Collection|ApiDieteticosInstrumentoMedicion[] $api_dieteticos_instrumento_medicions
 * @property Collection|ApiExploFisica[] $api_explo_fisicas
 * @property Collection|ApiMasaMagraGrasaSegmental[] $api_masa_magra_grasa_segmentals
 * @property Collection|ApiResultadoDiagnostico[] $api_resultado_diagnosticos
 *
 * @package App\Models
 */
class ApiRegistroConsultum extends Model
{
	protected $table = 'api_registro_consulta';
	protected $primaryKey = 'id_registro';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_registro' => 'int',
		'no_consulta_paciente' => 'int',
		'id_paciente' => 'int',
		'consulta_actual' => 'int'
	];

	protected $fillable = [
		'no_consulta_paciente',
		'id_paciente',
		'motivo_consulta',
		'sintoma_gastro',
		'apego_plan_anterior_barr_apego',
		'motivacion',
		'hidratacion',
		'sintomas_generales',
		'consulta_actual'
	];

	public function api_datos_paciente()
	{
		return $this->belongsTo(ApiDatosPaciente::class, 'id_paciente');
	}

	public function api_bioquimicos()
	{
		return $this->hasMany(ApiBioquimico::class, 'id_consulta_paciente');
	}

	public function api_composicion_corporal_diagnostico_obesidads()
	{
		return $this->hasMany(ApiComposicionCorporalDiagnosticoObesidad::class, 'id_consulta_paciente');
	}

	public function api_control_citas()
	{
		return $this->hasMany(ApiControlCita::class, 'id_registro_consulta');
	}

	public function api_datos_generales_dieta()
	{
		return $this->hasMany(ApiDatosGeneralesDietum::class, 'id_consulta_paciente');
	}

	public function api_dieteticos_frecuencia_semanals()
	{
		return $this->hasMany(ApiDieteticosFrecuenciaSemanal::class, 'id_consulta_paciente');
	}

	public function api_dieteticos_instrumento_medicions()
	{
		return $this->hasMany(ApiDieteticosInstrumentoMedicion::class, 'id_consulta_paciente');
	}

	public function api_explo_fisicas()
	{
		return $this->hasMany(ApiExploFisica::class, 'id_consulta_paciente');
	}

	public function api_masa_magra_grasa_segmentals()
	{
		return $this->hasMany(ApiMasaMagraGrasaSegmental::class, 'id_registro');
	}

	public function api_resultado_diagnosticos()
	{
		return $this->hasMany(ApiResultadoDiagnostico::class, 'id_consulta_paciente');
	}
}
