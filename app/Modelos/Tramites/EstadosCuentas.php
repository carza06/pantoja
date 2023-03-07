<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class EstadosCuentas extends Model
{
    //
    protected $table = 'estadosdecuentas';
	
	protected $fillable = [
		'id',
		'idstatus',
		'idsession',
		'idtipomovimientoedo',
		'idtributo',
		'fecha',
		'descripcion',
		'monto',
		'montoremanente',

	];
    public function status()
    {
        return $this->hasOne('App\Modelos\Main\Status','id','idstatus');  

    }
    public function sesion()
    {
        return $this->hasOne('App\Modelos\Main\Sessions','id','idsession');  

    }

    public function tipomovedo()
    {
        return $this->hasOne('App\Modelos\Tramites\TiposMovimientosedo','id','idtipomovimientoedo');  

    }

    public function idtributo()
    {
        return $this->hasOne('App\Modelos\Tributos\Tributos','id','idtributo');  

    }

    public function scopeTotal($query,$idtributo)
    {
        $query->where('idtributo','=',$idtributo)
              ;
        return $query;
    }  	
}
