<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrera
 * 
 * @property int $idCarrera
 * @property string $nombre
 * @property string $descripcion
 * 
 * @package App\Models
 */
class Carrera extends Model
{
    protected $table = 'carreras';
    protected $primaryKey = 'idCarrera';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}
