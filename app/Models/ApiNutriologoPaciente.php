<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class ApiNutriologoPaciente
 *
 * @property int $id_primaria
 * @property int|null $id_paciente
 * @property int|null $id_nutriologo
 *
 * @property ApiDatosNutriologo|null $api_datos_nutriologo
 * @property ApiDatosPaciente|null $api_datos_paciente
 *
 * @package App\Models
 */
final class ApiNutriologoPaciente extends Model
{
    protected $table = 'api_nutriologo_pacientes';
    protected $primaryKey = 'id_primaria';
    public $timestamps = false;

    protected $casts = [
        'id_paciente' => 'int',
        'id_nutriologo' => 'int'
    ];

    protected $fillable = [
        'id_paciente',
        'id_nutriologo'
    ];

    public function api_datos_nutriologo(): BelongsTo
    {
        return $this->belongsTo(ApiDatosNutriologo::class, 'id_nutriologo');
    }

    public function api_datos_paciente(): BelongsTo
    {
        return $this->belongsTo(ApiDatosPaciente::class, 'id_paciente');
    }
}
