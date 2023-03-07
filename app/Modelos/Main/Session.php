<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $hidden = ['payload'];
    protected $table = 'sessions';
	
	protected $fillable = [
        'id', 'user_id','ip_address', 'user_agent', 'last_activity',

    ];
    
    public function usuario()
    {        
    	return $this->hasOne('App\User','id','user_id');
    }  
}
