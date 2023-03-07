<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\Requisitos;

class RequisitosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

		$requisitos = Requisitos::where('idstatus', 1)
							->orderBy('id','asc')
							->paginate(10);	
        return view('configuracion.requisitos')->with(['requisitos' => $requisitos]);
    }
    
    public function guardarreq(Request $request)
    {
		$rq = new Requisitos;	    
	    $rq->idstatus = 1;
	    $rq->idsession = \Session::getId();
	    $rq->requisito = $request->requisito;
	    $rq->save();
	    \Session::flash('mensaje','Se ha guardado el nuevo requisito exitosamente');
        return \Redirect::route('requisitos');
    }     
}
