<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class ClasificadorAmbienteDrenaje extends Model
{
    protected $table = 'clasificadorambienteydrenaje';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'idtipoactividad',
		'idzonamercado',
		'monto',
    ];
}

