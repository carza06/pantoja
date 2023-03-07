<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Barrios extends Model
{
    protected $table = 'barrios';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'barrio', 'codigo',
    ];



        public function sector()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Sectores','sector_barrio','idbarrio','idsector');
    } 

    public function BarrioFacturas()
    {
        return $this->hasMany('App\Modelos\Facturacion\Facturas','idbarrio');
    }

    public function scopeFacturasMonto($query,$id,$idsec,$idpm,$idtf)
    {
        $query->join('facturas as f','barrios.id','=','f.idbarrio')
              ->join('detallefactura as df','f.id','=','df.idfactura')
              ->where('f.idsector','=',$idsec)
              ->where('f.idperiodomensual','=',$idpm)
              ->where('f.idtipofactura','=',$idtf)                
              ->where('barrios.id','=',$id) ;                          
        return $query; 
    }
}
