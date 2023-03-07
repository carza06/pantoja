<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class ClasificadorPublicidad extends Model
{
    protected $table = 'clasificadorpublicidad';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','idstatus','idsession','idtipodepublicidad','idtipolocalizacion','descripcion',
        'monto','minimo','area','fraccion','caras','localizacion','unidad',
    ];
}
