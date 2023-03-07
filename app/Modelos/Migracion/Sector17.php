<?php

namespace App\Modelos\Migracion;

use Illuminate\Database\Eloquent\Model;

class Sector17 extends Model
{
    protected $table = '17';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'barrio',
		'calle',
		'numero	',
		'unidad ',
		'razonsocial',
		'id',
		'uso',
		'categoria  ',
		'telefono   ',
		'boletin    ',
		'descripcion',
		'cantidad   ',
		'categoria1 ',
		'idcategoria',
		'tarifard',
		'frecuencia ',
		'texto',
		'monto',
		'texto2',
		'tarifa',
    ];
}
