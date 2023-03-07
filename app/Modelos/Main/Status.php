<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
	
	protected $fillable = [
        'id','idtipo','nombre', 'abreviatura', 
    ];
    
    public function usuario()
    {        
    	return $this->belongsToMany('App\User');
    }  
}
