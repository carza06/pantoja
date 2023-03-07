<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class UsoInmuebles extends Model
{
	protected $table = 'usoinmuebles';
	
	protected $fillable = [
		'id',
		'uso',
	];
}
