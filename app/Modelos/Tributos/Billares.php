<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class Billares extends Model
{
	protected $table = 'billares';
	
	protected $fillable = [
		'id',
		'idtributo',
        'idfrecuencia',
        'mesas',
    ];
}
