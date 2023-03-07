<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Vias extends Model
{
    //
    protected $table = 'vias';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'idtipovia', 'idtipoclasificacionvia', 'nombre',
    ];

    public function tipovia()
    {
        return $this->belongsto('App\Modelos\Configuracion\TipoVias','idtipovia');  

    }

    public function tipoclavia()
    {
        return $this->belongsto('App\Modelos\Configuracion\TipoClasificacionVias','idtipoclasificacionvia');  

    }

    public function barrio()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Barrios','barrio_via','idvia','idbarrio');
    }    
    public function scopeIdvia($query,$idvia)
    {
       
        $query->select('idtipoclasificacionvia')
              ->where('id', $idvia);
    }

        public function ViaFacturas()
    {
        return $this->hasMany('App\Modelos\Facturacion\FacturasDS','idvia');
    }

    public function scopeFacturasMonto($query,$id,$idpm,$idtf)
    {
        $query->join('facturasds as f','vias.id','=','f.idvia')
              ->join('detallefacturads as df','f.id','=','df.idfacturads')
              ->where('f.idperiodomensual','=',$idpm)
              ->where('f.idtipofactura','=',$idtf)              
              ->where('vias.id','=',$id) ;                          
        return $query; 
    }
}
