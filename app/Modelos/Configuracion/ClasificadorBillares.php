<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class ClasificadorBillares extends Model
{
    protected $table = 'clasificadorbillares';

	protected $fillable = [
    	'id',
		'monto',
		'descripcion',
		'vigentedesde',
	];
}
