<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class UsosSuelos extends Model
{
	protected $table = 'usosuelo';
	
	protected $fillable = [
		'id',
		'dodigo',
		'descripcion',

	];
}
