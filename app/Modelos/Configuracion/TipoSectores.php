<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoSectores extends Model
{
    protected $table = 'tiposectores';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipo', 'descripcion', 'ingresominimo', 'ingresomaximo',
    ];
}
