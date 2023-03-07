<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class PermisoPublicidad extends Model
{
	protected $table = 'permisopublicidad';

	protected $fillable = [	
		'id',
		'idtributo',
		'idsession',
		'fecharecepcion',
		'fechaemision',
		'fechadesde',
		'fechahasta',
		'observacion',
	];

}
