<?php

namespace App\Modelos\Configuracion;

use Illuminate\Database\Eloquent\Model;

class LoteFiscal extends Model
{
    protected $table = 'lotefiscal';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'loteinicial',
		'lotefinal', 
    ];

    public function scopeLote($query)
    {
        $query->join('lotevalorfiscal as lvf','lotefiscal.id','=','lvf.idlotefiscal');                                        
        return $query;                          

    } 
}
