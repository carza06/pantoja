<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;

class Inmuebles extends Model
{
	protected $table = 'inmuebles';
	
	protected $fillable = [
		'id',
		'idtributo',
		'idusoinmueble',
		'idusosuelo',
		'idtipoinmueble',
		'catastro',
		'areaterreno',
		'areacontruccion',
		'fechadeadquisicion',
		'valorinmueble',
		'linderonorte',
		'linderoeste',
		'linderosur',
		'linderooeste',
    ];
    
    public function scopeCatastro($query,$catastro)
    {
       
        $query->where('catastro', $catastro);
    } 

    public function usoinm()
    {
		return $this->belongsTo('App\Modelos\Tributos\UsoInmuebles','idusoinm');
    	
    	
    }
   
    public function tipoinm()
    {
    	return $this->belongsTo('App\Modelos\Tributos\TipoInmuebles','idtipoinm');
    }

    public function usosuelo()
    {
    	return $this->belongsTo('App\Modelos\Tributos\UsosSuelos','idusosuelo');
    } 

    public function scopeVip($query)
    {
    	$query->join('contratosds as c','c.idinm','=','inmuebles.id')
    		  ->join('contribuyentesvip as cv','c.idtributo','=','cv.idtributo')
    		  ->orderby('cv.idtributo','asc');
        return $query; 
    }     
}
