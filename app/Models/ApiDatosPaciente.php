<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ApiDatosPaciente
 *
 * @property int $id_dato_paciente
 * @property int $id_persona
 * @property int $expediente
 * @property Carbon $fecha_nacimiento
 *
 * @property ApiPersona $api_persona
 * @property Collection|ApiControlCitas[] $api_control_citas
 * @property Collection|ApiRegistroConsulta[] $api_registro_consulta
 *
 * @package App\Models
 */
final class ApiDatosPaciente extends Model
{
    protected $table = 'api_datos_pacientes';
    protected $primaryKey = 'id_dato_paciente';
    public $timestamps = false;

    protected $casts = [
        'id_persona' => 'int',
        'expediente' => 'int',
    ];

    protected $fillable = [
        'id_persona',
        'expediente',
        'fecha_nacimiento'
    ];

    public function api_persona(): BelongsTo
    {
        return $this->belongsTo(ApiPersona::class, 'id_persona');
    }

    public function api_control_citas(): HasMany
    {
        return $this->hasMany(ApiControlCitas::class, 'id_paciente');
    }

    public function api_registro_consulta(): HasMany
    {
        return $this->hasMany(ApiRegistroConsulta::class, 'id_paciente');
    }

    public function api_nutriologo_paciente(): BelongsTo
    {
        return $this->belongsTo(ApiNutriologoPaciente::class, 'id_paciente');
    }
}
