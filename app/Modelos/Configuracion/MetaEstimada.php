<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class MetaEstimada extends Model
{
    protected $table = 'metaestimada';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'mes', 'anio', 'estimado', 
    ];

}
