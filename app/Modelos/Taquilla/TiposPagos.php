<?php

namespace App\Modelos\Taquilla;

use Illuminate\Database\Eloquent\Model;

class TiposPagos extends Model
{
    protected $table = 'tipopagos';
	
	protected $fillable = [
		'id',
		'formapago',
		'abreviatura',
    ]; 
}
