<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class PagosTributos extends Model
{
    protected $table = 'pagostributos';
	
	protected $fillable = [
		'id',
		'idpago',
		'idtributo',
		'idestadocuenta',
		'fechapago',
        'base',
		'monto',
        'saldo',
    ];

    public function idpago()
    {
        return $this->belongsTo('App\Modelos\Taquilla\Pagos','idpago');  

    }

    public function idtributo()
    {
        return $this->belongsTo('App\Modelos\Tributos\Tributos','idtributo');  

    }

    public function estadocuenta()
    {
        return $this->belongsTo('App\Modelos\Tramites\EstadosCuentas','idestadocuenta');  

    }   

}
