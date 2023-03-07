<?php

namespace App\Modelos\Main;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table = 'modulos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','modulo', 'descripcion',
    ];

	public function funciones()
    {
    	return $this->hasMany('App\Modelos\Main\Funciones','idmodulo','id');
 	}

    public function scopePerfil($query,$idusuario)
    {
        $query->join('funciones as f','modulos.id','=','f.idmodulo')
              ->join('perfiles_funciones as pf','pf.idfuncion','=','f.id')
              ->join('perfiles as p','p.id','=','pf.idperfil')
              ->join('users as u','u.idperfil','=','p.id')
              ->where('u.id','=',$idusuario)
              ->orderby('modulos.id') ;                          
        return $query;
    }
}
