<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class TiposMovimientosEdo extends Model
{
    protected $table = 'tiposmovimientosedo';
	
	protected $fillable = [
		'id',
		'idstatus',
		'idcuenta',
		'descripcion',
		'automatico',
		'generaintereses',
		'orderby',
		'orderbypago',
		'iniciodeintereses',
	];

	public function status()
    {
        return $this->hasOne('App\Modelos\Main\Status','id','idstatus');  

    }

	public function idcuenta()
    {
        return $this->hasOne('App\Modelos\Main\Cuentas','id','idcuenta');  

    }    
}
