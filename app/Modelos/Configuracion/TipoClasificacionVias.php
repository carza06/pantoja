<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoClasificacionVias extends Model
{
    protected $table = 'tipoclasificacionvias';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipoclasificacion', 
    ];
}
