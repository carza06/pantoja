<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Barrio_Via extends Model
{
    protected $table = 'barrio_via';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idvia', 'idbarrio', 
    ];


}
