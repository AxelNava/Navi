<?php

namespace App\Models;

use App\enums\Genero as EnumsGenero;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ApiPersona
 *
 * @property int $persona_id
 * @property string $nombre
 * @property int $edad
 * @property string $genero
 *
 * @property Collection|ApiDatosNutriologo[] $api_datos_nutriologos
 * @property Collection|ApiDatosPaciente[] $api_datos_pacientes
 *
 * @package App\Models
 */
final class ApiPersona extends Model
{
    protected $table = 'api_personas';
    protected $primaryKey = 'persona_id';
    public $timestamps = false;

    protected $casts = [
        'edad' => 'int',
        'genero' => EnumsGenero::class,
    ];

    protected $fillable = [
        'nombre',
        'edad',
        'genero'
    ];

    public function api_datos_nutriologos():HasMany
    {
        return $this->hasMany(ApiDatosNutriologo::class, 'id_persona');
    }

    public function api_datos_pacientes():HasMany
    {
        return $this->hasMany(ApiDatosPaciente::class, 'id_persona');
    }
}
