<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class ApiExploFisica
 *
 * @property int $id_explo
 * @property int $id_consulta_paciente
 * @property string|null $pelo_unias
 * @property string $piel
 * @property string $ojos
 * @property string $musculo
 * @property string|null $otros
 * @property string $intolerancia_alimentos
 * @property string $actividad_fis_actual
 * @property string|null $cambios_pos_estilo_vida
 *
 * @property ApiRegistroConsulta $api_registro_consulta
 *
 * @package App\Models
 */
final class ApiExploFisica extends Model
{
    protected $table = 'api_explo_fisica';
    protected $primaryKey = 'id_explo';
    public $timestamps = false;

    protected $casts = [
        'id_consulta_paciente' => 'int'
    ];

    protected $fillable = [
        'id_consulta_paciente',
        'pelo_unias',
        'piel',
        'ojos',
        'musculo',
        'otros',
        'intolerancia_alimentos',
        'actividad_fis_actual',
        'cambios_pos_estilo_vida'
    ];

    public function api_registro_consulta(): BelongsTo
    {
        return $this->belongsTo(ApiRegistroConsulta::class, 'id_consulta_paciente');
    }
}
