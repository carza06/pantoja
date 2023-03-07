<?php

namespace App\Modelos\Facturacion;

use Illuminate\Database\Eloquent\Model;

class PeriodosFacturados extends Model
{
    //
    protected $table = 'periodosfacturados';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
        'idsession',
		'idperiodomensual',
        'idtipofactura',
		'nrofacturas',
        'deudamorosa',
        'montomes',
		'montototal',
	];

	public function periodomensual()
    {
        return $this->belongsTo('App\Modelos\Configuracion\PeriodosMensuales','idperiodomensual');
    }

    public function tipofactura()
    {
        return $this->belongsTo('App\Modelos\Configuracion\TipoFactura','idtipofactura');
    }
}
