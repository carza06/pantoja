<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoLote extends Model
{
    protected $table = 'tipolote';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tipolote',
    ];
}
