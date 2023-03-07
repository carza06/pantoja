<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class TipoLicencias extends Model
{
    protected $table = 'tipolicencias';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipolicencia',
    ];
}
