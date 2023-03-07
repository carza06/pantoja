<?php

namespace App\Modelos\Facturacion;

use Illuminate\Database\Eloquent\Model;

class DetalleFacturaEspecial extends Model
{
    protected $table = 'detallefacturadsespecial';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'idfacturads  ',
		'tonelada',
		'saldoanterior',
		'monto',
	];
}
