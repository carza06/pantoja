<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class UbicacionesGeograficas extends Model
{
	protected $table = 'ubicacionesgeograficas';
	
	protected $fillable = [
		'id',
		'idsector',
		'idbarrio',
		'idvia',
		'numero',
		'direccion',
	];

	public function sector()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Sectores','idsector');  

    }
	public function barrio()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Barrios','idbarrio');  

    }
	public function via()
    {
        return $this->belongsTo('App\Modelos\Configuracion\Vias','idvia');  

    }
    
}
