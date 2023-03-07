<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    protected $table = 'cuentas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','idtipocuenta','codigo', 'descripcion',
    ];

    public function scopeCatalogo($query){
   
    $query->join('tiposmovimientosedo as tmedo','cuentas.id','=','tmedo.idcuenta')
          ->join('estadosdecuentas as edo','edo.idtipomovimientoedo','=','tmedo.id')
          ->join('pagostributos as pt','pt.idedocuenta','=','edo.id')
          ->join('pagos as p','pt.idpago','=','p.id')
          ->where('p.idstatus','=',1)
          ->where('cuentas.id','=',$this->id) ;                          
     return $query; 

    }

    public function scopeCatalogoTasa($query){
   
    $query->join('tasas as t','cuentas.id','=','t.idcuenta')
          ->join('pagostasas as pt','pt.idtasa','=','t.id')
          ->join('pagos as p','pt.idpago','=','p.id')
          ->where('p.idstatus','=',1)
          ->where('cuentas.id','=',$this->id) ;                          
     return $query; 

    }
}
