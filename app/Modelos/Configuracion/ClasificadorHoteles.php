<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class ClasificadorHoteles extends Model
{
     protected $table = 'clasificadorhoteles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'desdehabitaciones',
		'hastahabitaciones',
		'monto',


    ];
}
