<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }	

	public function index()
	{
   		\Session::forget('SP');
   		\Session::forget('ID');
   		\Session::forget('ARBITRIO');
      \Session::forget('USOINM');
      \Session::forget('USOSUELO');
      \Session::forget('TFF');
      \Session::forget('TARIFADS');
      \Session::forget('IdTributo');
      \Session::forget('GUARDAR');
   		$reg = \App\Modelos\Configuracion\RegistroExpress::where('idstatus',1)->orderby('id','desc')->paginate(20);
        return view('registroycontrol.registro')->with(['registro' => $reg]);
    }

 	public function busquedasp(Request $request)
	{
 			$search = null;
      \Session::forget('SP');
 			if($request->search == 2){
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::CedulaRcn($request->cedularcn)->get()->toarray();
        $search = 1;
			}else{
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::IdAnterior($request->cedularcn)->get()->toarray();	
        $search = 1;
			}
			if(count($busqueda) > 0){
				$sp = $this->formatdata($busqueda);				
				\Session::put('SP',$sp);	
			}else{
				\Session::put('fail','No existe el contribuyente, proceda a llenar los datos');
			}
			  		
        	return \Redirect::route('registrar');
    } 
	public function registrar()
    {
        $sectores = \App\Modelos\Configuracion\Sectores::all();
        $tipoambiente = \App\Modelos\Configuracion\TipoAmbiente::all();
        return view('registroycontrol.registrar')->with(['sectores'=>$sectores,'tipoambiente'=>$tipoambiente]);
    } 
	public function formatdata($datos)
    {
        foreach($datos as $info)
        {
           foreach($info as $indice=>$valor)
           {
            $var[$indice] = $valor;
           }
        }
        return $var;
    }   		
}
