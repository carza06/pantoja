<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class Tributos extends Model
{
    protected $table = 'tributo';
	
	protected $fillable = [
        'id','idstatus','idhechoimponible', 'idubicaciongeografica', 'idsession', 'fechainicial',
        'nuevotributo',
    ];

    public function hi()
    {
        return $this->belongsTo('App\Modelos\Main\HechoImponible','idhechoimponible');  

    }
    public function ubg()
    {
        return $this->hasOne('App\Modelos\Tributos\UbicacionesGeograficas','id','idubicaciongeografica');  

    }
    public function sp()
    {
        return $this->belongsToMany('App\Modelos\Tributos\SujetoPasivo','sujetopasivo_tributo','idtributo','idsujetopasivo')->withPivot('responsable','representantelegal','propietario');
    }

 
}

