<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class Tramites_Tributos extends Model
{
    protected $table = 'tramites_tributos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'idtramite', 
       	'idtributo',
    ];
}
