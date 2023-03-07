<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class HistorialActualizacionTributo extends Model
{
    protected $table = 'historialactualizaciontributo';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'idsession',
		'idtributo',
		'campo',
		'valoranterior',
		'valornuevo',
    ];
}
