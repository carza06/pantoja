<?php

namespace App\Modelos\Tramites;

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
        'id', 'idstatus', 'idhechoimponible', 'tramite', 'aprobacion', 'notificacionporemail',
        'requieretributo', 'generaedocuenta',
        ];
    
    /**
     * Relacion Mucho a Muchos con la Tabla Requisitos
     */ 

    public function requisitos()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Requisitos','tipotramite_requisito','idtipotramite','idrequisito')->withPivot('requerido');
    }

    public function tasas()
    {
        return $this->belongsToMany('App\Modelos\Configuracion\Tasas','tipotramite_tasa','idtipotramite','idtasa');
    }    
}
