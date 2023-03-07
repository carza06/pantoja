<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\Barrios;
class BarriosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$sectores   = \App\Modelos\Configuracion\Sectores::all();
		$barrios = Barrios::paginate(10);	
        return view('configuracion.barrios')
        	   ->with([
        	   	'barrios'       => $barrios, 
        	   	'sectores'   => $sectores,
        	   	]);
    }
    
    public function store(Request $request)
    {
        
        //dd($request->idsector);
        $sectores = $request->idsector;
        $data = new Barrios;
	    $data->barrio = $request->barrio;
	    $data->save();
        $idbarrio = $data->id;
        for ($x = 0; $x < count($sectores); $x++){
            $relacion = new \App\Modelos\Configuracion\Sector_Barrio;
            $relacion->idbarrio =$idbarrio;
            $relacion->idsector = $sectores[$x];
            $relacion->save();   
        }  
        
	    \Session::flash('mensaje','Se ha guardado el barrio exitosamente');
        return \Redirect::route('barrios');
    }
  
}
