<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TarifasFamiliares extends Model
{
    protected $table = 'tarifafamiliares';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'idclasificadorinmueble',
		'idtiposector',
		'tarifa',
		'vigentedesde',
    ];
}
