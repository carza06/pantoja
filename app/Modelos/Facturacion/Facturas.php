<?php

namespace App\Modelos\Facturacion;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $table = 'facturas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'idsession',
        'idperiodoinicial',
		'idperiodomensual',
		'codigouso',
		'usosuelo',
		'idinm',
		'idvia',
		'idbarrio',
		'idsector',
    'idlotevalorfiscal',
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

    public function periodo()
    {
        return $this->belongsTo('App\Modelos\Configuracion\PeriodosMensuales','idperiodomensual');  

    }
    public function periodoinicial()
    {
        return $this->belongsTo('App\Modelos\Configuracion\PeriodosMensuales','idperiodoinicial');  

    }
    public function valorfiscal()
    {
        return $this->belongsTo('App\Modelos\Configuracion\LoteValorFiscal','idlotevalorfiscal');  

    }
    public function detalle()
    {
        return $this->hasMany('App\Modelos\Facturacion\DetalleFactura','idfactura','id');  

    }

    public function detalleespecial()
    {
        return $this->hasMany('App\Modelos\Facturacion\DetalleFacturaEspecial','idfacturads','id');  

    }

    public function scopeSectorFacturas($query,$id)
    {
        $query->select('s.sector')
              ->join('sectores as s','s.id','=','facturas.idsector')
              ->join('detallefactura as df','facturas.id','=','df.idfactura')
              ->where('facturas.idperiodomensual','=',$id)
              ->count('facturas.idsector')
              ->groupby('s.sector');                          
        return $query;  

    }
}
