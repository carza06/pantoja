<?php

namespace App\Modelos\Facturacion;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = 'detallefactura';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'idfactura',
		'categoria',
        'concepto',
		'saldo',
		'monto',
	];
}
