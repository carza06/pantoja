<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelesController extends Controller
{
	public function index(Request $request)
	{
		\Session::put('ID',$request->id);
		\Session::put('ARBITRIO','HOTELES');
		\Session::put('GUARDAR','guardarhotel');
		$sectores = \App\Modelos\Configuracion\Sectores::all();
        return view('registroycontrol.registrar')->with(['sectores'=>$sectores]);
	}

	public function store(Request $request)
	{
		try{
			\DB::beginTransaction();
			$idubg     = $this->NuevaUBG($request->idsector,$request->idbarrio,$request->direccion);
			$idtributo = $this->NuevoTributo($idubg,$request->iniciocobro);
			$codsec    = \App\Modelos\Configuracion\Sectores::find($request->idsector);
			$codbar    = \App\Modelos\Configuracion\Barrios::find($request->idbarrio);
			
			if(\Session::has('SP')){
				$idsp = \Session::get('SP.id');
			}else{
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
			}
			$this->SujetoPasivoTributo($idtributo,$idsp);
			$tarifa = \App\Modelos\Configuracion\ClasificadorHoteles::where('desdehabitaciones','<=',$request->habitaciones)->where('hastahabitaciones','>=',$request->habitaciones)->get(); 
			//dd($tarifa);
			$this->Hotel($idtributo,$request->habitaciones);
            
            $periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','>',$request->iniciocobro)->where('fechafacturacion','<',date('Y-m-d'))->get()->toarray();
            for($p=0; $p < count($periodos); $p++){
	            if($request->habitaciones > 15 ){
	            	$descripcion = 'Impuesto Hotel habitaciones mas de: '.$tarifa[0]['desdehabitaciones'].' - '.$periodos[$p]['descripcion'];
	            }else{
	            	$descripcion = 'Impuesto Hotel habitaciones entre: '.$tarifa[0]['desdehabitaciones'].' y '.$tarifa[0]['hastahabitaciones'].' - '.$periodos[$p]['descripcion'];	
	            }
	            
	            $this->MovimientoEdoCta($idtributo,$periodos[$p]['fechafacturacion'],$tarifa[0]['monto'],$descripcion);   
            }
            //\DB::rollback();
            \DB::commit();
		    \Session::flash('edocuenta','El registro del arbitrio ha sido exitoso, ha sido redirigido al estado de cuentas');
	        return \Redirect::route('estadodecuenta',[$idtributo]);
	    }
		catch(\Exception $ex)
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

    public function Hotel($idtributo,$habitaciones)
    {
        $data = new \App\Modelos\Tributos\Hoteles;
        $data->idtributo = $idtributo;
        $data->idfrecuencia = 4;
        $data->habitaciones = $habitaciones;
        $data->save();        
      	return; 
    } 
    
    public function MovimientoEdoCta($idtributo,$fecha,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = 1;
        $movedo->idsession = \Session::getId();
        $movedo->idtipomovimientoedo = 6;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = $fecha;
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = $monto;
        $movedo->save();
        return;     
    } 
}
