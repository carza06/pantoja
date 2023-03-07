<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Sectores extends Model
{
    protected $table = 'sectores';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'idsession', 'idtiposector', 'sector', 'codcatastro',
    ];

    public function tiposector()
    {
        return $this->belongsto('App\Modelos\Configuracion\TipoSectores','idtiposector');  

    }

    public function session()
    {
        return $this->hasOne('App\Modelos\Main\Session','id','idsession');  

    }

    public function barrio()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Barrios','sector_barrio','idsector','idbarrio');
    }

    public function SectorFacturas()
    {
        return $this->hasMany('App\Modelos\Facturacion\Facturas','idsector');
    }

    public function scopeFacturasMonto($query,$id,$idpm,$idtf)
    {
        $query->join('facturas as f','sectores.id','=','f.idsector')
              ->join('detallefactura as df','f.id','=','df.idfactura')
              ->where('f.idperiodomensual','=',$idpm)
              ->where('f.idtipofactura','=',$idtf)               
              ->where('sectores.id','=',$id) ;                          
        return $query; 
    }
}
