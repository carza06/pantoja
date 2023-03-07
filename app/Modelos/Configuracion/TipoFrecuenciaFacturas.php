<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoFrecuenciaFacturas extends Model
{
    protected $table = 'tipofrecuenciafacturas';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'frecuencia', 
    ];
}
