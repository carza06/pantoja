<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesechosSolidosController extends Controller
{
	public function index(Request $request)
	{
		\Session::put('ID',$request->id);
		\Session::put('ARBITRIO','DS');
		\Session::put('GUARDAR','guardards');
		$sectores = \App\Modelos\Configuracion\Sectores::all();
        $usosuelo = \App\Modelos\Tributos\UsosSuelos::orderby('descripcion')->get();
        $usoinm   = \App\Modelos\Tributos\UsoInmuebles::all();
        $tipoff   = \App\Modelos\Configuracion\TipoFrecuenciaFacturas::where('id',4)->get();
        $tarifads   = \App\Modelos\Configuracion\TarifasDS::all();
        $tipoambiente = \App\Modelos\Configuracion\TipoAmbiente::all();
        \Session::put('USOINM',$usoinm);
        \Session::put('USOSUELO',$usosuelo);
        \Session::put('TFF',$tipoff);
        \Session::put('TARIFADS',$tarifads);
        return view('registroycontrol.registrar')->with(['sectores'=>$sectores,'tipoambiente'=>$tipoambiente]);
	}

	public function store(Request $request)
	{
		try{
			\DB::beginTransaction();
			# Ubicacion Geografica
            $ubg     = $this->NuevaUBG($request->idsector,$request->idbarrio,$request->direccion);
            # Insertar Tributo Inmueble
			$idtributo = $this->NuevoTributo($ubg->id,2,$request->iniciocobro);
            # Datos del Sujeto Pasivo
			if(\Session::has('SP')){
				$idsp = \Session::get('SP.id');
                $nombre = \Session::get('SP.nombre_razonsocial');
			}else{
                # Datos Para Generar ID Control
                $codsec    = \App\Modelos\Configuracion\Sectores::find($request->idsector);
                $codbar    = \App\Modelos\Configuracion\Barrios::find($request->idbarrio);
                
                #Insertar Sujeto Pasivo
				$idsp = $this->NuevoSP($request->tiposp,
									   $request->cedula_rcn,
							   		   $request->nombre_razonsocial,
							   		   $request->telefonoprincipal,
							           $request->email);
				$id        = str_pad($idsp, 5, "0", STR_PAD_LEFT);
				$idcontrol = $codsec->codcatastro.$codbar->codigo.$id."N";
				$act = \App\Modelos\Tributos\SujetoPasivo::find($idsp);
				$act->idanterior = $idcontrol;
				$act->save();
                $nombre = $request->nombre_razonsocial;
			}
            # Insertar Relacion Sujeto Pasivo - Tributos
			$this->SujetoPasivoTributo($idtributo,$idsp);
            # Insertar Datos del Inmueble
            $inm = $this->NuevoINM($idtributo,$request->idusoinm,$request->idtipoinm,$request->idusosuelo);
            # Insertar Tributo Desecho Solidos
            $idtributo = $this->NuevoTributo($ubg->id,6,$request->iniciocobro);
            # Relacion SujetoPasivo - Tributo
            $this->SujetoPasivoTributo($idtributo,$idsp);
            # Contrato de Desecho Solido
            $contrato = $this->ContratoDS($idtributo,$inm->id,$request->categoria,$request->idtarifa,$request->idtipofrecuencia,$request->iniciocobro);
            # Generacion de Estado de Cuentas
            $montotarifa = \App\Modelos\Configuracion\TarifasDS::find($request->idtarifa);
            # Periodos a liquidar Impuesto
            $periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','>',$request->iniciocobro)->where('fechafacturacion','<=',date('Y-m-d'))->get()->toarray();
            for($p = 0; $p < count($periodos); $p++){
                $descripcion = 'Servicio de Recoleccion Desechos Solidos '.$periodos[$p]['descripcion'];	            
	            $this->MovimientoEdoCta($idtributo,$periodos[$p]['fechafacturacion'],$montotarifa['tarifa'],$descripcion);   
            }
            if($request->idusosuelo== 14 || $request->idusosuelo ==152 ){
                $tipofactura = 3;
            }else{
                $tipofactura = 1;
            }
            $facturacion = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',date('Y-m-d'))->orderby('fechafacturacion','desc')->limit(1)->get();
            //dd($facturacion);
            $edo =\App\Modelos\Tramites\EstadosCuentas::where('idtributo',$idtributo)
                                        ->where('idstatus',1)
                                        ->where('idtipomovimientoedo',1)
                                        ->where('montoremanente','>',0)
                                        ->orderby('fecha')
                                        ->limit(1)
                                        ->get();
            if($edo->count() > 0){
                $idperiodoinicial = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion',$edo[0]['fecha'])->get();
                $periodoinicial = $idperiodoinicial[0]['id'];
                $concepto = 'Recoleccion Desechos Solidos '.$idperiodoinicial[0]['descripcion'].' hasta '.$facturacion[0]['descripcion'];
            }else{
                $periodoinicial =$facturacion[0]['id'];
                $concepto = 'Recoleccion Desechos Solidos '.$facturacion[0]['descripcion'];
            }
           

            $idfacturads = $this->facturasds($periodoinicial,$facturacion[0]['id'],$idtributo,$tipofactura,$inm,$ubg,$nombre);
            $saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($idtributo)
                            ->where('fecha','<',$facturacion[0]['hasta'])
                            ->where('montoremanente','>',0)
                            ->sum('montoremanente');
            $this->detallefacturads($idfacturads,$concepto,$saldoanterior,$contrato);            
            //\DB::rollback();
           \DB::commit();
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

    public function NuevaUBG($idsector,$idbarrio,$direccion)
    {
        $idubg = new \App\Modelos\Tributos\UbicacionesGeograficas;
        $idubg->idsector  = $idsector;
        $idubg->idbarrio  = $idbarrio;
        $idubg->direccion = $direccion;
        $idubg->save();        
        return $idubg;     
    }


    public function NuevoTributo($idubg,$idhi,$iniciocobro)
    {
        $tributo = new \App\Modelos\Tributos\Tributos;
        $tributo->idsession = \Session::getId();
        $tributo->idstatus  = 1;
        $tributo->idhechoimponible = $idhi;
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
        $guardar->idtiposujetopasivo = 1;
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

    public function NuevoINM($idtributo,$idusoinm,$idtipoinm,$idusosuelo)
    {
        $idinm = new \App\Modelos\Tributos\Inmuebles;
        $idinm->idtributo          = $idtributo;
        $idinm->idusoinm           = $idusoinm;
        $idinm->idtipoinm          = $idtipoinm;
        $idinm->idusosuelo         = $idusosuelo;
        $idinm->save();        
        return $idinm;     
    } 

    public function ContratoDS($idtributo,$idinm,$categoria,$idtarifa,$idtipofrecuencia,$iniciocobro)
    {
        $contrato = new \App\Modelos\Tributos\ContratosDS;
        $contrato->idtributo         = $idtributo;
        $contrato->idinm             = $idinm;
        $contrato->idtarifa          = $idtarifa;
        $contrato->idtipofrecuencia  = $idtipofrecuencia;
        $contrato->iniciocobro       = $iniciocobro;
        $contrato->save();
        return $contrato;
    } 
    
    public function MovimientoEdoCta($idtributo,$fecha,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = 1;
        $movedo->idsession = \Session::getId();
        $movedo->idtipomovimientoedo = 1;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = $fecha;
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = $monto;
        $movedo->save();
        return;     
    }

    public function facturasds($idperiodoinicial,$idperiodomensual,$idtributo,$tipofactura,$inmueble,$ubg,$nombre)
    {
        $data = new \App\Modelos\Facturacion\Facturas;
        $data->idsession        =\Session::getId();     
        $data->idtributo        = $idtributo;
        $data->codigouso        = $inmueble->usosuelo->codigo;
        $data->usosuelo         = $inmueble->usosuelo->descripcion;
        $data->idinm            = $inmueble->id; 
        $data->idperiodoinicial = $idperiodoinicial;     
        $data->idperiodomensual = $idperiodomensual;
        $data->idtipofactura    = $tipofactura; 
        
        $data->idbarrio         = $ubg['idbarrio'];
        $data->idsector         = $ubg['idsector'];
        $data->direccion        = $ubg['direccion'];
        $data->sujetopasivo     = $nombre;
        $data->save();
        return $data->id;
    }

    public function detallefacturads($idfacturads,$concepto,$saldoanterior,$contrato)
    {
        $data = new \App\Modelos\Facturacion\DetalleFactura;
        $data->idfactura     = $idfacturads;
        $data->concepto      = $concepto;
        $data->saldo         = $saldoanterior;
        $data->monto         = $contrato->clasificador->tarifa;
        $data->save();
        return;
    }
}
