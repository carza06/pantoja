<?php

namespace App\Http\Controllers\Taquilla;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagosDiversosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }	

	public function index(Request $request)
    {
		$search = null;
        \Session::forget('SP');	
		\Session::forget('transaccion');
		if($request->search == 2){
            $search = 1;
            $busqueda = \App\Modelos\Tributos\SujetoPasivo::CedulaRcn($request->cedularcn)->get()->toarray();
			if(count($busqueda) > 0){
				$sp = $this->formatdata($busqueda);				
				\Session::put('SP',$sp);	
			}else{
				\Session::put('transaccion','No existe el contribuyente, proceda a llenar los datos');
			} 			
		}elseif($request->search == 1){
            $search = 1;
			$busqueda = \App\Modelos\Tributos\SujetoPasivo::IdAnterior($request->cedularcn)->get()->toarray();
			if(count($busqueda) > 0){
				$sp = $this->formatdata($busqueda);				
				\Session::put('SP',$sp);	
			}else{
				\Session::put('transaccion','No existe el contribuyente, proceda a llenar los datos');
			} 				
		}
				
    	
 		return view('taquilla.pagosdiversos')->with(['busqueda'=>$search]);   	
    }

    public function selecciontasa(Request $request)
    {
       $tasas = \App\Modelos\Configuracion\Tasas::where('idstatus',1)->get();
       return view('taquilla.tasas')->with(['tasas'=>$tasas]);  
    }

    public function pagotasa(Request $request)
    {
       $bancos = \App\Modelos\Configuracion\Bancos::all();
       $tasas = \App\Modelos\Configuracion\Tasas::find($request->id);
       return view('taquilla.pagotasa')->with(['tasas'=>$tasas,'bancos'=>$bancos]);  
    }

    public function guardartasa(Request $request)
    {
        $isp = \Session::get('SP');
        try{
            \DB::beginTransaction();
            if(!isset($isp['id'])){
            	$idsp = $this->NuevoSP($isp);
            	$id        = str_pad($idsp, 6, "0", STR_PAD_LEFT);
				$idcontrol = date('Ymd').$id."T";
				$act = \App\Modelos\Tributos\SujetoPasivo::find($idsp);
				$act->idanterior = $idcontrol;
				$act->save();
            }else{ 
            	$idsp = $isp['id'];
            }
            $pago = $request->all();
            //dd($pago);
            $idpago = $this->insertarpago($pago['idformapago'],$pago['monto']);
            $this->insertarpagotasa($idpago, $pago['idtasa'], $pago['monto']);
 			switch ($pago['idformapago']) {
				case '1':
					# efectivo
					break;
				case '2':
					# tarjeta
					break;
				case '3':					
					$this->insertarcheque($idpago,$pago['idbanco'],$pago['nrocheque'],$pago['nrocuenta'],$pago['titular']);
					break;				
				case '4':
					# transferencia
                    $this->insertartransferencia($idpago,$pago['nrotransferencia']);
					break;				
				default:
					# code...
					break;
			}           
            $idtramite = $this->NuevoTramite($idsp,$idpago);
             $this->RelacionTramiteStatus($idtramite,1);
             //\DB::rollback();
             \DB::commit();
            \Session::flash('operacion','Se registro el pago, exitosamente');
             return \Redirect::route('pagosdiversos');
        }
        catch(\Exception $ex)
        {
            \Session::flash('operacion','hubo un problema en el registro del tramite, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('pagosdiversos');
        }
    }

    public function tasasujetopasivo(Request $request)
    {
    	\Session::put('SP',$request->all());
    	return \Redirect::route('selecciontasa');
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
    public function NuevoSP($sp){
            
        $guardar = new \App\Modelos\Tributos\SujetoPasivo;
        $guardar->idsession                      = \Session::getId();
        $guardar->idstatus                      = 1;
        $guardar->idtiposujetopasivo             = $sp['tiposp'];
        $guardar->cedula_rcn                     = $sp['cedula_rcn'];
        $guardar->nombre_razonsocial             = $sp['nombre_razonsocial'];
        $guardar->telefonoprincipal              = $sp['telefonoprincipal'];
        $guardar->email                          = $sp['email'];
        $guardar->fechadeingreso                 = date('Y-m-d');
        $guardar->save();
        return $guardar->id;     
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

    public function insertartransferencia($idpago,$nrotransferencia)
    {
        $chq = new \App\Modelos\Taquilla\Transferencias;
        $chq->idpago = $idpago;
        $chq->nrotransferencia=$nrotransferencia;
        $chq->save();
        return; 
    }

	public function NuevoTramite($idsp,$idpago)
    {
        
        $tramt = new \App\Modelos\Tramites\Tramites;
        $tramt->idsession = \Session::getId();
        $tramt->idsujetopasivo = $idsp;
        $tramt->idtipotramite = 2;
        $tramt->idpago = $idpago;
        $tramt->fechasolicitud =  date('Y-m-d');
        $tramt->save();        
        return $tramt->id;     
    }

    public function RelacionTramiteStatus($idtramite,$idstatus)
    {
        $relacion = new \App\Modelos\Tramites\Tramites_Status;
        $relacion->idtramite  = $idtramite;
        $relacion->idstatus  = $idstatus;
        $relacion->idsession = \Session::getId();
        $relacion->save(); 
        return;
    }
}
