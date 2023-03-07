<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class HistorialActualizacionSP extends Model
{
    protected $table = 'historialactualizacionsp';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'idsession',
		'idsujetopasivo',
		'campo',
		'valoranterior',
		'valornuevo',
    ];
}
