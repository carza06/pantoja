<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TarifasController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$tarifas = \App\Modelos\Configuracion\TarifasDS::orderBy('id', 'desc')->paginate(10);	
        return view('configuracion.tarifas')->with(['tarifasds' => $tarifas]);
    }
    
    public function store(Request $request)
    {
        $verificar = \App\Modelos\Configuracion\TarifasDS::where('tarifa',$request->monto)->get();
        if($verificar->count() > 0 ){
			\Session::flash('mensaje','Ya existe una tarifa con el monto que ingreso, verifique');
        }else{
	        $cod = \App\Modelos\Configuracion\TarifasDS::select('codigo')->orderBy('id','Desc')->limit(1)->get();
	        $codigo = $cod[0]['codigo'] + 1;
	        $data = new \App\Modelos\Configuracion\TarifasDS;
		    $data->idsession = \Session::getId();
		    $data->codigo = $codigo;
		    $data->tarifa = $request->monto;
		    $data->save();
            \Session::flash('mensaje','Se agrego la nueva tarifa exitosamente');
        }
        return \Redirect::route('tarifas');
    }
}
