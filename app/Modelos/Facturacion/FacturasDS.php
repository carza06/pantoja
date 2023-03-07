<?php

namespace App\Modelos\Facturacion;

use Illuminate\Database\Eloquent\Model;

class FacturasDS extends Model
{
    protected $table = 'facturasds';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'idsession',
		'idperiodomensual',
		'codigouso',
		'usosuelo',
		'idinm',
		'idvia',
		'idbarrio',
		'idsector',
		'numero',
		'direccion',
		'sujetopasivo',
	];
    public function sector()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Sectores','idsector');  

    }
    public function barrio()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Barrios','idbarrio');  

    }
    public function via()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Vias','idvia');  

    }
    public function periodo()
    {
        return $this->belongsTo('App\Modelos\Configuracion\PeriodosMensuales','idperiodomensual');  

    }

    public function detalle()
    {
        return $this->hasMany('App\Modelos\Facturacion\DetalleFactura','idfacturads','id');  

    }

    public function detalleespecial()
    {
        return $this->hasMany('App\Modelos\Facturacion\DetalleFacturaEspecial','idfacturads','id');  

    }
}
