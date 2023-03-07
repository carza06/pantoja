<?php

namespace App\Http\Controllers\RegistroyControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacturacionEspecial extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
		$sp        = null;
		$idtributo = null;
		$tarifaespecial = null;
        $facturas = null;
		if($request->idtributo){
			$tributo = \App\Modelos\Tributos\Tributos::find($request->idtributo);
			if(count($tributo) > 0){
				if($tributo['idhechoimponible'] === 6){
					$idtributo = $tributo['id'];
					$sup = \App\Modelos\Tributos\Tributos::find($tributo['id'])->sp()->get()->toarray();
					$sp = $this->formatdata($sup);
					$tarifaespecial = \App\Modelos\Configuracion\TarifasDSespecial::all();
                    $facturas = \App\Modelos\Facturacion\FacturasDS::where('idtributo',$idtributo)->where('idtipofactura',2)->get();
				}else{
					\Session::flash('busqueda','No se puede generar factura especial, el tributo buscado no es desecho solido');	
				}
			}else{
				\Session::flash('busqueda','El Contribuyente no existe');
			}
		}
    	return view('registroycontrol.facturacionespecial')->with(['sp'=>$sp,'idtributo'=>$idtributo,'tdse'=>$tarifaespecial,'facturas'=>$facturas]);
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
