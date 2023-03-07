<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class SujetoPasivo_Tributo extends Model
{
    protected $table = 'sujetopasivo_tributo';
	
	protected $fillable = [
        'idsujetopasivo','idtributo','idsession', 'responsable', 'representantelegal', 
        'propietario', 
    ];
}
