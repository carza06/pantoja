<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class PeriodosMensuales extends Model
{
	protected $table = 'periodomensual';

	protected $fillable = [
		'id',
		'idperiododeliquidacion',
		'desde',
		'hasta',
		'fechafacturacion',
		'recargo',
		'descripcion',
	];
	
	public function scopePeriodoMensualNofacturado($query,$id)
	{
		return  $query->whereNotExists(function ($query) {
                $query->select(\DB::raw(1))
                      ->from('periodosfacturados as p')
                      ->where('idtipofactura','=',$id)
                      ->whereRaw('p.idperiodomensual = periodomensual.id');
            })
            ->get();

	}	
}
