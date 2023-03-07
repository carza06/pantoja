<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class TipoInmuebles extends Model
{
	protected $table = 'tipoinmuebles';
	
	protected $fillable = [
		'id',
		'idusoinmueble',
		'tipo',
	];
    public function usoinm()
    {
        return $this->belongsTo('App\Modelos\Tributos\UsoInmuebles','idusoinmueble');  

    }
}
