<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class PagosTasas extends Model
{
    protected $table = 'pagostasas';
	
	protected $fillable = [
		'id',
		'idpago',
		'idtasa',
		'monto',
  	];

    public function tasa()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Tasas','idtasa');  

    }

    public function pago()
    {
        return $this->belongsTo('App\Modelos\Taquilla\Pagos','idpago');  

    }

    public function scopeRecaudacion($query){
       
        $query->join('pagos as p','p.id','=','pagostasas.idpago')
              ->where('p.idstatus','=',1);
                                      
         return $query; 

    } 
}
