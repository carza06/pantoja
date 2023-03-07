<?php

namespace App\Http\Controllers\RegistroyControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RucController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
		
		$inm = null;
		$lae = null;
		$pub = null;
		$sp = null;
		$ds = null;
		$editar = null;
		$editartrib = null;
		if(!is_null($request->nombre_razonsocial) || !is_null($request->cedularcn) || !is_null($request->idanterior)|| !is_null($request->sp))
		{
			if($request->cedularcn){
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::CedulaRcn($request->cedularcn)->get()->toarray();	
				//dd($busqueda);
			}

			if($request->idanterior){
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::IdAnterior($request->idanterior)->get()->toarray();
			}

			if($request->nombre_razonsocial){
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::Nombre($request->nombre_razonsocial)->get()->toarray();
			}

			if($request->sp){
				$busqueda = \App\Modelos\Tributos\SujetoPasivo::find($request->sp);

			}


			if(count($busqueda) == 1){
				if($request->sp){
					$sp = $busqueda;

				}else{
					$sp = $this->formatdata($busqueda);	
				}			
				
				$editarsp = \App\User::find(\Auth::user()->id)->Acciones()->where('idaccion',1)->get();
				if(count($editarsp) > 0 ){
					$editar = 1;
				}else{
					$editar = 0;	
				}
				$edittrib = \App\User::find(\Auth::user()->id)->Acciones()->where('idaccion',2)->get();
				if(count($edittrib) > 0 ){
					$editartrib = 1;
				}else{
					$editartrib = 0;	
				}				
				$tributos = \App\Modelos\Tributos\SujetoPasivo::find($sp['id'])->tributos()->where('idstatus',1)->get()->toarray();
				foreach ($tributos as $tributo) {
					$ubg = \App\Modelos\Tributos\UbicacionesGeograficas::find($tributo['idubicaciongeografica']);
					$edomonto = \App\Modelos\Tramites\EstadosCuentas::Total($tributo['id'])->where('idstatus',1)->sum('montoremanente');
					
					$cp = \App\Modelos\Main\Session::find($tributo['idsession']);
					
					$u = 'root';										
					switch ($tributo['idhechoimponible']) {
						case 1:
							# Hoteles
							$hoteles = \App\Modelos\Tributos\Hoteles::where('idtributo',$tributo['id'])->get();
							if($hoteles->count() > 0){
								$lae[] = array($tributo['id'],$ubg['direccion'],'Hoteleria',$edomonto,$u);	
							}
							$billares = \App\Modelos\Tributos\Billares::where('idtributo',$tributo['id'])->get();
							if($billares->count() > 0){
								$lae[] = array($tributo['id'],$ubg['direccion'],'Billares',$edomonto,$u);	
							}
							//dd($tipolicencia);
							//$lae[] = array($tributo['id'],$ubg['direccion'],$tipolicencia['tipolicencia'],$edomonto);
							break;
						case 2:
							# Propiedad inmobiliaria
							$inmueble = \App\Modelos\Tributos\Inmuebles::where('idtributo',$tributo['id'])->get()->toarray();
						    //dd($inmueble);
						   if(count($inmueble) > 0){
								$uso = \App\Modelos\Tributos\UsoInmuebles::find($inmueble[0]['idusoinm']);
								//dd($uso);
								$tipo  = \App\Modelos\Tributos\TipoInmuebles::find($inmueble[0]['idtipoinm']);
								$usosuelo = \App\Modelos\Tributos\UsosSuelos::find($inmueble[0]['idusosuelo']);
								$inm[] = array($tributo['id'],$ubg['direccion'],$uso['uso'],$tipo['tipo'],$usosuelo['descripcion'],$inmueble[0]['catastro'],$inmueble[0]['areacontruccion'],$edomonto);						    	
						   }
							//dd($inm);
							break;
						case 3:
							$permiso = \App\Modelos\Tributos\PermisoPublicidad::where('idtributo',$tributo['id'])->get()->toarray();

							//dd($edomonto);
							$vigente = $permiso[0]['fechadesde'].' - '. $permiso[0]['fechahasta'];
							$pub[] = array($tributo['id'],$ubg['direccion'],$vigente,$edomonto,$u);
							break;
						case 4:
							# Propiedad inmobiliaria
							break;
						case 5:
							# Propiedad inmobiliaria
							break;
						case 6:
							# Desecho Solidos
							$contratods = \App\Modelos\Tributos\ContratosDS::where('idtributo',$tributo['id'])->get()->toarray();
							//dd($contratods);
							$tarifa = \App\Modelos\Configuracion\TarifasDS::find($contratods[0]['idtarifa']);
							//dd($tarifa);
							$ds[] = array($tributo['id'],$tarifa['codigo'],$tarifa['tarifa'],$edomonto,$u);
							break;													
						default:
							# code...
							break;
					}

				}
				//dd($pub);	
			}elseif(count($busqueda) > 1){
				\Session::flash('busqueda','mas de un contribuyente');
				return view('registroycontrol.ruc')->with(['contribuyentes'=>$busqueda]);
				
			}else{
				\Session::flash('busqueda','El Contribuyente no existe');
			}
		}   	
    	return view('registroycontrol.ruc')->with(['sp'=>$sp,'pub'=>$pub,'lae'=>$lae,'inm'=>$inm,'ds'=>$ds,'editar'=>$editar,'editartrib'=>$editartrib]);	
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

    public function deudamorosa(Request $request)
    {

    	if($request->idtributo){
    		$tributo = \App\Modelos\Tributos\Tributos::find($request->idtributo);
    		if($tributo['idhechoimponible']!=6){
    			\Session::flash('busqueda','No se puede Generar deuda a este tipo de tributo');
    		}else{
    			$sup = \App\Modelos\Tributos\Tributos::find($tributo['id'])->sp()->get()->toarray();
    			$sp = $this->formatdata($sup);
    			return view('registroycontrol.generardeuda')->with(['sp'=>$sp,'idtributo'=>$tributo['id']]);
    		}
    	}

    	return view('registroycontrol.generardeuda');
    	
    } 

    public function procesardeuda(Request $request)
    {

        try{
	        \DB::beginTransaction();
	        $montotarifa = \App\Modelos\Tributos\ContratosDS::where('idtributo',$request->idtributo)->get()->toarray();
	        $tarifa = \App\Modelos\Configuracion\TarifasDS::find($montotarifa[0]['idtarifa']);
	        //dd($tarifa);
	        if($montotarifa[0]['idtipofrecuencia'] == 4){
	            $periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('desde','>=',$request->iniciocobro)->where('hasta','<=',$request->hastacobro)->get()->toarray();
	            $total = 0;
	            for($p=0; $p < count($periodos); $p++){
	                $edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->idtributo)->where('idstatus',1)->where('fecha',$periodos[$p]['fechafacturacion'])->where('idtipomovimientoedo',1)->get();
	                if($edo->count() < 1){
	                	$descripcion = 'Servicio de Recoleccion Desechos Solidos '.$periodos[$p]['descripcion'];
		                $this->MovimientoEdoCta(1,1,$request->idtributo,$periodos[$p]['fechafacturacion'],$tarifa['tarifa'],$descripcion);   
		            	$total+= $tarifa['tarifa'];	                	
	                }
	            }
	            $this->HistorialDeuda($request->idtributo,$request->iniciocobro,$request->hastacobro,$total);
	            $pm = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',date('Y-m-d'))->limit(1)->orderby('fechafacturacion','desc')->get();
				$saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($request->idtributo)
															->where('fecha','<',$pm[0]['hasta'])
															->where('idstatus',1)
															->where('montoremanente','>',0)
															->sum('montoremanente');
				$factura = \App\Modelos\Facturacion\Facturas::where('idtributo',$request->idtributo)->where('idperiodomensual',$pm[0]['id'])->get();
				if($factura->count() > 0){
					$df = \App\Modelos\Facturacion\DetalleFactura::where('idfactura',$factura[0]['id'])->update(['saldo'=>$saldoanterior]);
				}				
	        	\DB::commit();
	            \Session::flash('edocuenta','Se genero la deuda del tributo consulte el estado de cuenta');
	            return \Redirect::route('estadodecuenta', array('idtributo' => $request->idtributo));
	        }else{
	        	\DB::rollback();
	        	\Session::flash('busqueda','Comuniquese con el administrador del sitema, no se pudo generar la deuda el periodo de facturacion no es mensual');
	        	return \Redirect::route('generardeuda',array('idtributo' => $request->idtributo)); 
	        }        	
        }
        catch(\Exection $e)
        {
        	\DB::rollback();
        	\Session::flash('busqueda','comuniquese con el administrador del sitema, no se pudo generar la deuda');
        	return \Redirect::route('generardeuda',array('idtributo' => $request->idtributo));       	
        }

    } 
    public function HistorialDeuda($idtributo,$desde,$hasta,$monto)
    {
    	$h = new \App\Modelos\Seguridad\HistorialGenerarDeuda;
		$h->idsession = \Session::getId();
		$h->idtributo = $idtributo;
		$h->desde = $desde;
		$h->hasta = $hasta;
		$h->monto = $monto;
		$h->save();
		return;

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
