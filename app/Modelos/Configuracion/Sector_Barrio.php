<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class Sector_Barrio extends Model
{
    protected $table = 'sector_barrio';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idsector', 'idbarrio', 
    ];


}
