<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmbienteController extends Controller
{
	public function index(Request $request)
	{
		\Session::put('ID',$request->id);
		\Session::put('ARBITRIO','AMBIENTE');
		\Session::put('GUARDAR','guardarambiente');
		$sectores = \App\Modelos\Configuracion\Sectores::all();
        $tipoambiente = \App\Modelos\Configuracion\TipoAmbiente::all();
        return view('registroycontrol.registrar')->with(['sectores'=>$sectores,'tipoambiente'=>$tipoambiente]);
	}

	public function store(Request $request)
	{
		try{
			\DB::beginTransaction();
            $automatico =0;  
            $idfrecuencia = 4;
			$idubg     = $this->NuevaUBG($request->idsector,$request->idbarrio,$request->direccion);
			$idtributo = $this->NuevoTributo($idubg,$request->iniciocobro);
			$codsec    = \App\Modelos\Configuracion\Sectores::find($request->idsector);
			$codbar    = \App\Modelos\Configuracion\Barrios::find($request->idbarrio);
		
            $ubg       = \App\Modelos\Tributos\UbicacionesGeograficas::find($idubg);
            $baseimp = 0;
			if(\Session::has('SP')){
				$idsp = \Session::get('SP.id');
			}else{
				$idsp = $this->NuevoSP($request->tiposp,
									   $request->cedula_rcn,
							   		   $request->nombre_razonsocial,
							   		   $request->telefonoprincipal,
							           $request->email);
				$id        = str_pad($idsp, 6, "0", STR_PAD_LEFT);
				$idcontrol = $codsec->codcatastro.$codbar->codigo.$id."N";
				$act = \App\Modelos\Tributos\SujetoPasivo::find($idsp);
				$act->idanterior = $idcontrol;
				$act->save();
			}
			$this->SujetoPasivoTributo($idtributo,$idsp);
            $sp = \App\Modelos\Tributos\SujetoPasivo::find($idsp);
			
            # Impuesto Ambiente
            if($request->idtipoambiente == 1 && $request->idambientecategoria == 1  ){
                if($request->bedStatus == 'espacio'){
                    $baseimp = $request->nespacios;
                    $automatico =0;
                    $tarifa = \App\Modelos\Configuracion\ClasificadorAmbienteDrenaje::where('idtipoambiente',$request->idtipoambiente)->where('idtipoambientecategoria',$request->idambientecategoria )->where('desde','<=',$request->nespacios)->where('hasta','>=',$request->nespacios)->get();
                        $impuesto = $tarifa[0]['monto'];
                        //$descripcion = 'Impuesto por Ambiente CarWash Nro de Espacios '.$request->nespacios;
                        $descripcion = 'Ambiente y gestión de riesgo';
                        $idmovedo = 12; 

                }else{
                    $baseimp = 0;
                    $automatico = 1;
                     $tarifa = \App\Modelos\Configuracion\ClasificadorCarWashAutomatico::where('idtipoambiente',$request->idtipoambiente)->get();
                    $impuesto = $tarifa[0]['monto'];
                    //$descripcion = 'Impuesto por Ambiente CarWash Automaticos ';
                    $descripcion = 'Ambiente y gestión de riesgo';
                    $idmovedo = 12; 
                }

            }

            if($request->idtipoambiente == 1 && ($request->idambientecategoria == 2 || $request->idambientecategoria == 3)){
                $baseimp = $request->ngalones;
                           
                $tarifa = \App\Modelos\Configuracion\ClasificadorAmbienteDrenaje::where('idtipoambiente',$request->idtipoambiente)->where('idtipoambientecategoria',$request->idambientecategoria )->where('desde','<=',$request->ngalones)->where('hasta','>=',$request->ngalones)->get();
                    
                if($request->tf == 'mensual'){
                    $base = $tarifa[0]['monto'];
                    $extra = $tarifa[0]['extra'];    
                }else{
                    $idfrecuencia = 1;
                    $base = $tarifa[0]['montoanual'];
                    $extra = $tarifa[0]['extraanual'];   
                }

                if($request->ngalones > 20000 && $request->idambientecategoria == 2){
                    //echo $request->ngalones;
                    $galones = $request->ngalones - 20000;
                    //echo $galones;
                    $calculo = $galones/5000;
                    //echo $calculo;
                    $adicional = intval($calculo) * $extra;
                    //dd($adicional);
                    $base = $base + $adicional;  

                }
                $impuesto = $base; 
                if( $request->idambientecategoria == 2){
                    //$descripcion = 'Impuesto por Ambiente de Gasolineras Nro de Galones: '.$request->ngalones;
                    $descripcion = 'Ambiente y gestión de riesgo';

                }
                if( $request->idambientecategoria == 3){
                    //$descripcion = 'Impuesto por Ambiente de Envasadoras de Gas Licuado Nro de Galones: '.$request->ngalones;
                    $descripcion = 'Ambiente y gestión de riesgo';
                }
                $idmovedo = 12;   
            }

            if($request->idtipoambiente == 1 && (in_array($request->idambientecategoria, [6,7,8,9,10,11])) ){
                $tarifa = \App\Modelos\Configuracion\ClasificadorAmbienteDrenaje::where('idtipoambiente',$request->idtipoambiente)->where('idtipoambientecategoria',$request->idambientecategoria )->get();

                if($request->tf == 'mensual'){
                    $impuesto = $tarifa[0]['monto'];
                       
                }else{
                    $idfrecuencia = 1;
                    $impuesto = $tarifa[0]['montoanual'];
                       
                }
                $caso = \App\Modelos\Configuracion\TipoAmbienteCategoria::find($request->idambientecategoria);
                //$descripcion = 'Impuesto por otras compensaciones para la prevención del medio ambiente y gestión de riesgo '.$caso->tipoambientecategoria;
                $descripcion = 'Ambiente y gestión de riesgo';
                $idmovedo = 12;
            }

            if($request->idtipoambiente == 1 && $request->idambientecategoria == 12){
                if($request->tf == 'mensual'){
                    $impuesto = $request->mobjecion;
                    $baseimp = $request->mobjecion;
                       
                }else{
                    $idfrecuencia = 1;
                    $impuesto =  $request->mobjecion;
                    $baseimp = $impuesto;
                       
                }
                //$descripcion = 'Impuesto por por Ambiente No Objecion ';
                $descripcion = 'Ambiente y gestión de riesgo';
                $idmovedo = 12;            
            }

            # Impuesto Drenaje
            if($request->idtipoambiente == 2 && $request->idambientecategoria == 4  ){
                if($request->bedStatus == 'espacio'){
                    $baseimp = $request->npuestos;
                    $automatico =0;
                    $tarifa = \App\Modelos\Configuracion\ClasificadorAmbienteDrenaje::where('idtipoambiente',$request->idtipoambiente)->where('idtipoambientecategoria',$request->idambientecategoria )->where('desde','<=',$request->npuestos)->where('hasta','>=',$request->npuestos)->get();
                    $impuesto = $tarifa[0]['monto'];
                    $descripcion = 'Impuesto por Drenajes Pluviales CarWash Nro de Puestos '.$srequest->npuestos;
                    $idmovedo = 13;  

                }else{
                     $baseimp = 0;
                     $automatico =1;
                     $tarifa = \App\Modelos\Configuracion\ClasificadorCarWashAutomatico::where('idtipoambiente',$request->idtipoambiente)->get();
                     $impuesto = $tarifa[0]['monto'];
                     $descripcion = 'Impuesto por Drenajes Pluviales CarWash Automaticos ';
                     $idmovedo = 13; 
                }

            }           
            if($request->idtipoambiente == 2 && $request->idambientecategoria == 5  ){             
                $baseimp = $request->ngalones;
                $automatico =0;
                $tarifa = \App\Modelos\Configuracion\ClasificadorAmbienteDrenaje::where('idtipoambiente',$request->idtipoambiente)->where('idtipoambientecategoria',$request->idambientecategoria )->where('desde','<=',$request->ngalones)->where('hasta','>=',$request->ngalones)->get();
                    $impuesto = $tarifa[0]['monto'];
                    $descripcion = 'Impuesto por Drenajes Pluviales de Gasolineras Nro de Galones: '.$request->ngalones;
                    $idmovedo = 13;
            }
            //dd($request->all());

			$this->AmbienteyDrenaje($idtributo,$request->idtipoambiente,$request->idambientecategoria,$idfrecuencia,$automatico,$baseimp);
           
            if($idfrecuencia == 1){
                $periodos = \App\Modelos\Configuracion\PeriodosAnual::where('hasta','>',$request->iniciocobro)->get()->toarray();
            }else{
                $periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('hasta','>',$request->iniciocobro)->where('desde','<',date('Y-m-d'))->get()->toarray();
            }
            
            
            for($p=0; $p < count($periodos); $p++){
                if ($p == 0) {
                   $inicio = $periodos[$p]['id'];
                   $final  = $periodos[$p]['id'];
                   $fecha = $periodos[$p]['desde'];
                }else{
                   $final  = $periodos[$p]['id'];
                   $fecha = $periodos[$p]['desde'];
                }
                $concepto = $descripcion.' ('.$periodos[$p]['descripcion'].')';
	            $this->MovimientoEdoCta($idtributo,$periodos[$p]['desde'],$idmovedo,$impuesto,$concepto);   
            }

            \DB::commit();
            # Generar Factura
            try{
                \DB::beginTransaction();
                if($idfrecuencia == 1){
                    $edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$idtributo)
                                ->where('idstatus',1)
                                ->where('montoremanente','>',0)
                                ->orderby('fecha')
                                ->get();
                    $idfacturads = $this->facturas($inicio,$final,$idtributo,6,$ubg,$sp);        
                    foreach ($edo as $detalle) {
                        $this->detallefactura($idfacturads,$detalle->descripcion,0,$detalle->montoremanente);
                       
                    }                    
                }
                // else{
                //     $saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($idtributo)
                //                                                     ->where('fecha','<',$fecha)
                //                                                     ->where('idstatus',1)
                //                                                     ->where('montoremanente','>',0)
                //                                                     ->sum('montoremanente');
                //     $idfacturads = $this->facturasds($inicio,$final,$idtributo,6,$ubg,$sp);
                //     $this->detallefacturads($idfacturads,$descripcion,$saldoanterior,$impuesto);         
                // }


                \DB::commit();
            }
            catch(Exception $ex)
            {
                \DB::rollback();
                \Session::flash('edocuenta','El registro del arbitrio ha sido exitoso,pero hubo un problema en la generacion de la factura, contacte al administrador del sistema');
                return \Redirect::route('estadodecuenta',[$idtributo]);          
            }


		    \Session::flash('edocuenta','El registro del arbitrio ha sido exitoso, ha sido redirigido al estado de cuentas');
	        return \Redirect::route('estadodecuenta',[$idtributo]);
	    }
		catch(Exception $ex)
        {
            \Session::flash('transaccion','hubo un problema en el registro del arbitrio, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('registro');			
		}

	}

    public function buscarcategoriaambiente(Request $request)
    {
        
        $data = \App\Modelos\Configuracion\TipoAmbienteCategoria::where('idtipoambiente',$request->id)->get();
        //$data = $data->toarray();
        return response()->json($data);//then sent this data to ajax success

    } 

    public function NuevaUBG($idsector,$idbarrio,$direccion)
    {
        $idubg = new \App\Modelos\Tributos\UbicacionesGeograficas;
        $idubg->idsector  = $idsector;
        $idubg->idbarrio  = $idbarrio;
    
        $idubg->direccion = $direccion;
        $idubg->save();        
        return $idubg->id;     
    }


    public function NuevoTributo($idubg,$iniciocobro)
    {
        $tributo = new \App\Modelos\Tributos\Tributos;
        $tributo->idsession = \Session::getId();
        $tributo->idstatus  = 1;
        $tributo->idhechoimponible = 1;
        $tributo->idubicaciongeografica = $idubg;
        $tributo->fechainicial = $iniciocobro;
        $tributo->nuevotributo = 1;
        $tributo->save();        
        return $tributo->id;     
    }

	public function NuevoSP($tipo,$cedularnc,$nombre,$telefono,$email){
        $guardar = new \App\Modelos\Tributos\SujetoPasivo;
        $guardar->idsession          = \Session::getId();
        $guardar->idstatus           = 1;
        $guardar->idtiposujetopasivo = $tipo;
        $guardar->cedula_rcn         = $cedularnc;
        $guardar->nombre_razonsocial = $nombre;
        $guardar->telefonoprincipal  = $telefono;
        $guardar->email              = $email;
        $guardar->fechadeingreso     = date('Y-m-d');
        $guardar->save();
        return $guardar->id;     
    }

    public function SujetoPasivoTributo($idtributo,$idsp,$representantelegal = 0)
    {
        $spt = new \App\Modelos\Tributos\SujetoPasivo_Tributo;
        $spt->idsujetopasivo = $idsp;
        $spt->idtributo = $idtributo;
        $spt->idsession = \Session::getId();
        $spt->responsable = 1;
        $spt->representantelegal = $representantelegal;
        $spt->propietario = 1;
        $spt->save();        
        return; 
    }    

    public function AmbienteyDrenaje($idtributo,$idtipoambiente,$idtipoambientecategoria,$idfrecuencia,$automatico,$base)
    {
        $data = new \App\Modelos\Tributos\AmbienteYDrenaje;
        $data->idtributo = $idtributo;
        $data->idtipoambiente = $idtipoambiente;
        $data->idtipoambientecategoria = $idtipoambientecategoria;
        $data->idfrecuencia = $idfrecuencia;
        $data->automatico = $automatico;
        $data->base = $base;
        $data->save();        
      	return; 
    } 
    
    public function MovimientoEdoCta($idtributo,$fecha,$idmovedo,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = 1;
        $movedo->idsession = \Session::getId();
        $movedo->idtipomovimientoedo = $idmovedo;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = $fecha;
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = $monto;
        $movedo->save();
        return;     
    }

    public function facturas($idperiodoinicial,$idperiodomensual,$idtributo,$tipofactura,$ubg,$sp)
    {
        $data = new \App\Modelos\Facturacion\Facturas;
        $data->idsession        =\Session::getId();     
        $data->idtributo        = $idtributo;
        $data->idperiodoinicial = $idperiodoinicial;
        $data->idperiodomensual = $idperiodomensual;  
        $data->idtipofactura    = $tipofactura;        
        $data->idbarrio         = $ubg['idbarrio'];
        $data->idsector         = $ubg['idsector'];
        
        $data->direccion        = $ubg['direccion'];
        $data->rnc              = $sp['cedula_rcn'];
        $data->sujetopasivo     = $sp['nombre_razonsocial'];
        $data->save();
        return $data->id;
    }

    public function detallefactura($idfacturads,$concepto,$saldoanterior,$monto)
    {
        $data = new \App\Modelos\Facturacion\DetalleFactura;
        $data->idfactura   = $idfacturads;
        $data->concepto    = $concepto;
        $data->saldo      = $saldoanterior;
        $data->monto      = $monto;
        $data->save();
        return;
    }
}
