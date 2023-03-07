<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    protected $table = 'bancos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'idstatus',
		'banco',
		'codico',
		'codigotransaccion',
		
    ];
}
