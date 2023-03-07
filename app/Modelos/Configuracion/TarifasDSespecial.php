<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TarifasDSespecial extends Model
{
    protected $table = 'tarifasdsespecial';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'tarifas',
		'descripcion',
    ];
}
