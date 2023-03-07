<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class LicenciaClasificador extends Model
{
	protected $table = 'licenciaclasificador';

	protected $fillable = [	
		'id',
		'idlicencia',
		'idtipoactividad',
		'idclasificadorlae',
		'basecal',
	];
}
