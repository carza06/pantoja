<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class ContratosDS extends Model
{
	protected $table = 'contratosds';
	
	protected $fillable = [
		'idtributo',
		'idinm',
		'idtarifa',
		'idtipofrecuencia',
		'categoria',
		'iniciocobro',
    ];

    public function clasificador()
    {
        return $this->belongsTo('App\Modelos\Configuracion\TarifasDS','idtarifa');  

    }

}