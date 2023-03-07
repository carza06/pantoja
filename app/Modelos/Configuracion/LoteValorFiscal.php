<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class LoteValorFiscal extends Model
{
    protected $table = 'lotevalorfiscal';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idlotefiscal',
		'valorfiscal',
		'asignado', 
    ];

   
}
