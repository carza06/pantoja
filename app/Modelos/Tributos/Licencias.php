<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class Licencias extends Model
{
	protected $table = 'licencias';

	protected $fillable = [	
		'id',
		'idsession',
		'idtributo',
		'idtipolicencia',
		'observacion',
	];

	public function tipolicencia()
    {
        return $this->belongsto('App\Modelos\Configuracion\TipoLicencias','idtipolicencia');  

    }
}
