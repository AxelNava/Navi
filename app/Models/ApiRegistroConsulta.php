<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ApiRegistroConsultum
 *
 * @property int $id_registro
 * @property int $no_consulta_paciente
 * @property int $id_paciente
 * @property string $motivo_consulta
 * @property string|null $sintoma_gastro
 * @property string|null $escala_bristol
 * @property string|null $otros_sintoma_gastro
 * @property string $apego_plan_anterior_barr_apego
 * @property string|null $motivacion
 * @property string $hidratacion
 * @property string $sintomas_generales
 * @property int $consulta_actual
 * @property string $clinicos
 * @property string|null $dinamometria
 * @property string|null $pendientes
 * @property string|null $nutri_elaborate_data
 * @property string|null $nutri_who_approved_data
 *
 * @property ApiDatosPaciente $api_datos_paciente
 * @property Collection|ApiBioquimico[] $api_bioquimicos
 * @property Collection|ApiControlCitas[] $api_control_citas
 * @property Collection|ApiDatosGeneralesDieta[] $api_datos_generales_dieta
 * @property Collection|ApiDieteticosFrecuenciaSemanal[] $api_dieteticos_frecuencia_semanals
 * @property Collection|ApiDieteticosInstrumentoMedicion[] $api_dieteticos_instrumento_medicions
 * @property Collection|ApiExploFisica[] $api_explo_fisicas
 * @package App\Models
 */
final class ApiRegistroConsulta extends Model
{
    protected $table = 'api_registro_consulta';
    protected $primaryKey = 'id_registro';
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'id_registro' => 'int',
        'no_consulta_paciente' => 'int',
        'id_paciente' => 'int',
        'consulta_actual' => 'int',
        'hidratacion' => 'array',
        'dinamometria' => 'array',
        'sintoma_gastro' => 'array',
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
        'consulta_actual',
        'clinicos',
        'dinamometria',
        'medicamentos_suplementos',
        'pendientes'
    ];

    public function api_datos_paciente(): BelongsTo
    {
        return $this->belongsTo(ApiDatosPaciente::class, 'id_paciente');
    }

    public function api_bioquimicos(): HasMany
    {
        return $this->hasMany(ApiBioquimico::class, 'id_consulta_paciente');
    }

//    public function api_composicion_corporal_diagnostico_obesidads(): HasMany
//    {
//        return $this->hasMany(ApiComposicionCorporalDiagnosticoObesidad::class, 'id_consulta_paciente');
//    }

    public function api_control_citas(): HasMany
    {
        return $this->hasMany(ApiControlCitas::class, 'id_registro_consulta');
    }

    public function api_datos_generales_dieta(): HasMany
    {
        return $this->hasMany(ApiDatosGeneralesDieta::class, 'id_consulta_paciente');
    }

    public function api_dieteticos_frecuencia_semanals(): HasMany
    {
        return $this->hasMany(ApiDieteticosFrecuenciaSemanal::class, 'id_consulta_paciente');
    }

    public function api_dieteticos_instrumento_medicions(): HasMany
    {
        return $this->hasMany(ApiDieteticosInstrumentoMedicion::class, 'id_consulta_paciente');
    }

    public function api_explo_fisicas(): HasMany
    {
        return $this->hasMany(ApiExploFisica::class, 'id_consulta_paciente');
    }

//    public function api_masa_magra_grasa_segmentals()
//    {
//        return $this->hasMany(ApiMasaMagraGrasaSegmental::class, 'id_registro');
//    }

//    public function api_resultado_diagnosticos()
//    {
//        return $this->hasMany(ApiResultadoDiagnostico::class, 'id_consulta_paciente');
//    }

}
