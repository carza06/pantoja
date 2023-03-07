<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class Cheques extends Model
{
    protected $table = 'cheques';
	
	protected $fillable = [
		'id',
		'idpago',
		'idbanco',
		'nrodecheque',
		'nrodecuenta',
		'titular',
    ];

	public function pago(){
		return $this->belongsTo('App\Modelos\Taquilla\Pagos','idpago');	
	}

	public function banco(){
		return $this->belongsTo('App\Modelos\Configuracion\Bancos','idbanco');	
	}
    
}
