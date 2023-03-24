<?php

namespace App\Http\Controllers\Taquilla;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaquillaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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


	public function mitaquilla(Request $request)
	{
		# Fecha de consulta de Caja
		if($request->fecha){
			$fecha = $request->fecha;
		}else{
			$fecha = date('Y-m-d');
		}
		# Pagos del Usuario;
		$pagos = \Auth::user()->select('p.*')->Recaudado()->where('fechapago',$fecha)->where('p.idstatus',1)->get();
		# Variables de Pagos
		$efectivo      = null;
		$cheques       = null;
		$puntovt       = null;
		$transferencias = null;
		foreach ($pagos as $value) {
			$comprobante = str_pad($value->id, 6, "0", STR_PAD_LEFT);
			//echo $comprobante;
			if($value->idtipopago == 1){
				$tributo = \App\Modelos\Taquilla\PagosTributos::select('idtributo')->where('idpago',$value->id)->get();
				$id = 'Tri'.$tributo[0]['idtributo'];
				$hi = \App\Modelos\Tributos\Tributos::where('id',$tributo[0]['idtributo'])->get();
				$descripcion = $hi[0]->hi->nombrehechoimponible;
				$sp = \App\Modelos\Tributos\Tributos::find($tributo[0]['idtributo'])->sp()->get();
				//echo $sp[0]['nombre_razonsocial'];
				
			}else{
				$tramite  = \App\Modelos\Tramites\Tramites::where('idpago',$value->id)->get();
				$sp       = \App\Modelos\Tramites\Tramites::find($tramite[0]['id'])->sujetopasivo()->get();
				$id       = 'Tra'.$tramite[0]['id'];
				$pagotasa = \App\Modelos\Taquilla\PagosTasas::where('idpago',$value->id)->get();
				$tasa     = \App\Modelos\Taquilla\PagosTasas::find($pagotasa[0]['id'])->tasa()->get();
				$descripcion = 'Tasa:'.$tasa[0]['tasa'];
			}
			switch ($value->idformapago) {
				case 1:
					# Efectivo
					$efectivo[] = array($comprobante,
									    $id,
									    $sp[0]['nombre_razonsocial'],
									    $descripcion,
									    $value->monto);
					break;
				case 2:
					# Puntos de Venta
					break;
				case 3:
					# Cheque
					$cheque = \App\Modelos\Taquilla\Cheques::where('idpago',$value->id)->get();
					//echo $cheque[0]->banco->banco;
					//echo $cheque[0]['nrodecheque'];
					$cheques[] = array($comprobante,
									    $id,
									    $sp[0]['nombre_razonsocial'],
									    $descripcion,
									    $cheque[0]->banco->banco,
									    $cheque[0]['nrodecheque'],
									    $value->monto);
					break;
				case 4:
					# Transferencia
					$transferencia = \App\Modelos\Taquilla\Transferencias::where('idpago',$value->id)->get();
					$transferencias[] = array($comprobante,
									    $id,
									    $sp[0]['nombre_razonsocial'],
									    $descripcion,
									    $transferencia[0]['nrotransferencia'],
									    $value->monto);
					break;						
				default:
					# code...
					break;
			}
		}
		//dd($transferencias);
		if($request->imprimir){
			$view =  \View::make('pdf.mitaquilla')->with(['efectivo'=>$efectivo,'cheques'=>$cheques,'transferencias'=>$transferencias,'fecha'=>$fecha])->render();
        	$pdf = \App::make('dompdf.wrapper');
        	$pdf->loadHTML($view);
        	return $pdf->stream('micaja.pdf');
		}else{
			return view('taquilla.taquilla')->with(['efectivo'=>$efectivo,'cheques'=>$cheques,'transferencias'=>$transferencias,'fecha'=>$fecha]);			
		}

	}
	
	public function comprobantes(Request $request)
	{
		if($request->cedularcn){
			if($request->search == 2){
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::cedularcn($request->cedularcn)->get()->toarray();
			}else{
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::IdAnterior($request->cedularcn)->get()->toarray();
			}
			
			//echo count($busqueda);
			if(count($busqueda) > 0){
				//echo 'aqui';
				$anularpago = \App\User::find(\Auth::user()->id)->Acciones()->where('idaccion',4)->get();
				if(count($anularpago) > 0 ){
					$anular = 1;
				}else{
					$anular = 0;	
				}
				$sp = $this->formatdata($busqueda);	
				$pagostasas = \App\Modelos\Tributos\SujetoPasivo::ComprobantesTasas($sp['id'])->orderby('p.created_at','desc')->get();
				$pagostributos = \App\Modelos\Tributos\SujetoPasivo::ComprobantesTributos($sp['id'])->orderby('p.created_at','desc')->get();
				//dd($pagostributos);
				return view('taquilla.comprobantes')->with(['sp'=>$sp,'pagostasas'=>$pagostasas,'pagostributos'=>$pagostributos,'anular'=>$anular]);
			}else{
				\Session::flash('busqueda','El Contribuyente no existe');
			}
		}
		return view('taquilla.comprobantes');
	}
	
	public function comprobante(Request $request)
	{
		$pago = \App\Modelos\Taquilla\Pagos::find($request->id);

		$comprobante = str_pad($pago['id'], 6, "0", STR_PAD_LEFT);
		if($pago['idtipopago'] == 1){
			$pagotributo = $pago->pagotributo;
			foreach($pagotributo as $edo){
				$idtributo = $edo->idtributo;
				$info =\App\Modelos\Tramites\EstadosCuentas::find($edo->idedocuenta);
				$detalle[] = array($info['descripcion'],$edo->base,$edo->monto,$edo->saldo);
			}
			$sp = \App\Modelos\Tributos\Tributos::find($idtributo)->sp()->get();	
		}else{
			$tramite  = \App\Modelos\Tramites\Tramites::where('idpago',$pago['id'])->get();
			$sp       = \App\Modelos\Tramites\Tramites::find($tramite[0]['id'])->sujetopasivo()->get();
			$pagotasa = \App\Modelos\Taquilla\PagosTasas::where('idpago',$pago['id'])->get();
			$tasa     = \App\Modelos\Taquilla\PagosTasas::find($pagotasa[0]['id'])->tasa()->get();
			$descripcion = 'Tasa:'.$tasa[0]['tasa'];
			$detalle[] = array($descripcion,$pago['monto']);
		}
		
		$view =  \View::make('pdf.comprobante')->with(['comprobante'=>$comprobante,'sp'=>$sp,'pago'=>$pago,'detalle'=>$detalle])->render();
		$pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('comprobante.pdf');		
		
	}

	public function procesarpago(Request $request)
	{
		$edomonto = \App\Modelos\Tramites\EstadosCuentas::Total($request->idtributo)->where('idstatus',1)->sum('montoremanente');
		if($edomonto < $request->monto){
			\Session::flash('edocuenta','Esta tratando de efectuar un pago superior a la deuda, no se proceso el pago');
			return \Redirect::route('estadodecuenta', array($request->idtributo));
		}

		try{
			\DB::beginTransaction();
			
			if($request->valorfiscal == "on"){
				$lote = \App\Modelos\Configuracion\LoteValorFiscal::where('asignado',0)->orderby('id','asc')->limit(1)->get()->toarray();

				$idvalorfiscal = $lote[0]['id'];
				$asignado = \App\Modelos\Configuracion\LoteValorFiscal::find($lote[0]['id']);
				$asignado->asignado = 1;
				$asignado->save(); 
			}else{
				$idvalorfiscal = null;
			}
			
			$idpago = $this->insertpago($request->idformapago,$idvalorfiscal,$request->talonario,$request->monto);

			$edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->idtributo)
														->where('montoremanente','>',0)
														->where('idstatus',1)
														->orderby('fecha','asc')
														->get();
			$pago = $request->monto;
			foreach($edo as $detalle){
	            if($pago > 0) {
	                //echo $detalle->montoremanente;
	                //die;
	                $pago -= $detalle->montoremanente;
					$pago = round($pago,2);
	                // SI EL MONTO DEL PAGO SOLVENTO TODA LA DEUDA DEL MOVIMIENTO
	                if($pago >= 0) {
	                    $montoRemanenteEstadoCuenta = 0;
	                    $montoRemanenteComprobantePago = $detalle->montoremanente;
	                    $this->updatemontoremanente($detalle->id,$montoRemanenteEstadoCuenta);
	                    $this->insertpagotributo($idpago,$request->idtributo,$detalle->id,$detalle->montoremanente,$montoRemanenteComprobantePago,$montoRemanenteEstadoCuenta);	                    
	                }
	                // SI EL MONTOREMANENTE NO SOLVENTO TODA LA DEUDA DEL MOVIMIENTO
	                else { 
	                    $montoRemanenteEstadoCuenta = abs($pago);
	                    $montoRemanenteComprobantePago = $detalle->montoremanente + $pago;
	                    $this->updatemontoremanente($detalle->id,$montoRemanenteEstadoCuenta);
	                    $this->insertpagotributo($idpago,$request->idtributo,$detalle->id,$detalle->montoremanente,$montoRemanenteComprobantePago,$montoRemanenteEstadoCuenta);
	                }
	            }
			}
			switch ($request->idformapago) {
				case '1':
					$descripcion = 'Pago en Efectivo';
					break;
				case '2':
					$descripcion = 'Pago por Tarjeta de '.$request->tipotarjeta.' '.$request->codtar;
					$this->insertartarjeta($idpago,$request->idbanco,$request->idtipotarjeta,$request->titular,$request->nrotarjeta,$request->voucher);
					break;
				case '3':
					$descripcion = 'Pago en Cheque Nro:'.$request->nrocheque;
					$this->insertarcheque($idpago,$request->idbanco,$request->nrocheque,$request->nrocuenta,$request->titular);
					break;				
				case '4':
					$descripcion = 'Pago por Transferencia '.$request->nrotransferencia;
					$this->insertartransferencia($idpago,$request->nrotransferencia);
					break;				
				default:
					# code...
					break;
			}
			
			$idmovedo = $this->MovimientoEdoCta($request->idtributo,$request->monto,$descripcion);
			$this->actualizarpago($idpago,$idmovedo);
            \Session::flash('edocuenta','Se ha registrado el pago exitosamente');
			//\DB::rollback();
			\DB::commit();
		}
		catch(\Exception $ex)
        {
            \Session::flash('edocuenta','hubo un problema en el registro del pago, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('estadodecuenta', array($request->idtributo));
        }
		$edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->idtributo)->get();
		
		return \Redirect::route('estadodecuenta', array($request->idtributo));
	}	
	
	public function insertpago($idformapago,$valorfiscal,$talonario,$monto)
	{
		$idpago = new \App\Modelos\Taquilla\Pagos;
		$idpago->idsession = \Session::getId();
		$idpago->idstatus = 1;
		$idpago->idtipopago = 1;
		$idpago->idformapago = $idformapago;
		$idpago->idvalorfiscal = $valorfiscal;
		$idpago->talonario = $talonario;
		$idpago->fechapago = date('Y-m-d');
		$idpago->monto = $monto;
		$idpago->save();
		return $idpago->id;
	}

	public function insertpagotributo($idpago,$idtributo,$idedocuenta,$base,$monto,$saldo)
	{
		$idpagot = new \App\Modelos\Taquilla\PagosTributos;
		$idpagot->idpago = $idpago;
		$idpagot->idtributo = $idtributo;
		$idpagot->idedocuenta = $idedocuenta;
		$idpagot->base = $base;
		$idpagot->saldo = $saldo;
		$idpagot->monto = $monto;
		$idpagot->save();
		return;
	}

	public function updatemontoremanente($id,$monto)
	{
		$movedo = \App\Modelos\Tramites\EstadosCuentas::find($id);
		$movedo->montoremanente = $monto;
		$movedo->save();
		return;
	}

 	public function actualizarpago($id,$idmovedo)
	{
		$movedo = \App\Modelos\Taquilla\Pagos::find($id);
		$movedo->idmovedo = $idmovedo;
		$movedo->save();
		return;
	}   
    public function MovimientoEdoCta($idtributo,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = 1;
        $movedo->idsession = \Session::getId();
        $movedo->idtipomovimientoedo = 2;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = date('Y-m-d');
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = 0;
        $movedo->save();
        return $movedo->id;     
    }
	
	public function insertarcheque($idpago,$idbanco,$nrodecheque,$nrodecuenta,$titular)
	{
		$chq = new \App\Modelos\Taquilla\Cheques;
		$chq->idpago = $idpago;
		$chq->idbanco=$idbanco;
		$chq->nrodecheque=$nrodecheque;
		$chq->nrodecuenta=$nrodecuenta;
		$chq->titular=$titular;
		$chq->save();
		return;	
	}

	public function insertartarjeta($idpago,$idbanco,$idtipotarjeta,$titular,$nrotarjeta,$voucher)
	{
		$tarj = new \App\Modelos\Taquilla\Tarjetas();
		$tarj->idpago = $idpago;
		$tarj->idbanco=$idbanco;
		$tarj->idtipotarjeta=$idtipotarjeta;
		$tarj->idpunto=1;
		$tarj->titular=$titular;
		$tarj->nrotarjeta=$nrotarjeta;
		$tarj->voucher=$voucher;
		$tarj->save();
		return;	
	}

	public function insertartransferencia($idpago,$nrotransferencia)
    {
        $chq = new \App\Modelos\Taquilla\Transferencias;
        $chq->idpago = $idpago;
        $chq->nrotransferencia=$nrotransferencia;
        $chq->save();
        return; 
    }	
}

