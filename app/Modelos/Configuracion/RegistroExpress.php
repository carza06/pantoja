<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class RegistroExpress extends Model
{
    protected $table = 'registroexpress';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'id',
		'idhi',
		'tiporegistro',
		'route',

    ];
}
