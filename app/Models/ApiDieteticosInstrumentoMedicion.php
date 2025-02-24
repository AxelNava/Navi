<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class ApiDieteticosInstrumentoMedicion
 *
 * @property int $id_dietetico_instru
 * @property int $id_consulta_paciente
 * @property string|null $tipo_instrumento
 * @property Carbon $desayuno_hora
 * @property string $colacion1
 * @property Carbon $comida_hora
 * @property string $colacion2
 * @property Carbon $cena_hora
 * @property string $colacion3
 * @property string|null $grupo_total_eq
 * @property float $total_kcal
 * @property string|null $total_prot
 * @property string|null $total_lip
 * @property string|null $total_hco
 * @property float $adecuacion_porcen_ener_kcal
 * @property float $adecuacion_porcen_ene
 * @property float $adecuacion_porcen_prot
 * @property float $adecuacion_porcen_lip
 * @property float $adecuacion_porcen_hco
 * @property string $aspectos_cualita_dieta_habitual
 *
 * @property ApiRegistroConsulta $api_registro_consulta
 *
 * @package App\Models
 */
final class ApiDieteticosInstrumentoMedicion extends Model
{
    protected $table = 'api_dieteticos_instrumento_medicion';
    protected $primaryKey = 'id_dietetico_instru';
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'id_dietetico_instru' => 'int',
        'id_consulta_paciente' => 'int',
        'total_kcal' => 'float',
        'grupo_total_eq' => 'array',
        'total_prot_por' => 'float',
        'total_prot_g' => 'float',
        'total_lip' => 'float',
        'total_lip_g' => 'float',
        'total_hco' => 'float',
        'total_hco_g' => 'float',
        'adecuacion_porcen_ener_kcal' => 'float',
        'adecuacion_porcen_ene' => 'float',
        'adecuacion_porcen_prot' => 'float',
        'adecuacion_porcen_lip' => 'float',
        'adecuacion_porcen_hco' => 'float'
    ];

    protected $fillable = [
        'id_consulta_paciente',
        'tipo_instrumento',
        'desayuno_hora',
        'colacion1',
        'comida_hora',
        'colacion2',
        'cena_hora',
        'colacion3',
        'grupo_total_eq',
        'total_kcal',
        'total_prot_por',
        'total_prot_g' => 'float',
        'total_lip',
        'total_lip_g' => 'float',
        'total_hco',
        'total_hco_g' => 'float',
        'adecuacion_porcen_ener_kcal',
        'adecuacion_porcen_ene',
        'adecuacion_porcen_prot',
        'adecuacion_porcen_lip',
        'adecuacion_porcen_hco',
        'aspectos_cualita_dieta_habitual'
    ];

    public function api_registro_consulta(): BelongsTo
    {
        return $this->belongsTo(ApiRegistroConsulta::class, 'id_consulta_paciente');
    }
}
