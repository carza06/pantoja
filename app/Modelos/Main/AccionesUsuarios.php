<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class AccionesUsuarios extends Model
{
    protected $table = 'acciones_usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idaccion','idusuario', 
    ];
}
