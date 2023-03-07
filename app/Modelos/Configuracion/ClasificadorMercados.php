<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class ClasificadorMercados extends Model
{
    protected $table = 'clasificadormercados';
    
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
