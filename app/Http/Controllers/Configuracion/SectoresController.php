<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\Sectores;

class SectoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$tiposectores = \App\Modelos\Configuracion\TipoSectores::all();
		$sectores = Sectores::paginate(10);	
        return view('configuracion.sectores')->with(['sectores' => $sectores, 'tiposectores'=>$tiposectores]);
    }
    
    public function store(Request $request)
    {
		$data = new Sectores;
	    $data->idsession = \Session::getId();
	    $data->idtiposector = $request->idtiposector;
	    $data->sector = $request->sector;
	    $data->codcatastro = $request->codcatastro;
	    $data->save();
	    \Session::flash('mensaje','Se ha guardado el nuevo sector exitosamente');
        return \Redirect::route('sectores');
    }  
    public function buscarbarrios(Request $request)
    {
        
        $data = Sectores::find($request->id)->barrio()->get();
        //$data = $data->toarray();
        return response()->json($data);//then sent this data to ajax success

    }

        public function buscarvia(Request $request)
    {
        
        $data = \App\Modelos\Configuracion\Barrios::find($request->id)->via()->get();
        //$data = $data->toarray();
        return response()->json($data);//then sent this data to ajax success

    }    
}
