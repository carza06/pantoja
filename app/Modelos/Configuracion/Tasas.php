<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Tasas extends Model
{
    protected $table = 'tasas';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'idtipotasa',
        'idstatus',
        'idsession',
        'idcuenta',
        'tasa',
        'monto',
        'metraje',
        'vigentedesde',
        ];

    public function tipotasa()
    {
        return $this->belongsTo('App\Modelos\Configuracion\TipoTasas','id','idtipotasa');  

    }
    public function estatus()
    {
        return $this->belongsTo('App\Modelos\Main\Status','idstatus');  

    }

    public function session()
    {
        return $this->belongsTo('App\Modelos\Main\Session','idsession');  

    }

    public function cuenta()
    {
        return $this->belongsTo('App\Modelos\Main\Cuentas','idcuenta');  

    }

    public function tipotramites()
    {
        return $this->belongsToMany('App\Modelos\Tramites\TipoTramites');
    }
}
