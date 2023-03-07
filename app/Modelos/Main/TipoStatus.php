<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class TipoStatus extends Model
{
    protected $table = 'tipostatus';
	
	protected $fillable = [
        'id','tipo', 
    ];
}
