<?php

namespace App\Modelos\Seguridad;

use Illuminate\Database\Eloquent\Model;

class HistorialGenerarDeuda extends Model
{

	protected $table = 'historialgenerardeuda';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'idsession',
		'idtributo',
		'desde',
		'hasta',
		'monto',
    ];
}
