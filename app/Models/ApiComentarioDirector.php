<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiRegistroConsultum
 * 
 * @property int $id
 * @property int $comentario
 * @property int $id_registro
*/

class ApiComentarioDirector extends Model
{
    use HasFactory;
    protected $table = 'api_comentarios_director';
	protected $primaryKey = 'id_registro';
	public $incrementing = true;
    protected $fillable = [
		'comentario',
		'id_registro',
	];
}
