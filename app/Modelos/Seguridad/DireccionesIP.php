<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class DireccionesIP extends Model
{
    protected $table = 'direccionip';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','idcam', 'idstatus', 'ip', 'nombremaquina',
    ];
}
