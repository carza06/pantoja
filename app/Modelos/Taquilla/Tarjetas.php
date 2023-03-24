<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class Tarjetas extends Model
{
    protected $table = 'tarjetas';
	
	protected $fillable = [
		'id',
		'idpago',
		'idbanco',
		'idtipotarjeta',
		'idpunto',
		'titular',
		'nrotarjeta',
		'voucher',
    ];

	public function pago(){
		return $this->belongsTo('App\Modelos\Taquilla\Pagos','idpago');	
	}

	public function banco(){
		return $this->belongsTo('App\Modelos\Configuracion\Bancos','idbanco');	
	}
	public function punto(){
		return $this->belongsTo('App\Modelos\Taquilla\Puntos','idpunto');	
	} 

	public function tipotarjeta(){
		return $this->belongsTo('App\Modelos\Taquilla\TipoTarjeta','idtipotarjeta');	
	}    
}
