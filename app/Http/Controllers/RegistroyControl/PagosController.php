<?php

namespace App\Http\Controllers\RegistroyControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagosController extends Controller
{
    public function anularpago(Request $request)
    {
    	$pagotributo = \App\Modelos\Taquilla\PagosTributos::where('idpago',$request->id)->get();
    	foreach ($pagotributo as $reverso) {
    		$idtributo = $reverso->idtributo;
    		$edo = \App\Modelos\Tramites\EstadosCuentas::find($reverso->idedocuenta);
    		$edo->montoremanente =  $reverso->base;
    		$edo->save();
    	}
    	$pago = \App\Modelos\Taquilla\Pagos::find($request->id);
    	$pago->idstatus = 2;
    	$pago->save();
        if($pago->idtipopago == 1){
            $edo = \App\Modelos\Tramites\EstadosCuentas::find($pago->idmovedo);
            $edo->idstatus = 2;
            $edo->save();
            \Session::flash('edocuenta','El pago se anulo correctamente');
            return \Redirect::route('estadodecuenta',array('idtributo' => $idtributo));           
        }       
    	
    	return \Redirect::route('comprobantes');
    }
}
