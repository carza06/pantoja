<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class HechoImponible extends Model
{
    protected $table = 'hechoimponible';
	
	protected $fillable = [
        'id','idstatus','nombrehechoimponible', 'abreviaturahechoimponible', 
    ];

    public function scopeDeuda($query){
       
        $query->join('tributo as tr','hechoimponible.id','=','tr.idhechoimponible')
              ->join('estadosdecuentas as edo','edo.idtributo','=','tr.id')
              ->where('edo.idstatus','=',1)
              ->where('tr.idstatus','=',1)
              ->where('hechoimponible.id','=',$this->id) ;                          
         return $query; 

    }

    public function scopeRecaudacion($query){
       
        $query->join('tributo as tr','hechoimponible.id','=','tr.idhechoimponible')
              ->join('pagostributos as pt','pt.idtributo','=','tr.id')
              ->join('pagos as p','p.id','=','pt.idpago')
              ->where('p.idstatus','=',1)
              ->where('tr.idstatus','=',1)
              ->where('hechoimponible.id','=',$this->id) ;                          
         return $query; 

    } 

  
}
