<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoActividades extends Model
{
    protected $table = 'tipoactividad';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','idtipolicencia','actividad','produccionds',
    ];
}
