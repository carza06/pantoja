<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class PermisoPubClasificador extends Model
{
	protected $table = 'permisopubclasificador';

	protected $fillable = [	
		'id',
		'idpermiso',
		'idclasificadorpub',
		'basecal',
	];
}
