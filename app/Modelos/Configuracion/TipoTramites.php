<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoTramites extends Model
{
    protected $table = 'tipotramites';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idsession',
		'idstatus',
		'idhechoimponible',
		'tramite',
		'aprobacion',
		'notificacionporemail',
		'requieretributo',
		'generaedocuenta',

    ];

    public function session()
    {
        return $this->belongsTo('App\Modelos\Main\Session','idsession');  

    }
    public function estatus()
    {
        return $this->belongsTo('App\Modelos\Main\Status','idstatus');  

    } 
    public function hechoimponible()
    {
        return $this->belongsTo('App\Modelos\Main\HechoImponible','idhechoimponible');  

    }

        public function requisitos()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Requisitos','tipotramite_requisito','idtipotramite','idrequisito')->withPivot('requerido');
    }

    public function tasas()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Tasas','tipotramite_tasa','idtipotramite','idtasa');
    }    
}
