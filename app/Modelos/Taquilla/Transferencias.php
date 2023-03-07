<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class Transferencias extends Model
{
    protected $table = 'transferencias';
	
	protected $fillable = [
		'id',
		'idpago',
		'nrotransferencia',
    ];

	public function pago(){
		return $this->belongsTo('App\Modelos\Taquilla\Pagos','idpago');	
	}

	public function banco(){
		return $this->belongsTo('App\Modelos\Configuracion\Bancos','idbanco');	
	}
    
}
