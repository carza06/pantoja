<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class Funciones extends Model
{
    protected $table = 'funciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','funcion', 'descripcion',
    ];


}
