<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';
	
	protected $fillable = [
		'id',
		'idsession',
		'idstatus',
        'idtipopago',
		'idformapago',
        'idvalorfiscal',
        'talonario',
		'fechapago',
		'monto',
		
    ]; 

    public function sesion()
    {
        return $this->belongsTo('App\Modelos\Main\Session','idsession');  

    }

    public function status()
    {
        return $this->belongsTo('App\Modelos\Main\Status','idstatus');  

    }
    public function vf()
    {
        return $this->belongsTo('App\Modelos\Configuracion\LoteValorFiscal','idvalorfiscal');  

    }
    public function formapago()
    {
        return $this->belongsTo('App\Modelos\Taquilla\FormasPagos','idformapago');  

    }
    public function tipopago()
    {
        return $this->belongsTo('App\Modelos\Taquilla\TiposPagos','idtipopago');  

    }
    public function cheque()
    {
         return $this->hasOne('App\Modelos\Taquilla\Cheques','idpago');
    }
    public function transferencia()
    {
         return $this->hasOne('App\Modelos\Taquilla\Transferencias','idpago');
    }
    public function pagotributo()
    {
         return $this->hasMany('App\Modelos\Taquilla\PagosTributos','idpago');
    }


 
}
