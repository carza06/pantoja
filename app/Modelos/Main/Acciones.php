<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class Acciones extends Model
{
    protected $table = 'acciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','accion','descripcion', 
    ];
}
