<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class HistorialAnulacionMovEdo extends Model
{
	protected $table = 'historialanulacionmovedo';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'idsession',
		'idmovedo',
		'motivo',
    ];
}
