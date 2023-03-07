<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\Tasas;

class TasasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$tipotasas = \App\Modelos\Configuracion\TipoTasas::all();
    	$cuentas = \App\Modelos\Main\Cuentas::where('habilitada',1)->get();
		$tasas = Tasas::where('idstatus',1)->paginate(10);	
        return view('configuracion.tasas')->with(['tasas' => $tasas, 'tipotasas' => $tipotasas,'cuentas'=>$cuentas]);
    }

    public function store(Request $request)
    {
    	    	
    	$data = new Tasas;
    	$data->idtipotasa = $request->idtipotasa;
    	$data->idstatus = 1;
    	$data->idsession = \Session::getId();
    	$data->idcuenta = $request->idcuenta;
    	$data->tasa = $request->tasa;
    	$data->monto = $request->monto;
    	if($request->metraje == 'on'){
    		$request->metraje = 1;
    	}else{
    		$request->metraje = 0;
    	}
    	$data->metraje = $request->metraje;
    	$data->vigentedesde = $request->vigentedesde;  	
    	$data->save();
    	$tipotasas = \App\Modelos\Configuracion\TipoTasas::all();
    	$cuentas = \App\Modelos\Main\Cuentas::all();
		$tasas = Tasas::where('idstatus',1)->paginate(10);	
        return \Redirect::route('tasas');
    }
}
