<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacturasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		//$periodos = \App\Modelos\Configuracion\PeriodosMensuales::PeriodoMensualNofacturado();
		$periodosfacturados = \App\Modelos\Facturacion\PeriodosFacturados::orderby('idperiodomensual','desc')->orderby('nrofacturas','asc')->get();
		$tipofacturacion = \App\Modelos\Configuracion\TipoFactura::all();
		return view('reportes.facturar')->with(['facturados'=>$periodosfacturados,'tipofacturacion'=>$tipofacturacion]);
	}



	public function barriosfacturas(Request $request)
	{
        $data = null;
        $barrios = \App\Modelos\Configuracion\Sectores::find($request->idsector)->barrio()->get();
       // dd($data);
        foreach ($barrios as $value) {
        	$nfacturas = \App\Modelos\Configuracion\Barrios::find($value->id)->BarrioFacturas()->where('idperiodomensual',$request->idperiodomensual)->where('idsector',$request->idsector)->where('idtipofactura',$request->idtipofactura)->count();
        	$saldo = \App\Modelos\Configuracion\Barrios::FacturasMonto($value->id,$request->idsector,$request->idperiodomensual,$request->idtipofactura)->sum('df.saldo');
        	$monto = \App\Modelos\Configuracion\Barrios::FacturasMonto($value->id,$request->idsector,$request->idperiodomensual,$request->idtipofactura)->sum('df.monto');
        	$data[] = array($value->id,$value->barrio,$nfacturas,$saldo,$monto);
        }
     	
 		return view('reportes.barriofactura')->with(['data'=>$data,'idperiodomensual'=>$request->idperiodomensual,'idsector'=>$request->idsector,'idtipofactura'=>$request->idtipofactura]);
	}

	public function sectorfacturas(Request $request)
	{
        $data = null;
        $sectores = \App\Modelos\Configuracion\Sectores::all();
       // dd($data);
        foreach ($sectores as $value) {
        	$nfacturas = \App\Modelos\Configuracion\Sectores::find($value->id)->SectorFacturas()->where('idperiodomensual',$request->idperiodomensual)->where('idtipofactura',$request->idtipofactura)->count();
        	$saldo = \App\Modelos\Configuracion\Sectores::FacturasMonto($value->id,$request->idperiodomensual,$request->idtipofactura)->sum('df.saldo');
        	$monto = \App\Modelos\Configuracion\Sectores::FacturasMonto($value->id,$request->idperiodomensual,$request->idtipofactura)->sum('df.monto');
        	$data[] = array($value->id,$value->sector,$nfacturas,$saldo,$monto);
        }
     	
 		return view('reportes.sectorfactura')->with(['data'=>$data,'idperiodomensual'=>$request->idperiodomensual,'idtipofactura'=>$request->idtipofactura]);
	}

	public function facturas(Request $request)
	{
        
        $mes = \App\Modelos\Configuracion\PeriodosMensuales::find($request->idperiodomensual);
        $barrio = \App\Modelos\Configuracion\Barrios::find($request->idbarrio);
        
        $file = str_replace(' ', '', $mes->descripcion).'_SECTOR'.$request->idsector.'_'.str_replace(' ', '', $barrio->barrio).'.pdf';
        $data = \App\Modelos\Facturacion\Facturas::where('idperiodomensual',$request->idperiodomensual)->where('idtipofactura',$request->idtipofactura)->where('idsector',$request->idsector)->where('idbarrio',$request->idbarrio)->get();
        $view =  \View::make('pdf.facturas', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        /*$pdf->setOptions(['isPhpEnabled'=>true]);
        $paper_size = array(0,0,612,406);
        $pdf->setPaper($paper_size);*/
        $pdf->loadHTML($view);
        return $pdf->download($file);		
	}
	
	public function imprimirhfactura(Request $request)
	{
		$data = \App\Modelos\Facturacion\Facturas::find($request->id);
		$edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->idtributo)
													->where("idstatus",">", 0)
													->where('idtipomovimientoedo',1)
													->where('montoremanente','>',0)
													->orderby('fecha')
													->limit(1)
													->get();

		$periodo = \App\Modelos\Configuracion\PeriodosMensuales::select('descripcion')->where('fechafacturacion',$edo[0]['fecha'])->get();
		//$data = \App\Modelos\Facturacion\FacturasDS::find($id[0]['id']);
	   	if($data->idtipofactura <> 2){
			$view =  \View::make('pdf.facturan')->with(['data'=>$data,'periodo'=>$periodo])->render();	
		}else{
			$view =  \View::make('pdf.factura', compact('data'))->render();	
		}
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('factura.pdf');	
	}

	public function generar(Request $request)
	{
		if($request->idtipofactura == 3){
			$inmuebles = \App\Modelos\Tributos\Inmuebles::Vip()->get();	
			//dd($inmuebles);
		}
		if($request->idtipofactura == 1){
			$inmuebles = \App\Modelos\Tributos\Inmuebles::whereNotIn('idusosuelo',[14,27,152,222,223])->get();
			//dd($inmuebles);	
		}
		if($request->idtipofactura == 2){
			\Session::flash('transaccion','Silvia Silvia Silvia o Carlos Carlos Carlos esto no se hace por aqui!!!');
			return \Redirect::route('facturar');
			
		}
		if($request->idtipofactura == 4){
			\Session::flash('transaccion','Silvia Silvia Silvia o Carlos Carlos Carlos sin los los Sectores Barrios y Calle no se puede generar esta facturacion');
			return \Redirect::route('facturar');
			//$inmuebles = \App\Modelos\Tributos\Inmuebles::whereIn('idusosuelo',[14,27,152,222,223])->get();
			//dd($inmuebles);
		}
		$pm = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',date('Y-m-d'))->limit(1)->orderby('fechafacturacion','desc')->get();
		$fecha = \App\Modelos\Configuracion\PeriodosMensuales::find($pm[0]['id']);
		$deudamorosa = 0;
		$montomes = 0;
		$nrofacturas = 0;
		foreach ($inmuebles as $inmueble) {
			try{
				
				if($request->idtipofactura == 3){
				$contratos = \App\Modelos\Tributos\ContratosDS::where('idtributo',$inmueble->idtributo)->get();
				}
				if($request->idtipofactura == 1){
				$contratos = \App\Modelos\Tributos\ContratosDS::where('idinm',$inmueble->id)->get();
				}
				// Factura Desechos Solidos
				foreach ($contratos as $contrato){
					
					$verificar = \App\Modelos\Facturacion\Facturas::where('idperiodomensual',$pm[0]['id'])->where('idtributo',$contrato->idtributo)->get();
					if($verificar->count() == 0){

						$tributo = \App\Modelos\Tributos\Tributos::find($contrato->idtributo);
						if($tributo->idstatus == 1 && (date('Y-m-d',strtotime($tributo->fechainicial))) <= $pm[0]['fechafacturacion'] ){
							$edomonto = \App\Modelos\Tramites\EstadosCuentas::Total($contrato->idtributo)->where('idstatus',1)->sum('montoremanente');
							if($edomonto > 0){
								\DB::beginTransaction();
								$idsp = \App\Modelos\Tributos\Tributos::find($contrato->idtributo)->sp()->get();
								//dd($idsp);
								$ubg = \App\Modelos\Tributos\UbicacionesGeograficas::find($tributo['idubicaciongeografica']);
								$edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$contrato->idtributo)
															->where('idstatus',1)
															->where('idtipomovimientoedo',1)
															->where('montoremanente','>',0)
															->orderby('fecha')
															->limit(1)
															->get();
								if($edo->count() > 0){
									$idperiodoinicial = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion',$edo[0]['fecha'])->get();
									$periodoinicial = $idperiodoinicial[0]['id'];
								}else{
									$periodoinicial =$pm[0]['id'];
								}
								

								$idfacturads = $this->facturaslote($periodoinicial,$pm[0]['id'],$contrato->idtributo,$request->idtipofactura,$inmueble,$ubg,$idsp);
								$saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($contrato->idtributo)
																	->where('fecha','<',$fecha['hasta'])
																	->where('idstatus',1)
																	->where('montoremanente','>',0)
																	->sum('montoremanente');
								$deudamorosa+=$saldoanterior ;
								$montomes+=$contrato->clasificador->tarifa;
								$concepto = 'Recoleccion de Desechos Solidos '.$idperiodoinicial[0]['descripcion'].' hasta '.$pm[0]['descripcion'];
								// Detalle Factura Desechos Solidos
								$this->detallefacturas($idfacturads,$concepto,$saldoanterior,$contrato);
								$nrofacturas++;
								\DB::commit();
							}							
						}

					}
	
				}
				
			}
        	catch(Exception $ex)
        	{
	            \Session::flash('transaccion','hubo un problema en la generacion de la facturacion, comunique de inmediato al departamento de sistema');
	            \DB::rollback();
            
        	}		
		}
			if($nrofacturas > 0){
				$pf = \App\Modelos\Facturacion\PeriodosFacturados::where('idperiodomensual',$pm[0]['id'])->where('idtipofactura', $request->idtipofactura)->get();
				if(!$pf->count() > 0) {
					$this->periodosfacturados($pm[0]['id'],$request->idtipofactura,$nrofacturas,$deudamorosa,$montomes);	
				}else{
					\Session::flash('transaccion','Se generaron '.$nrofacturas.' nuevas facturas');
				}	
			}
			return \Redirect::route('facturar');	
	}

	public function generarfacturaespecial(Request $request)
	{
  		try{
			\DB::beginTransaction();
        	$contrato = \App\Modelos\Tributos\ContratosDS::where('idtributo',$request->idtributo)->get();
        	$inmueble = \App\Modelos\Tributos\Inmuebles::find($contrato[0]['idinm']);
        
        	$idperiodomensual = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<',date('Y-m-d'))->orderby('fechafacturacion','desc')->limit(1)->get()->toarray();

			$tributo = \App\Modelos\Tributos\Tributos::find($request->idtributo);
			$idsp = \App\Modelos\Tributos\Tributos::find($request->idtributo)->sp()->get();
			$ubg = \App\Modelos\Tributos\UbicacionesGeograficas::find($tributo['idubicaciongeografica']);
			$tarifaespecial = \App\Modelos\Configuracion\TarifasDSespecial::find($request->idtarifaespecial);
			$monto = $request->tonelada * $tarifaespecial->tarifa;
			$descripcion = 'Recoleccion Especial de Desecho Solido '.$request->tonelada.' tonelada tarifa: '.$tarifaespecial->tarifa;
			$this->MovimientoEdoCta($request->idtributo,$monto,$descripcion);
			$saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($request->idtributo)
														->where('fecha','<',date('Y-m-d'))
														->where('montoremanente','>',0)
														->where('idstatus',1)
														->sum('montoremanente');		
			$idfacturads = $this->facturaslote($idperiodoinicial,$idperiodomensual[0]['id'],$request->idtributo,2,$inmueble,$ubg,$idsp);
        	$this->detallefacturadsespecial($idfacturads,$saldoanterior,$request->tonelada,$monto);
        	\DB::commit();
        	\Session::flash('transaccion','Se genero satisfactoriamente la facturación especial');
		}
    	catch(\Exception $ex)
    	{
            \Session::flash('transaccion','hubo un problema en generar la facturación especial, comunique de inmediato al departamento de sistema');
            \DB::rollback();
        
    	}
    	return redirect()->route('facturacionespecial', ['idtributo' => $request->idtributo]);
    		
	}
    
	public function imprimirfacturaespecial(Request $request)
	{
		$data = \App\Modelos\Facturacion\Facturas::find($request->id);
	    $view =  \View::make('pdf.factura', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('factura.pdf');	
	}

	public function imprimirfactura(Request $request)
	{
		$id = \App\Modelos\Facturacion\Facturas::where('idtributo',$request->id)->where('idtipofactura','<>',2)->orderby('id','desc')->limit(1)->get()->toarray();
		$edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->id)
													->where('idstatus',1)
													->where('idtipomovimientoedo',1)
													->where('montoremanente','>',0)
													->orderby('fecha')
													->limit(1)
													->get();
		if($edo->count() > 0){
			$periodo = \App\Modelos\Configuracion\PeriodosMensuales::select('descripcion')->where('fechafacturacion',$edo[0]['fecha'])->get();
		}else{
			$periodo = \App\Modelos\Configuracion\PeriodosMensuales::select('descripcion')->where('id',$id[0]['idperiodomensual'])->get();
		}

		$data = \App\Modelos\Facturacion\Facturas::find($id[0]['id']);
	   	if($data->idtipofactura <> 2){
			$view =  \View::make('pdf.facturan')->with(['data'=>$data,'periodo'=>$periodo])->render();	
		}else{
			$view =  \View::make('pdf.factura', compact('data'))->render();	
		}
		
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('factura.pdf');	
	}
	public function imprimirfacturapub(Request $request)
	{
		$id = \App\Modelos\Facturacion\Facturas::where('idtributo',$request->id)->orderby('id','desc')->limit(1)->get()->toarray();	

		$data = \App\Modelos\Facturacion\Facturas::find($id[0]['id']);
		$view =  \View::make('pdf.facturap')->with(['data'=>$data])->render();	
		
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('factura.pdf');	
	}
	public function asignarvalorfiscal(Request $request)
	{
		$factura = ltrim($request->factura, "0");
		$lote = \App\Modelos\Configuracion\LoteValorFiscal::where('asignado',0)->where('idtipolote',$request->idtipolote)->orderby('id','asc')->limit(1)->get()->toarray();
		if(count($lote)>0){
			$data = \App\Modelos\Facturacion\Facturas::find($factura);
			// return $data;
			if(!empty($data)){
				if(is_null($data->idlotevalorfiscal)){
					$idvalorfiscal = $lote[0]['id'];
					$asignado = \App\Modelos\Configuracion\LoteValorFiscal::find($lote[0]['id']);
					$asignado->asignado = 1;
					$asignado->save();					
					$data->idlotevalorfiscal = $idvalorfiscal;
					$data->save();
					$edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$data->idtributo)
														->where('idstatus',1)
														->where('idtipomovimientoedo',1)
														->where('montoremanente','>',0)
														->orderby('fecha')
														->limit(1)
														->get();
					$periodo = \App\Modelos\Configuracion\PeriodosMensuales::select('descripcion')->where('fechafacturacion',$edo[0]['fecha'])->get();
				   	if($data->idtipofactura <> 2){
						$view =  \View::make('pdf.facturan')->with(['data'=>$data,'periodo'=>$periodo])->render();	
					}else{
						$view =  \View::make('pdf.factura', compact('data'))->render();	
					}
			        $pdf = \App::make('dompdf.wrapper');
			        $pdf->loadHTML($view);
			        return $pdf->stream('factura.pdf');	
							
				}else{
					echo 'la factura ya tiene un valor asignado';
				}
			}else{
				echo 'No se encontro ninguna factura con ese número';
			}

		}else{
			echo 'No hay valores fiscales disponibles';
		}
	
	}

	public function valorfiscal(Request $request)
	{
		$tipolote =\App\Modelos\Configuracion\TipoLote::all();
		return view('reportes.valorfiscal')->with(['tipolote'=>$tipolote]);
	}

	public function imprimiravisodecobro(Request $request)
	{
		
		$sp = \App\Modelos\Tributos\Tributos::find($request->id)->sp()->get();
		$pub = \App\Modelos\Tributos\PermisoPublicidad::where('idtributo',$request->id)->get();
		$edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->id)->where('montoremanente','>',0)->where('idstatus',1)->get();
		$m = date("m");
		$y = date("y");
		$num = $request->id.$m.$y;
		$numero = str_pad($num, 10, "0", STR_PAD_LEFT);
		$view =  \View::make('pdf.avisodecobro')->with(['numero'=>$numero,'sp'=>$sp,'pub'=>$pub,'edo'=>$edo])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Aviso'.$request->id.'.pdf');		
		
	}

	public function facturaslote($idperiodoinicial,$idperiodomensual,$idtributo,$tipofactura,$inmueble,$ubg,$idsp)
	{
		$data = new \App\Modelos\Facturacion\Facturas;
		$data->idsession		=\Session::getId();		
		$data->idtributo		= $idtributo;
		$data->codigouso		= $inmueble->usosuelo->codigo;
		$data->usosuelo			= $inmueble->usosuelo->descripcion;
		$data->idinm			= $inmueble->idmigracion;
		$data->idperiodoinicial = $idperiodoinicial;		
		$data->idperiodomensual = $idperiodomensual;
		$data->idtipofactura    = $tipofactura; 
		
		$data->idbarrio			= $ubg['idbarrio'];
		$data->idsector			= $ubg['idsector'];
		$data->direccion	 	= $ubg['direccion'];
		$data->sujetopasivo  	= $idsp[0]['nombre_razonsocial'];
		$data->rnc  			= $idsp[0]['cedula_rcn'];
		$data->save();
		return $data->id;
	}

	public function detallefacturas($idfactura,$concepto,$saldoanterior,$contrato)
	{
		$data = new \App\Modelos\Facturacion\DetalleFactura;
		$data->idfactura     = $idfactura;
		$data->concepto 	 = $concepto;
		$data->saldo = $saldoanterior;
		$data->monto      = $contrato->clasificador->tarifa;
		$data->save();
		return;
	}
	
	public function detallefacturadsespecial($idfacturads,$saldoanterior,$tonelada,$monto)
	{
		$data = new \App\Modelos\Facturacion\DetalleFacturaEspecial;
		$data->idfacturads   = $idfacturads;
		$data->tonelada 	 = $tonelada;
		$data->saldoanterior = $saldoanterior;
		$data->monto         = $monto;
		$data->save();
		return;
	}

	public function periodosfacturados($idperiodomensual,$idtipofactura,$nrofacturas,$deudamorosa,$montomes)
	{
		$data = new \App\Modelos\Facturacion\PeriodosFacturados;
		$data->idsession		=\Session::getId();
		$data->idperiodomensual= $idperiodomensual;
		$data->idtipofactura   = $idtipofactura;
		$data->nrofacturas     = $nrofacturas;
		$data->deudamorosa     = $deudamorosa;
		$data->montomes	       = $montomes;
		$montototal 		   = $deudamorosa + $montomes;
		$data->montototal      = $montototal;
		$data->save();
		return;
	}

	public function MovimientoEdoCta($idtributo,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = 1;
        $movedo->idsession = \Session::getId();
        $movedo->idtipomovimientoedo = 5;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = date('Y-m-d');
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = $monto;
        $movedo->save();
        return;     
    }
}
