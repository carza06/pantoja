<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Requisitos extends Model
{
    protected $table = 'requisitos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','requisito', 'idstatus', 
    ];

    public function tipotramites()
    {
        return $this->belongsToMany('App\Modelos\Tramites\TipoTramites');
    }

    public function estatus()
    {
        return $this->belongsTo('App\Modelos\Main\Status','idstatus');  

    }

    public function session()
    {
        return $this->belongsTo('App\Modelos\Main\Session','idsession');  

    }

    public function tramites()
    {
        return $this->belongsToMany('App\Modelos\Tramites\Tramites');
    }


}
