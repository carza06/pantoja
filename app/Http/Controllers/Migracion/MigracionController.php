<?php

namespace App\Http\Controllers\Migracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MigracionController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function resultados()
	{
		return view('seguridad.resultados');
	}

	public function index()
	{
		$sectores = \App\Modelos\Configuracion\Sectores::all();
		return view('seguridad.index')->with(['sectores'=>$sectores]);
	}

	public function migracion(Request $request)
	{
		
		/*Obtener los datos de la tabla sector*/
		switch ($request->idsector) {
			case 1:
				$data = \App\Modelos\Migracion\Sector01::where('migrado',0)->get();
				break;
			case 2:
				$data = \App\Modelos\Migracion\Sector02::where('migrado',0)->get();
				break;
			case 3:
				$data = \App\Modelos\Migracion\Sector03::where('migrado',0)->get();
				break;			
			case 4:
				$data = \App\Modelos\Migracion\Sector04::where('migrado',0)->get();
				break;
			case 5:
				$data = \App\Modelos\Migracion\Sector05::where('migrado',0)->get();
				break;
			case 6:
				$data = \App\Modelos\Migracion\Sector06::where('migrado',0)->get();
				break;
			case 7:
				$data = \App\Modelos\Migracion\Sector07::where('migrado',0)->get();
				break;
			case 8:
				$data = \App\Modelos\Migracion\Sector08::where('migrado',0)->get();
				break;
			case 9:
				$data = \App\Modelos\Migracion\Sector09::where('migrado',0)->get();
				break;
			case 10:
				$data = \App\Modelos\Migracion\Sector10::where('migrado',0)->get();
				break;	
			case 18:
				$data = \App\Modelos\Migracion\Sector18::where('migrado',0)->get();
				break;		
			default:
				\Session::flash('transaccion','No existen datos para realizar una migracion');
				return \Redirect::route('resultados');
				break;
		}
		
		//dd($data);
		if($data->count() > 0){
			$i = 0;
			$x = 0;
			foreach ($data as $valor) {
				$i++;
				$mes ='';
 				$anio =''; 			
				$ubicacion = explode(' ',$valor->sector);
				if($request->idsector == 3){
					$s = $ubicacion[0].' '.$ubicacion[1].' '.$ubicacion[2];
					$b = $ubicacion[3].' '.$ubicacion[4];					
					$d = $ubicacion[5].' '.$ubicacion[6];
				}elseif ($request->idsector == 5) {
					$s = 'LOS JARDINES DE PANTOJA';
					$b = $ubicacion[0].' '.$ubicacion[1].' '.$ubicacion[2];
					$d = $ubicacion[3].' '.$ubicacion[4];
				
				}else{
					$s = $ubicacion[0].' '.$ubicacion[1].' '.$ubicacion[2].' '.$ubicacion[3];
					$b = $ubicacion[4].' '.$ubicacion[5];
					$d = $ubicacion[6].' '.$ubicacion[7];
				}				
				

				$periodo = explode(' ',$valor->periodo);
				$mes = $this->mes(trim($periodo[1]));
 				$anio = trim($periodo[2]); 
 				$dia = '01';						
 				$fecha = $anio.'-'.$mes.'-'.'01';				
				try
	        	{
	            	if(checkdate($mes,$dia,$anio) ){
	            	\DB::beginTransaction();
					$sector = \App\Modelos\Configuracion\Sectores::where('sector',$s)->get();
					$barrio = \App\Modelos\Configuracion\Barrios::where('barrio',$b)->get();

            		$idsession = 'YMYYejx1Wp7jTfe534BTSqVCId79p8dVXuwKcgWQ';
	            	# Ubicacion Geografica
	            	$idubg = $this->ubg($sector[0]['id'],$barrio[0]['id'],$d);
	            	# Tributo inmueble
	            	$idtributo = $this->tributo($idsession,2,$idubg);
	            	# Sujeto Pasivo
	            	$idsp = $this->sujetopasivo($idsession,trim($valor->contribuyente));
	            	# Generar un idcontrol del sujeto pasivo
	            	$numero = str_pad($idsp, 5, "0", STR_PAD_LEFT);

	            	$idanterior = $sector[0]['codcatastro'].$barrio[0]['codigo'].$numero.'M';
	            	$updatesp = \App\Modelos\Tributos\SujetoPasivo::where('id',$idsp)->update(['idanterior'=>$idanterior]);
	             	# Sujeto Pasivo - Tributo
	             	$this->sujetopasivo_tributo($idsp,$idsession,$idtributo);
	            	# Inmuebles
            		$idinm = $this->inmuebles($idtributo,108,trim($idanterior));	            	
	            	# Desechos Solidos
	            	$idtributo = $this->tributo($idsession,6,$idubg);
	             	# Sujeto Pasivo - Tributo
	             	$this->sujetopasivo_tributo($idsp,$idsession,$idtributo);
	             	# Contrato Desechos Solidos
	             	$idtarifa = \App\Modelos\Configuracion\TarifasDS::where('tarifa',trim($valor->tarifa))->get()->toarray();
	             	
	             	$this->contratods($idtributo,$idinm,$idtarifa[0]['id'],'2018-02-01');
                    # Generar Estado de Cuenta
                    if($valor->saldo > 0){                    	
	                   	
			            $periodos = \App\Modelos\Configuracion\PeriodosMensuales::where('desde','>=',$fecha)->where('hasta','<=','2018-01-31')->get()->toarray();
			            $total = 0;
			            for($p=0; $p < count($periodos); $p++){
			                $edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$idtributo)->where('idstatus',1)->where('fecha',$periodos[$p]['fechafacturacion'])->where('idtipomovimientoedo',1)->get();
			                if($edo->count() < 1){
			                	$descripcion = 'Servicio de Recoleccion Desechos Solidos '.trim($periodos[$p]['descripcion']);
				                $this->MovimientoEdoCta(1,1,$idtributo,$periodos[$p]['fechafacturacion'],$valor->tarifa,$descripcion); 				            		                	
			                }
			            }
                    }else{
                    	$this->MovimientoEdoCta(1,1,$idtributo,'2018-02-01',trim($valor->tarifa),'Servicio de Recoleccion Desechos Solidos Enero 2018');	
                    }
                   	$this->migrado($request->idsector,$valor->id);
	             	\DB::commit();
	             	$x++;
	            	}else{
	            		//echo 'mes:'.$periodo[1].' - '.$fecha;
	            		//die;
	            		$error_migrado[] = $fecha;
	            	}				

	            }
		        catch(\Exception $ex)
		        {
		            \Session::flash('transaccion','hubo un problema en la migracion');
		            \DB::rollback();
		            
		        }
		        \Session::flash('transaccion','se migraron '. $x. ' contribuyentes del sector'.$s.' de: '.$i);
		        
			}
		}else{
			\Session::flash('transaccion','No existen datos para realizar una migracion');
		}

		return \Redirect::route('resultados');
	}

     public function mes($mes)
    {
		
		switch (trim($mes)) {
		    case 'ENERO':
		        $m = '01';
		        break;
		    case 'FEBRERO':
		        $m = '02';
		        break;
		    case 'MARZO':
		        $m = '03';
		        break;
		    case 'ABRIL':
		        $m = '04';
		        break;
		    case 'MAYO':
		        $m = '05';
		        break;
		    case 'JUNIO':
		        $m = '06';
		        break;
		    case 'JULIO':
		        $m = '07';
		        break;
		    case 'AGOSTO':
		        $m = '08';
		        break;
		    case 'SEPTIEMBRE':
		        $m = '09';
		        break;
		    case 'OCTUBRE':
		        $m = '10';
		        break;
		    case 'NOVIEMBRE':
		        $m = '11';
		        break;
		    case 'DICIEMBRE':
		        $m = '12';
		        break;
		    default:
       			$m = '99';
		}

		return $m;        
 	}

    public function MovimientoEdoCta($idstatus,$idtipomovedo,$idtributo,$fecha,$monto,$descripcion)
    {
        
        $movedo = new \App\Modelos\Tramites\EstadosCuentas;
        $movedo->idstatus = $idstatus;
        $movedo->idsession = 'uk1OmUHA8HiLQwSSwkxNLnjHJYMDB06dOqk8qs4J';
        $movedo->idtipomovimientoedo = $idtipomovedo;
        $movedo->idtributo = $idtributo;
        $movedo->fecha = $fecha;
        $movedo->descripcion = $descripcion;
        $movedo->monto = $monto;
        $movedo->montoremanente = $monto;
        $movedo->save();
        return;     
    } 
	public function migrado($idsector,$id)
	{
		
		switch ($idsector) {
			case 1:
				$registro = \App\Modelos\Migracion\Sector01::find($id);
				break;
			case 2:
				$registro = \App\Modelos\Migracion\Sector02::find($id);
				break;			
			case 3:
				$registro = \App\Modelos\Migracion\Sector03::find($id);
				break;
			case 4:
				$registro = \App\Modelos\Migracion\Sector04::find($id);
				break;
			case 5:
				$registro = \App\Modelos\Migracion\Sector05::find($id);
				break;
			case 6:
				$registro = \App\Modelos\Migracion\Sector06::find($id);
				break;
			case 7:
				$registro = \App\Modelos\Migracion\Sector07::find($id);
				break;
			case 8:
				$registro = \App\Modelos\Migracion\Sector08::find($id);
				break;
			case 9:
				$registro = \App\Modelos\Migracion\Sector09::find($id);
				break;
			case 10:
				$registro = \App\Modelos\Migracion\Sector10::find($id);
				break;	
		}
			$registro->migrado = 1;
			$registro->save();
			return;
	}

	public function ubg($idsector,$idbarrio,$direccion)
	{
		$valor = new \App\Modelos\Tributos\UbicacionesGeograficas;
		$valor->idsector = $idsector;
		$valor->idbarrio = $idbarrio;
		$valor->direccion = $direccion;
		$valor->save();
		return $valor->id;

	}

	public function sujetopasivo($idsession,$nombre)
	{
		$valor = new \App\Modelos\Tributos\SujetoPasivo;
		$valor->idsession = $idsession;
		$valor->idstatus = 1;
		$valor->idtiposujetopasivo = 1;
		$valor->idanterior = null;
		$valor->nombre_razonsocial = trim($nombre); 
		$valor->apellido_denominacioncomercial = null;
		$valor->cedula_rcn = null;
		$valor->fechanacimiento_fundada = null;
		$valor->direccion = null;
		$valor->telefonoprincipal = null;
		$valor->telefonosecundario = null;
		$valor->email = null;
		$valor->fechadeingreso = date('Y-m-d');
		$valor->save();
		return $valor->id;

	}

	public function tributo($idsession,$idhi,$idubg)
	{
		$valor = new \App\Modelos\Tributos\Tributos;
		$valor->idsession = $idsession;
		$valor->idstatus = 1;
		$valor->idhechoimponible = $idhi;
		$valor->idubicaciongeografica = $idubg;
		$valor->fechainicial = date('Y-m-d');
		$valor->nuevotributo = 0;
		$valor->save();
		return $valor->id;

	}

	public function sujetopasivo_tributo($idsp,$idsession,$idtributo)
	{
		$valor = new \App\Modelos\Tributos\SujetoPasivo_Tributo;
		$valor->idsujetopasivo = $idsp;
		$valor->idtributo = $idtributo;
		$valor->idsession = $idsession;
		$valor->responsable = 1;
		$valor->representantelegal = 0;
		$valor->propietario = 0;
		$valor->save();
		return;

	}


	public function inmuebles($idtributo,$idusosuelo,$catastro)
	{

		$valor = new \App\Modelos\Tributos\Inmuebles;
		$valor->idtributo = $idtributo;
		$valor->idusoinm  = null;      # Vivienda familiar - Comercial
		$valor->idtipoinm = null;	   # Sub clasificacion de vivienda
		$valor->idusosuelo = $idusosuelo;
		$valor->idmigracion = $catastro;  # Uso del suelo segun clasificacion del sistema alcaldia
		$valor->catastro = null;
		$valor->areaterreno = null;
		$valor->areacontruccion = null;
		$valor->fechadeadquisicion = null;
		$valor->numerohabitantes = null;
		$valor->valorinmueble = null;
		$valor->linderonorte = null;
		$valor->linderoeste = null;
		$valor->linderosur = null;
		$valor->linderooeste = null;
		$valor->save();
		return $valor->id;
	}

	public function contratods($idtributo,$idinm,$idtarifa,$fecha)
	{
	       $valor = new \App\Modelos\Tributos\ContratosDS;
	       $valor->idtributo = $idtributo;
	       $valor->idinm = $idinm;
	       $valor->idtarifa = $idtarifa;
	       $valor->idtipofrecuencia  = 4;
	       $valor->iniciocobro = $fecha;
	       $valor->save();
	       return;
	}
}
