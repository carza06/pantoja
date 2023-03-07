<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class Tramites_Status extends Model
{
    protected $table = 'tramites_status';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'idtramite', 
       	'idstatus',
       	'idsession',
    ];
}
