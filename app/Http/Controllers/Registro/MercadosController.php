<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MercadosController extends Controller
{
	public function index(Request $request)
	{
		\Session::put('ID',$request->id);
		\Session::put('ARBITRIO','MERCADOS');
		\Session::put('GUARDAR','guardarmercados');
        return view('registroycontrol.mercados');
	}

    public function busquedaspmercados(Request $request)
    {
            $search = null;
      \Session::forget('SP');
            if($request->search == 2){
                $busqueda = \App\Modelos\Tributos\SujetoPasivo::CedulaRcn($request->cedularcn)->get()->toarray();
        $search = 1;
        \Session::put('search',$search);
            }else{
                $busqueda = \App\Modelos\Tributos\SujetoPasivo::IdAnterior($request->cedularcn)->get()->toarray();  
        $search = 1;
        \Session::put('search',$search);
            }
            if(count($busqueda) > 0){
                $sp = $this->formatdata($busqueda);             
                \Session::put('SP',$sp);    
            }else{
                \Session::put('fail','No existe el contribuyente, proceda a llenar los datos');
            }
      return \Redirect::route('registrarmercados');
    } 
    
    public function registrar()
    {
        $mercados = \App\Modelos\Configuracion\Mercados::all();
        return view('registroycontrol.mercados')->with(['mercados'=>$mercados]);
    }
    public function buscarmercadostarifa(Request $request)
    {
        
        $data = \App\Modelos\Configuracion\MercadosTarifas::where('idmercado',$request->id)->get();
        //$data = $data->toarray();
        return response()->json($data);//then sent this data to ajax success

    } 
	public function store(Request $request)
	{
		try{
			\DB::beginTransaction();
            $mercado = \App\Modelos\Configuracion\Mercados::find($request->idmercado);
			if(\Session::has('SP')){
				$idsp = \Session::get('SP.id');
			}else{
				$idsp = $this->NuevoSP($request->tiposp,
									   $request->cedula_rcn,
							   		   $request->nombre_razonsocial,
							   		   $request->telefonoprincipal,
							           $request->email);
				$id        = str_pad($idsp, 6, "0", STR_PAD_LEFT);
                $codsec    = \App\Modelos\Configuracion\Sectores::find($mercado->idsector);
                $codbar    = \App\Modelos\Configuracion\Barrios::find($mercado->idbarrio);
               
				$idcontrol = $codsec->codcatastro.$codbar->codigo.$id."N";
				$act = \App\Modelos\Tributos\SujetoPasivo::find($idsp);
				$act->idanterior = $idcontrol;
				$act->save();
			}
            # validar Contribuyente
            $validar = \App\Modelos\Tributos\ContribuyentesMercados::where('idmercado',$request->idmercado)->where('idsujetopasivo',$idsp)->get();
            if(count($validar) > 0){
                $idtributo = $validar[0]['idtributo'];
            }else{
                $ubicacion = \App\Modelos\Tributos\UbicacionesGeograficas::where('idsector',$mercado->idsector)->where('idbarrio',$mercado->idbarrio)->where('direccion',$mercado->direccion)->get();
                if(count($ubicacion) > 0){
                    $idubg = $ubicacion[0]['id'];    
                }else{
                   $idubg = $this->NuevaUBG($mercado->idsector,$mercado->idbarrio,$mercado->direccion);
                }
                $idtributo = $this->NuevoTributo($idubg,date('Y-m-d'));
                $this->SujetoPasivoTributo($idtributo,$idsp);
                $this->ContribuyenteMercados($idtributo,$idsp,$request->idmercado);
                    
            }
            $concepto = 'Impuesto por Mercados y Hospedaje';
            $this->MovimientoEdoCta($idtributo,date('Y-m-d'),4,$request->idtarifamercado,$concepto);   
         

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

    public function ContribuyenteMercados($idtributo,$idsp,$idmercado)
    {
        $data = new \App\Modelos\Tributos\ContribuyentesMercados;
        $data->idtributo = $idtributo;
        $data->idsujetopasivo = $idsp;
        $data->idmercado = $idmercado;
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

}
