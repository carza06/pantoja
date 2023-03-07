<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenerarMovController extends Controller
{
    


    public function generarmovimiento(Request $request)
    {
    	$fecha = date('Y-m-d');
        try{
	       
	        $montotarifa = \App\Modelos\Tributos\ContratosDS::all()->toarray();
	       
	        for($i=0; $i < count($montotarifa); $i++){
	        	 \DB::beginTransaction();
	        	$tarifa = \App\Modelos\Configuracion\TarifasDS::find($montotarifa[$i]['idtarifa']);
	        //dd($tarifa);
            	$periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',$fecha)->orderby('fechafacturacion','desc')->limit(1)->get()->toarray();
		            $total = 0;
                //dd($periodos);
		        for($p=0; $p < count($periodos); $p++){
	                $edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$montotarifa[$i]['idtributo'])->where('idstatus',1)->where('fecha',$periodos[$p]['fechafacturacion'])->where('idtipomovimientoedo',1)->get();
	                if($edo->count() < 1){
	                	$descripcion = 'Servicio de Recoleccion Desechos Solidos '.$periodos[$p]['descripcion'];
		                $this->MovimientoEdoCta(1,1,$montotarifa[$i]['idtributo'],$periodos[$p]['fechafacturacion'],$tarifa['tarifa'],$descripcion);   
		            	$total+= $tarifa['tarifa'];	                	
	                }
		        }
		        \DB::commit();
		    }
		    \Session::flash('transaccion','Se generaron los movimientos en los estados de cuenta exitosamente');
        }
        catch(\Exection $e)
        {
        	\DB::rollback();
        	\Session::flash('transaccion','comuniquese con el administrador del sitema, no se pudo generar los movimientos del mes en curso');
        	       	
        }
        return \Redirect::route('resultados');
    } 


    public function MovimientoEdoCta($idstatus,$idtipomovedo,$idtributo,$fecha,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = $idstatus;
        $movedo->idsession = \Session::getId();
        $movedo->idtipomovimientoedo = $idtipomovedo;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = $fecha;
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = $monto;
        $movedo->save();
        return;     
    } 
}
