<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class ClasificadorInm extends Model
{
    protected $table = 'clasificadorinm';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'idusoinmueble',
		'clasificacion',
		'descripcion',
		'desdemt2',
		'hastamt2',
    ];
}

