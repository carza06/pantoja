<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TarifasDS extends Model
{
    protected $table = 'tarifasds';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'codigo',
		'tarifas',
    ];
}
