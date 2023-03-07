<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','idssesion', 'idstatus', 'avatar','nombre','usuario','codigo', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function estatus()
    {
        return $this->hasOne('App\Modelos\Main\Status','idstatus');  

    }

    public function perfiles()
    {
        return $this->belongsTo('App\Perfil','idperfil');  

    }
    public function acciones()
    {
        return $this->belongsToMany('App\Modelos\Main\Acciones','acciones_usuarios','idusuario','idaccion');
    }
    public function scopeRecaudado($query)
    {
        $query->join('sessions as ss','users.id','=','ss.user_id')
              ->join('pagos as p','p.idsession','=','ss.id')
              ->where('users.id','=',$this->id) ;                          
        return $query;
    }
    public function scopeTramites($query)
    {
        $query->join('sessions as ss','users.id','=','ss.user_id')
              ->join('tramites as t','t.idsession','=','ss.id')
              ->where('t.fechasolicitud','=',date('Y-m-d'))
              ->where('users.id','=',$this->id) ;                          
        return $query;
    }

    public function scopePerfil($query)
    {
        $query->join('perfiles as p','p.id','=','users.idperfil')
              ->join('perfiles_funciones as pf','p.id','=','pf.idperfil')
              ->join('funciones as f','f.id','=','pf.idfuncion')
              ->join('modulos as m','m.id','=','f.idmodulo')
              ->where('f.idstatus','=',1)
              ->where('users.id','=',$this->id)
              ->orderby('m.orderby')
              ->orderby('f.id') ;                          
        return $query;
    }
        
}
