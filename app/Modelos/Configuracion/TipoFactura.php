<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoFactura extends Model
{
    protected $table = 'tipofactura';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'id',
		'tipofactura',
		'descripcion',
    ];
}
