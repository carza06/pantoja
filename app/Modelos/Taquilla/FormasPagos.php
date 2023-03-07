<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class FormasPagos extends Model
{
    protected $table = 'formaspagos';
	
	protected $fillable = [
		'id',
		'formapago',
		'abreviatura',
    ];
}
