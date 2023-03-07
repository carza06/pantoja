<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\TipoTramites;

class TipoTramitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

		$hi = \App\Modelos\Main\HechoImponible::all();
		$tramites = TipoTramites::where('idstatus', 1)
							->orderBy('id','asc')
							->paginate(10);	
        return view('configuracion.tipotramites')->with(['tramites' => $tramites,'hi'=>$hi]);
    }
    
    public function store(Request $request)
    {
		//dd($request->all());
		$data = new TipoTramites;	    
	    $data->idstatus 			= 1;
	    $data->idsession			= \Session::getId();
		$data->idhechoimponible 	= $request->idhi;
		$data->tramite 				= $request->tramite;
		$data->aprobacion 			= ($request->aprobacion == 'on') ? 1 : 0;
		$data->notificacionporemail = ($request->notificacionporemail == 'on') ? 1 : 0;
		$data->requieretributo		= ($request->requieretributo == 'on') ? 1 : 0;
		$data->generaedocuenta		= ($request->generaedocuenta == 'on') ? 1 : 0;
		$data->generatributo		= ($request->generatributo == 'on') ? 1 : 0;
		$data->generainm			= ($request->generainm == 'on') ? 1 : 0;
		$data->generads				= ($request->generads == 'on') ? 1 : 0;
		$data->generapub			= ($request->generapub == 'on') ? 1 : 0;
		$data->generalae 			= ($request->generalae == 'on') ? 1 : 0;
		$data->generaal 			= ($request->generaal == 'on') ? 1 : 0;
		$data->generaep 			= ($request->generaep == 'on') ? 1 : 0;
	    $data->save();
	    \Session::flash('mensaje','Se ha guardado el nuevo tramite exitosamente');
        return \Redirect::route('tipotramites');
    }

    public function requisitos(Request $request)
    {
    	$tipotramite = Tipotramites::find($request->id);
    	$tramitereq = Tipotramites::find($request->id)->requisitos()
			->where('idstatus', 1)
			->get();
    	$requisitos  = \App\Modelos\Configuracion\Requisitos::all();
    	return view('configuracion.tipotramreq')->with(['tipotramite'=>$tipotramite,'requisitos'=>$requisitos]);
    }

    public function tasas(Request $request)
    {
    	$tipotramite = Tipotramites::find($request->id);
    	$tasas  = \App\Modelos\Configuracion\Tasas::all();
    	return view('configuracion.tipotramtasa')->with(['tipotramite'=>$tipotramite,'tasas'=>$tasas]);
    }

    public function asociartrareq(Request $request)
    {
    	if($request->idrequisito){
	    	$idrequisito = $request->idrequisito;
	    	$requerido = $request->requerido;
	    	//dd($requerido);
	    	for ($i =0; $i < count($idrequisito); $i++) {
	    		$data = new \App\Modelos\Tramites\TipoTramites_Requisitos;
	    		$data->idtipotramite = $request->idtipotramite;
	    		$data->idrequisito = $idrequisito[$i];
				$data->requerido = (isset($requerido[$idrequisito[$i]])) ?  1: 0;
				$data->save();
	    	}
		    \Session::flash('mensaje','Se han asociado los requisitos al tramite exitosamente');
	        return \Redirect::route('tipotramites');    		
    	}else{
 		    \Session::flash('mensaje','No seleciono ningun requisito');
	        return \Redirect::route('tipotramites');     		
    	}

    } 
    public function asociartramtasa(Request $request)
    {
    	if($request->idtasa){
	    	$idtasa = $request->idtasa;
	    	//dd($requerido);
	    	for ($i =0; $i < count($idtasa); $i++) {
	    		$data = new \App\Modelos\Tramites\TipoTramites_Tasas;
	    		$data->idtipotramite = $request->idtipotramite;
	    		$data->idtasa = $idtasa[$i];
				$data->save();
	    	}
		    \Session::flash('mensaje','Se han asociado las tasas al tramite exitosamente');
	        return \Redirect::route('tipotramites');    		
    	}else{
 		    \Session::flash('mensaje','No seleciono ninguna tasa');
	        return \Redirect::route('tipotramites');     		
    	}

    } 
}
