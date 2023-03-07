<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\Vias;

class ViasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$barrios   = \App\Modelos\Configuracion\Barrios::all();
    	$tipovias   = \App\Modelos\Configuracion\TipoVias::all();
    	$tipoclavia = \App\Modelos\Configuracion\TipoClasificacionVias::all();
		$vias = Vias::paginate(20);	
        return view('configuracion.vias')
        	   ->with([
        	   	'vias'       => $vias, 
        	   	'barrios'   => $barrios,
        	   	'tipovias'   => $tipovias,
        	   	'tipoclavia'=> $tipoclavia
        	   	]);
    }
    
    public function store(Request $request)
    {
        
        //dd($request->idsector);
        $barrios = $request->idbarrio;
        $data = new Vias;
    
	    $data->idtipovia = $request->idtipovia;
	    $data->idtipoclasificacionvia = $request->idtipoclavia;
	    $data->nombre = $request->via;
	    $data->save();
        $idvia = $data->id;
        for ($x = 0; $x < count($barrios); $x++){
            $relacion = new \App\Modelos\Configuracion\Barrio_Via;
            $relacion->idvia =$idvia;
            $relacion->idbarrio = $barrios[$x];
            $relacion->save();   
        }  
        
	    \Session::flash('mensaje','Se ha guardado la nueva via exitosamente');
        return \Redirect::route('vias');
    }
  
}
