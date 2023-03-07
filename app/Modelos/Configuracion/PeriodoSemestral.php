<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class PeriodoSemestral extends Model
{
	protected $table = 'periodosemestral';

	protected $fillable = [
		'id',
		'idperiododeliquidacion',
		'desde',
		'hasta',
		'fechafacturacion',
		'recargo',
		'descripcion',
	];
}

