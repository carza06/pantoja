<?php

namespace App\Http\Controllers\Tramites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Tramites\TipoTramites;
use Session;
use App\Modelos\Tributos\SujetoPasivo;

class TramitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listado()
    {
         $tramites = \App\Modelos\Tramites\Tramites::orderby('id','desc')->paginate(20);
         return view('tramites.tramites')->with(['tramites' => $tramites]);
    }
    /*
    | INICIO DEL PROCESO DEL TRAMITE
    | SELCCION DEL TRAMITE
    */

    public function index(Request $request)
    {
    	if($request->idhi){
            $tramites = TipoTramites::where('idstatus', 1)
                                    ->where('idhechoimponible', $request->idhi)
                                    ->orderBy('idhechoimponible','asc')
                                    ->get();           
        }else{
            $tramites = TipoTramites::where('idstatus', 1)
                                    ->orderBy('idhechoimponible','asc')
                                    ->get();            
        }
        $hi = \App\Modelos\Main\HechoImponible::all();
        return view('tramites.index')->with(['tramites' => $tramites, 'hi' => $hi]);
    }

    public function solicitante(Request $request)
    {
        if(Session::has('ST')){
            Session::forget('ST');
        }
         $tipotramite = $request->all();
         return view('tramites.solicitante')->with(['tipotramite'=>$tipotramite]);       

    }

    /*
    | Requisitos
    */
    public function tramiterequisitos(Request $request)
    {
    	if(Session::has('REQ')){
            Session::forget('REQ');
        }

        $tramite = TipoTramites::find($request->id);
        Session::put('TMT', $tramite);
        Session::put('ST', $request->all());
        Session::put('HI',$tramite['idhechoimponible']);
        Session::put('ID',$tramite['id']);
        /* VALIDA SI REQUIERE ALGUN REQUISITO */
        $requisitos = $this->validarequisitos($request->id);    	
        if( $requisitos->count() ){
    		return view('tramites.requisitos')->with(['tramite'=>$tramite]); 
    	}
        if(Session::has('SP')){
            Session::forget('SP');
        }
        return \Redirect::route('sujetopasivo');
    }

    public function regrequisitos(Request $request)
    {
        //dd($request->all());
        Session::put('REQ', $request->all());
        if(Session::has('SP')){
            Session::forget('SP');
        }
        return \Redirect::route('sujetopasivo');
    }
    /*
    | Fin Requisitos
    */
    /*
    | Tasas
    */
    public function tramitetasas(Request $request)
    {
        if(Session::has('PAGO')){
            Session::forget('PAGO');
        }
        /* VALIDA SI REQUIERE PAGAR ALGUNA TASA */
        $tasas = 0;
        
        if( $tasas >0 ){
            $bancos = \App\Modelos\Configuracion\Bancos::all();
            return view('tramites.tasas')->with(['tasas'=>$tasas,'bancos'=>$bancos]); 
        }
        return \Redirect::route('resumen'); 
    }     
    /*
    | Sujeto Pasivo
    */  
    public function datosp(Request $request)
    {
        if($request->cedularcn){
            $busqueda = $request->cedularcn;
            if($request->search == 1){
              $propietario = \App\Modelos\Tributos\SujetoPasivo::IdAnterior($busqueda)->get()->toarray();   
          }else{
                $propietario = \App\Modelos\Tributos\SujetoPasivo::CedulaRcn($busqueda)->get()->toarray();           
          }
   
            if(count($propietario)){
                $var = $this->formatdata($propietario);
                Session::put('SP',$var);
            }else{
                Session::forget('SP');
                Session::flash('fail','Cedula no Encontrada');
            }
        
        }

        return view('tramites.propietario');    
    }   
    
    public function regsp(Request $request)
    {
        Session::put('SP',$request->all());
        if(Session::has('UBG')){
            Session::forget('UBG');
        }
        /* TASAS DE */
       //dd(Session::get('HI'));
        if(Session::get('HI') == 7){
            return \Redirect::route('tramitetasas');
        }
        $sectores = \App\Modelos\Configuracion\Sectores::all();
        Session::put('SEC',$sectores);
        return \Redirect::route('ubg');        
    } 
    /*
    | Fin Sujeto Pasivo
    */
    /*
    | Inicio Ubicacion Geografica Sujeto Pasivo
    */      
    public function ubg(Request $request)
    {
        if(Session::get('HI') == 7){
            return \Redirect::route('tramitetasas');
        }
        $sectores = \App\Modelos\Configuracion\Sectores::all();
        Session::put('SEC',$sectores);
        return view('tributos.ubg')->with(['sectores'=>$sectores]);       
    }
    /*
    | Fin Ubicacion Geografica Sujeto Pasivo
    */
    /*
    | Accion Hecho Imponible
    */
    public function tributo(Request $request)
    {
        Session::put('UBG',$request->all());
        switch (Session::get('HI')) {
            case 1:
                  if(Session::has('LAE')){
                    Session::forget('LAE');
                }
                $tipolae = \App\Modelos\Configuracion\TipoLicencias::all();
                return view('tributos.lae')->with(['tipolae'=>$tipolae]);
                break;
            case 2:
                return view('tramites.inmueble');
                break;                
            case 3:
                if(Session::has('CLAPUB')){
                    Session::forget('CLAPUB');
                }
                return \Redirect::route('pub');
                
                break;
            case 6:
                if(Session::has('INM')){
                    Session::forget('INM');
                }
                return view('tramites.inmueble');
                break;           
            default:
                # code...
                break;
        }
    }
    /*
    | Fin Accion Hecho Imponible
    */
     /*
    | Datos LAE
    */
    public function reglae(Request $request)
    {
        //dd($request->all());
        if(!Session::has('LAE')){
            Session::put('LAE',$request->all());
        }

         $tipoactividad = \App\Modelos\Configuracion\TipoActividades::where('idtipolicencia', 
            $request->idtipolicencia)->get();
        //dd($tipoactividad);
        return view('tributos.clalae')->with(['tipoactividad'=>$tipoactividad]);       
    }

    public function lae(Request $request)
    {
        //dd($request->all());
        if($request->idtipoactividad){
            $act = \App\Modelos\Configuracion\Tipoactividades::find($request->idtipoactividad);
            Session::flash('NEWCLA',$act);
            //dd(Session::get('NEWCLA'));
        }

         $tipoactividad = \App\Modelos\Configuracion\TipoActividades::where('idtipolicencia', 
            Session::get('LAE.idtipolicencia'))->get();
        
        return view('tributos.clalae')->with(['tipoactividad'=>$tipoactividad]);       
    }

    public function addclalae(Request $request)
    {
       if(!Session::has('CLALAE')){
            Session::put('CLALAE.CLA',[]);
       }
       Session::push('CLALAE.CLA',$request->all());

        return \Redirect::route('lae');

    }
    /*
    | Fin LAE
    */   
    /*
    | Datos Pubicidad
    */
    public function pub(Request $request)
    {
        if($request->id){
            $pub = \App\Modelos\Configuracion\ClasificadorPub::find($request->id);
            Session::flash('NEWCLA',$pub);
        }

        $var = Session::get('UBG');
        
        $tipopub = \App\Modelos\Configuracion\ClasificadorPub::all();
        return view('tributos.pub')->with(['tipopub'=>$tipopub]);       
    }
    public function addclapub(Request $request)
    {
       if(!Session::has('CLAPUB')){
            Session::put('CLAPUB.CLA',[]);
       }
       Session::push('CLAPUB.CLA',$request->all());

        return \Redirect::route('pub');

    }
    /*
    | Fin Pubblicidad
    */
    /*
    | Datos del Inmueble
    */
    public function datosinm(Request $request)
    {
        if($request->catastro){
            $busqueda = $request->catastro;
            $inmueble = \App\Modelos\Tributos\Inmuebles::Catastro($busqueda)->get()->toarray();   
            //dd($inmueble);

            if(count($inmueble)>0){
                $var = $this->formatdata($inmueble);
                 Session::put('INM',$var);  
               
                
            }else{
                Session::forget('INM');
                Session::flash('fail','Catastro no esta registrado');
                $usosuelo = \App\Modelos\Tributos\UsosSuelos::orderby('descripcion')->get();
                $usoinm   = \App\Modelos\Tributos\UsoInmuebles::all();
                //dd($usoinm);
                //$tipoinm   = \App\Modelos\Tributos\TipoInmuebles::all();
                $tipoff   = \App\Modelos\Configuracion\TipoFrecuenciaFacturas::all();
                $tarifads   = \App\Modelos\Configuracion\TarifasDS::all();
                Session::put('USOINM',$usoinm);
                Session::put('USOSUELO',$usosuelo);
                Session::put('TFF',$tipoff);
                Session::put('TARIFADS',$tarifads);
            }
        
        }
            
        return view('tramites.inmueble');                    
    }

    public function reginm(Request $request)
    {

        //SET NUEVO REGISTRO INMUEBLE 
        
        Session::put('INM',$request->all()); 
        $var = Session::get('TMT');
        //dd(Session::get('TMT'));
        if($var->idhechoimponible == 6){
            return \Redirect::route('resumen');   
        }
        
        return \Redirect::route('datosinm');    
                
    }
    /*
    | Fin Datos del Inmueble
    */
    public function validarequisitos($id){

		$requisitos = TipoTramites::find($id)
					->requisitos()
					->where('idstatus', 1)
					->get();
		return $requisitos;
    }

    public function resumen(Request $request)
    {
       // dd($request->all());
        if($request->idformapago){
            Session::put('PAGO',$request->all());
        }
        return view('tramites.resumen');
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

    public function registrotramite()
    {
        $tramite = Session::get('TMT');
        $isp = Session::get('SP');
        $idstatus = ($tramite['aprobacion'] == 1)? 5: 1;
        
        $inm = Session::get('INM');
        try{
            \DB::beginTransaction();
            /* Datos Sujeto Pasivo*/
            //$idsp = (!isset($isp['id']) ? $this->nuevosp($isp) : $isp['id'] ;
            if(!isset($isp['id'])){
                $idsp = $this->NuevoSP($isp);
                $id        = str_pad($idsp, 5, "0", STR_PAD_LEFT);
                $codsec    = \App\Modelos\Configuracion\Sectores::find(Session::get('UBG.idsector'));
                $codbar    = \App\Modelos\Configuracion\Barrios::find(Session::get('UBG.idbarrio'));
               
                $idcontrol =  $codsec->codcatastro.$codbar->codigo.$id."N";
                $act = \App\Modelos\Tributos\SujetoPasivo::find($idsp);
                $act->idanterior = $idcontrol;
                $act->save();                
            }else{ 
                $idsp = $isp['id'];
            }
            /* Pagos de tasas si lo Amerita*/
            if(Session::has('PAGO')){
                //echo 'aqui';
             
                $pago = Session::get('PAGO');
                //dd($pago);
                $idpago = $this->insertarpago($pago['idformapago'],$pago['total']);
                for ($i = 0; $i < count($pago['idtasa']); $i++){
                    $this->insertarpagotasa($idpago, $pago['idtasa'][$i], $pago['monto'][$i]);

                }

            }
            if(!isset($idpago)) $idpago = null;
            /* Insertar Tramite*/
            $idtramite = $this->NuevoTramite($tramite,$idsp,$idpago);
            /* Relacion Tramite Status*/

            $this->RelacionTramiteStatus($idtramite,$idstatus);
            /* Insertar Documentos Consignados si lo amerita*/
            if(Session::has('REQ')){
                $req = Session::get('REQ');
                $this->TramitesRequisitos($req,$idtramite);
            }            
            /* Tributos de ser Necesario*/
            if($tramite['generatributo'] == 1){
                /* Inserta Ubicacion Geografica */
                $idubg = $this->NuevaUBG();
                /* Inserta Inmueble */
                if($tramite['generainm'] == 1){
                    $inm = Session::get('INM');
                    /* Inserta Tributo */
                    $idtributo = $this->NuevoTributo($idubg,$idstatus,2,$inm['iniciocobro']);                    
                    /* Relacion SujetoPasivo - Tributo*/
                    $this->SujetoPasivoTributo($idtributo,$idsp);
                    /* Relacion Tramite - Tributo*/
                    $this->TramitesTributos($idtramite,$idtributo);

                    if(!isset($inm['id'])){
                        $idinm = $this->NuevoINM($idtributo);
                    }else{ 
                        $idinm = $inm['id'];
                    }
                }

                if($tramite['generads'] == 1){
                    /* Inserta Tributo */
                    $idtributo = $this->NuevoTributo($idubg,$idstatus,6,$inm['iniciocobro']);
                    /* Relacion SujetoPasivo - Tributo*/
                    $this->SujetoPasivoTributo($idtributo,$idsp);
                    /* Relacion Tramite - Tributo*/
                    $this->TramitesTributos($idtramite,$idtributo);
                    /* Inserta Contrato de Desechos Solidos */
                    $tarifa = $this->ContratoDS($idtributo,$idinm,$inm['iniciocobro']);
                    /* Inserta Movimiento Estado de Cuenta */
                    $montotarifa = \App\Modelos\Configuracion\TarifasDS::find($tarifa);
                    $fre = Session::get('INM');
                    if($fre['idtipofrecuencia'] == 4){
                        $periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','>',$inm['iniciocobro'])->where('fechafacturacion','<',date('Y-m-d'))->get()->toarray();
                        for($p=0; $p < count($periodos); $p++){
                        $descripcion = 'Servicio de Recoleccion Desechos Solidos '.$periodos[$p]['descripcion'];
                        $this->MovimientoEdoCta($idstatus,1,$idtributo,$periodos[$p]['fechafacturacion'],$montotarifa['tarifa'],$descripcion);   
                        }
                       
                        $fecha = \App\Modelos\Configuracion\PeriodosMensuales::find($idperiodomensual);
                        $contrato = \App\Modelos\Tributos\ContratosDS::where('idinm',$idinm)->get();
                        //dd($contrato);
                        $inmueble = \App\Modelos\Tributos\Inmuebles::find($idinm);
                        $ubg = \App\Modelos\Tributos\UbicacionesGeograficas::find($idubg);
                        $idsp = \App\Modelos\Tributos\Tributos::find($idtributo)->sp()->get();
                        $idfacturads = $this->facturasds($idperiodomensual,$idtributo,1,null,$ubg,$idsp);

                        $saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($idtributo)
                                        ->where('fecha','<',$fecha['hasta'])
                                        ->where('montoremanente','>',0)
                                        ->sum('montoremanente');
                        $this->detallefacturads($idfacturads,$saldoanterior,$contrato);
                    }

                    
                }

                if($tramite['generapub'] == 1){
                    /* Inserta Tributo */
                    $idtributo = $this->NuevoTributo($idubg,$idstatus,3,date('Y-m-d'));
                    /* Relacion SujetoPasivo - Tributo*/
                    $this->SujetoPasivoTributo($idtributo,$idsp);
                    /* Relacion Tramite - Tributo*/
                    $this->TramitesTributos($idtramite,$idtributo);
                    /* Inserta Permiso de Publicidad*/
                    $idpermiso = $this->PermisoPublicidad($idtributo);
                    $ubg = \App\Modelos\Tributos\UbicacionesGeograficas::find($idubg);
                    $idsp = \App\Modelos\Tributos\Tributos::find($idtributo)->sp()->get();
                    $idfacturads = $this->facturasds(null,null,$idtributo,5,null,$ubg,$idsp);
                    foreach (Session::get('CLAPUB.CLA') as $pub){
                        if($pub['medida'] == 1){
                          $cambiomedida =  $pub['basecal'];
                        }else{
                           $cambiomedida = $pub['basecal'] * 0.3048 ;
                        }
                        if($pub['fraccion'] == 1){
                          $basecal =  ceil($cambiomedida);
                        }else{
                           $basecal = $cambiomedida;
                        }
                        $monto = $basecal * $pub['monto'];
                        if(!is_null($pub['minimo'])){
                            if($monto < $pub['minimo']){
                                $monto = $pub['minimo'];
                            }
                        }
                        $descripcion = $pub['descripcion'].' - '.$basecal.' Metros Cuadrados';
                        $this->PermisoClasificador($idpermiso,$pub['id'],$basecal);
                        $this->MovimientoEdoCta($idstatus,3,$idtributo,date('Y-m-d'),$monto,$descripcion);
                        $this->detallefacturads($idfacturads,$descripcion,0,$monto);
                    }
                }                
                 if($tramite['generalae'] == 1){
                    /* Inserta Tributo */
                    $idtributo = $this->NuevoTributo($idubg,$idstatus,1,Session::get('LAE.iniciocobro'));
                    /* Relacion SujetoPasivo - Tributo*/
                    $this->SujetoPasivoTributo($idtributo,$idsp);
                    /* Relacion Tramite - Tributo*/
                    $this->TramitesTributos($idtramite,$idtributo);
                    /* Inserta Permiso de Publicidad*/
                    $idlicencia = $this->licencia($idtributo);
                    //dd(Session::get('CLALAE.CLA'));
                    
                    foreach (Session::get('CLALAE.CLA') as $clalae){
                        if(in_array($clalae['id'], array(1, 2, 3,4,5,6,7,8,9))){
                        //Bucar clasificador
                            $cla = \App\Modelos\Configuracion\ClasificadorMercados::where('idtipoactividad',$clalae['id'])
                                    ->where('idzonamercado',$clalae['idzonamercado'])
                                    ->get()
                                    ->toarray();
                            //dd($cla);
                            $metros = ($clalae['metros']/2);
                            if($metros < 1 ){
                                $metros =2;
                            }
                            $monto = floor($metros) * $clalae['basecal']* $cla[0]['monto'];
                        }   

                        $descripcion = $clalae['actividad'].'-'.$clalae['basecal'];
                        $this->LicenciaClasificador($idlicencia,$clalae['id'],$clalae['metros'],$clalae['basecal']);
                        $this->MovimientoEdoCta($idstatus,4,$idtributo,date('Y-m-d'),$monto,$descripcion);
                    }
                }            
            }
           //\DB::rollback();
            \DB::commit();
            Session::forget('ST');                       
            Session::forget('REQ');
            Session::forget('SP');
            Session::forget('INM');
            Session::forget('CLAPUB');
            Session::forget('CLALAE');
            Session::forget('PAGO');
            Session::forget('TMT');
            Session::forget('USOINM');
            Session::forget('TFF');
            Session::forget('SEC');
            Session::forget('HI');
            Session::forget('ID');
            Session::flash('transaccion','El registro del tramite ha sido exitoso');
            return \Redirect::route('aprobaciontramites');

        }
        catch(\Exception $ex)
        {
            Session::flash('transaccion','hubo un problema en el registro del tramite, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('aprobaciontramites');
        }
    }
    public function facturasds($idperiodoinicial,$idperiodomensual,$idtributo,$tipofactura,$inmueble,$ubg,$idsp)
    {
        $data = new \App\Modelos\Facturacion\Facturas;
        $data->idsession        =\Session::getId();     
        $data->idtributo        = $idtributo;
        $data->idperiodomensual = $idperiodomensual;
        $data->idtipofactura    = $tipofactura;        
        $data->idbarrio         = $ubg['idbarrio'];
        $data->idsector         = $ubg['idsector'];
        $data->direccion        = $ubg['direccion'];
        $data->sujetopasivo     = $idsp[0]['nombre_razonsocial'];
        $data->save();
        return $data->id;
    }

    public function detallefacturads($idfacturads,$concepto,$saldoanterior,$monto)
    {
        $data = new \App\Modelos\Facturacion\DetalleFactura;
        $data->idfactura   = $idfacturads;
        $data->concepto    = $concepto;
        $data->saldo       = $saldoanterior;
        $data->monto      = $monto;
        $data->save();
        return;
    }
    public function insertarpago($idformapago,$monto)
    {
        $idpago = new \App\Modelos\Taquilla\Pagos;
        $idpago->idsession = \Session::getId();
        $idpago->idstatus = 1;
        $idpago->idtipopago = 2;
        $idpago->idformapago = $idformapago;
        $idpago->fechapago = date('Y-m-d');
        $idpago->monto = $monto;
        $idpago->save();
        return $idpago->id;
    }

    public function insertarpagotasa($idpago,$idtasa,$monto)
    {
        $pago = new \App\Modelos\Taquilla\PagosTasas;
        $pago->idpago = $idpago;
        $pago->idtasa = $idtasa;
        $pago->monto = $monto;
        $pago->save();
        return;
    }
    public function NuevoSP($sp){
            
        $guardar = new SujetoPasivo;
        $guardar->idsession                      = Session::getId();
        $guardar->idstatus                       = 1;
        $guardar->idtiposujetopasivo             = 1;
        $guardar->cedula_rcn                     = $sp['cedula_rcn'];
        $guardar->nombre_razonsocial             = $sp['nombre_razonsocial'];
        $guardar->apellido_denominacioncomercial = $sp['apellido_denominacioncomercial'];
        $guardar->fechanacimiento_fundada        = $sp['fechanacimiento_fundada'];
        $guardar->direccion                      = $sp['direccion'];  
        $guardar->telefonoprincipal              = $sp['telefonoprincipal'];
        $guardar->telefonosecundario             = $sp['telefonosecundario'];
        $guardar->email                          = $sp['email'];
        $guardar->fechadeingreso                 = date('Y-m-d');
        $guardar->save();
        return $guardar->id;     
    }
    
    public function PagoTasas($data)
    {
        $pagos = new Pagos;
        $pagos->save();
        $pagostasas = new PagosTasas;
        $pagostasas->save();
        return $pagos->id;     
    }

    public function NuevoTramite($idtipotramite,$idsp,$idpago=null)
    {
        $st = Session::get('ST');

        $tramt = new \App\Modelos\Tramites\Tramites;
        $tramt->idsession = Session::getId();

        $tramt->idsujetopasivo = $idsp;
        $tramt->idtipotramite = $idtipotramite['id'];
        $tramt->idpago = $idpago;
        $tramt->solicitante = $st['nombre'];
        $cedula =$st['cedula1'].$st['cedula2'].$st['cedula3'];
        $tramt->cedula = $cedula;
        $tramt->telefono = $st['telefono'];
        $tramt->fechasolicitud =  date('Y-m-d');
        $tramt->save();        
        return $tramt->id;     
    }

    public function RelacionTramiteStatus($idtramite,$idstatus)
    {
        $relacion = new \App\Modelos\Tramites\Tramites_Status;
        $relacion->idtramite  = $idtramite;
        $relacion->idstatus  = $idstatus;
        $relacion->idsession = Session::getId();
        $relacion->save(); 
        return;
    }

    public function TramitesRequisitos($documentos,$idtramite)
    {
        
       //dd($documentos['requisito']);
        for ($i = 0; $i < count($documentos['idrequisito']); $i++){
            $doc = new \App\Modelos\Tramites\TramitesRequisitos;
            $doc->idtramite   = $idtramite;
            $doc->idrequisito = $documentos['idrequisito'][$i];
            $doc->save();  
        }
        return;     
    }

    public function NuevaUBG()
    {
        $var = Session::get('UBG');
        $idubg = new \App\Modelos\Tributos\UbicacionesGeograficas;
        $idubg->idsector  = $var['idsector'];
        $idubg->idbarrio  = $var['idbarrio'];
        $idubg->direccion = $var['direccion'];
        $idubg->save();        
        return $idubg->id;     
    }  

    public function NuevoTributo($idubg,$idstatus,$hip,$iniciocobro)
    {
        $tributo = new \App\Modelos\Tributos\Tributos;
        $tributo->idsession = Session::getId();
        $tributo->idstatus  = $idstatus;
        $tributo->idhechoimponible = $hip;
        $tributo->idubicaciongeografica = $idubg;
        $tributo->fechainicial = $iniciocobro;
        $tributo->nuevotributo = 1;
        $tributo->save();        
        return $tributo->id;     
    }  
    
    public function SujetoPasivoTributo($idtributo,$idsp,$representantelegal = 0)
    {
        $spt = new \App\Modelos\Tributos\SujetoPasivo_Tributo;
        $spt->idsujetopasivo = $idsp;
        $spt->idtributo = $idtributo;
        $spt->idsession = Session::getId();
        $spt->responsable = 1;
        $spt->representantelegal = $representantelegal;
        $spt->propietario = 1;
        $spt->save();        
        return; 
    }
    
    public function TramitesTributos($idtramite,$idtributo)
    {
        $tt = new \App\Modelos\Tramites\Tramites_Tributos;
        $tt->idtramite = $idtramite;
        $tt->idtributo = $idtributo;
        $tt->save();        
        return; 
    }

    public function NuevoINM($idtributo)
    {
        $var = Session::get('INM');
        $idinm = new \App\Modelos\Tributos\Inmuebles;
        $idinm->idtributo          = $idtributo;
        $idinm->idusoinm           = $var['idusoinm'];
        $idinm->idtipoinm          = $var['idtipoinm'];
        $idinm->idusosuelo         = $var['idusosuelo'];
        $idinm->catastro           = $var['catastro'];
        $idinm->areaterreno        = $var['areaterreno'];
        $idinm->areacontruccion    = $var['areacontruccion'];        
        $idinm->fechadeadquisicion = $var['fechadeadquisicion'];
        $idinm->numerohabitantes   = $var['numerohabitantes'];
        $idinm->valorinmueble      = $var['valorinmueble'];
        $idinm->linderonorte       = $var['linderonorte'];
        $idinm->linderosur         = $var['linderosur'];
        $idinm->linderooeste       = $var['linderooeste'];
        $idinm->linderoeste       = $var['linderoeste'];                 
        $idinm->save();        
        return $idinm->id;     
    } 

    public function ContratoDS($idtributo,$idinm,$iniciocobro)
    {
        $var = Session::get('INM');

        
        $contrato = new \App\Modelos\Tributos\ContratosDS;
        $contrato->idtributo         = $idtributo;
        $contrato->idinm             = $idinm;
        $contrato->categoria         = $var['categoria'];
        $contrato->idtarifa          = $var['idtarifa'];
        $contrato->idtipofrecuencia  = $var['idtipofrecuencia'];
        $contrato->iniciocobro       = $iniciocobro;
        $contrato->save();
        return $var['idtarifa'];
        
  
    }
    public function PermisoPublicidad($idtributo)
    {
        
        $pub = new \App\Modelos\Tributos\PermisoPublicidad;
        $pub->idtributo          = $idtributo;
        $pub->idsession = Session::getId();
        $pub->fecharecepcion = date('Y-m-d');
        $pub->fechaemision = null;
        $pub->fechadesde= date('Y-m-d');
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime ( '+1 year' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        $pub->fechahasta = $nuevafecha;
        $pub->observacion = '';              
        $pub->save();        
        return $pub->id;     
    } 

    public function PermisoClasificador($idpermiso,$idclasificadorpub,$basecal)
    {
        
        $pubcla = new \App\Modelos\Tributos\PermisoPubClasificador;
        $pubcla->idpermiso = $idpermiso;
        $pubcla->idclasificadorpub = $idclasificadorpub;
        $pubcla->basecal = $basecal;
        $pubcla->save();        
        return;     
    }

    public function licencia($idtributo)
    {
        
        $lic = new \App\Modelos\Tributos\Licencias;
        $lic->idsession = Session::getId();
        $lic->idtributo = $idtributo;
        $lic->idtipolicencia = Session::get('LAE.idtipolicencia');
        $lic->observaciones =  Session::get('LAE.observaciones');
        $lic->save();        
        return $lic->id;     
    }

    public function LicenciaClasificador($idlicencia,$idclasificadorlae,$metros,$basecal)
    {
        
        $licla = new \App\Modelos\Tributos\LicenciaClasificador;
        $licla->idlicencia = $idlicencia;
        $licla->idclasificadorlae = $idclasificadorlae;
        $licla->metros = $metros;
        $licla->basecal = $basecal;
        $licla->save();        
        return;     
    }
    public function MovimientoEdoCta($idstatus,$idtipomovedo,$idtributo,$fecha,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = $idstatus;
        $movedo->idsession = Session::getId();
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
