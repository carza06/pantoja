<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class TipoTramites_Tasas extends Model
{
    protected $table = 'tipotramite_tasa';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'idtipotramites', 'idtasa', 
    ];
}
