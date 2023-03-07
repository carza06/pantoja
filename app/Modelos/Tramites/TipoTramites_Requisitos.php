<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class TipoTramites_Requisitos extends Model
{
    protected $table = 'tipotramite_requisito';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'idtipotramite', 'idrequisito','requerido', 
    ];

}
