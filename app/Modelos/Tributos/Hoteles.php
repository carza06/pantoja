<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class Hoteles extends Model
{
	protected $table = 'hoteles';
	
	protected $fillable = [
		'id',
		'idtributo',
        'idfrecuencia',
        'habitaciones',
    ];
}
