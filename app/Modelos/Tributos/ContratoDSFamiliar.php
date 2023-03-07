<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class ContratoDSFamiliar extends Model
{
	protected $table = 'contratodsfamiliar';
	
	protected $fillable = [
		'id',
        'idtributo',
		'idinm',
		'idclasificadorinm',
		'idtipofrecuencia',
    ];

    public function inm()
    {
        return $this->belongsTo('App\Modelos\Tributos\Inmuebles','idinmu');  

    }

    public function clasificador()
    {
        return $this->belongsTo('App\Modelos\Configuracion\ClasificadorInm','idclasificadorinm');  

    }

}
