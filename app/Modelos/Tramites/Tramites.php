<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class Tramites extends Model
{
    protected $table = 'tramites';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
 		'id', 'idsession', 'idsujetopasivo', 'idtipotramite', 'idpago', 'solicitante','cedula',
 		'telefono','fechasolicitud',
	];

	public function session()
    {
        return $this->belongsTo('App\Modelos\Main\Session','idsession');  

    }

    public function sujetopasivo()
    {
        return $this->belongsTo('App\Modelos\Tributos\SujetoPasivo','idsujetopasivo');  

    }

    public function tiporamite()
    {
        return $this->belongsTo('App\Modelos\Tramites\TipoTramites','idtipotramite');  

    }

    public function requisitos()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Requisitos','tramites_requisitos','idtramite','idrequisito')->withPivot('requerido');
    }

    public function tributos()
    {
        return $this->belongsToMany('App\Modelos\Tributos\Tributos','tramites_tributos','idtramite','idtributo');
    }
}
