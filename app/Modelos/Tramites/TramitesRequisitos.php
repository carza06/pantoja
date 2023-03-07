<?php

namespace App\Modelos\Tramites;

use Illuminate\Database\Eloquent\Model;

class TramitesRequisitos extends Model
{
    protected $table = 'tramites_requisitos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'idtramite', 'idrequisito',
    ];
}
