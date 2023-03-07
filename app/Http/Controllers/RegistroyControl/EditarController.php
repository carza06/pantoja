<?php

namespace App\Http\Controllers\RegistroyControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditarController extends Controller
{
	public function contribuyente(Request $request)
	{
		$sp = \App\Modelos\Tributos\SujetoPasivo::find($request->idsp);
		return view('registroycontrol.formsp')->with(['sp'=>$sp]);
	}

	public function tributo(Request $request)
	{
		//$sp = \App\Modelos\Tributos\SujetoPasivo::find($request->idsp);
		$tributo = \App\Modelos\Tributos\Tributos::find($request->idtributo);
		$sectores = \App\Modelos\Configuracion\Sectores::all();
		$barrios = \App\Modelos\Configuracion\Barrios::all();
		
		$usoinmueble = \App\Modelos\Tributos\UsoInmuebles::all();
		$usosuelo = \App\Modelos\Tributos\UsosSuelos::all();
		if($tributo->idhechoimponible == 6){
			$tarifas = \App\Modelos\Configuracion\TarifasDS::all();
			$ds = \App\Modelos\Tributos\ContratosDS::where('idtributo',$request->idtributo)->get();
			$inmueble = \App\Modelos\Tributos\Inmuebles::where('id',$ds[0]['idinm'])->get();
			$tipoinm = \App\Modelos\Tributos\TipoInmuebles::where('idusoinmueble',$inmueble[0]['idusoinm'])->get();
			//dd($inmueble);
			return view('registroycontrol.editds')->with(['tributo'=>$tributo,'usoinmueble'=>$usoinmueble,'usosuelo'=>$usosuelo,'sectores'=>$sectores,'barrios'=>$barrios,'tarifas'=>$tarifas,'ds'=>$ds,'inmueble'=>$inmueble,'tipoinm'=>$tipoinm,]);	
		}
		
	}

	public function update(Request $request)
	{
		try{
			\DB::beginTransaction();
			$msj='';
			$sp = \App\Modelos\Tributos\SujetoPasivo::find($request->id);
			$pm = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',date('Y-m-d'))->orderby('fechafacturacion','desc')->limit(1)->get();
			if($sp->idtiposujetopasivo <> $request->tiposp){
				$this->historialsp($request->id,'idtiposujetopasivo',$sp->idtiposujetopasivo,$request->tiposp);
				$sp->idtiposujetopasivo = $request->tiposp;
			}
			if($sp->nombre_razonsocial <> $request->nombre_razonsocial){
				$this->historialsp($request->id,'nombre_razonsocial',$sp->nombre_razonsocial,$request->nombre_razonsocial);							
				$act = \App\Modelos\Facturacion\FacturasDS::where('sujetopasivo',$sp->nombre_razonsocial)->where('idperiodomensual',$pm[0]['id'])->update(['sujetopasivo'=>$request->nombre_razonsocial]);
				$sp->nombre_razonsocial = $request->nombre_razonsocial;
			}
			if($sp->apellido_denominacioncomercial <> $request->apellido_denominacioncomercial){
				$this->historialsp($request->id,'apellido_denominacioncomercial',$sp->apellido_denominacioncomercial,$request->apellido_denominacioncomercial);
				$sp->apellido_denominacioncomercial = $request->apellido_denominacioncomercial;	
			}
			if($sp->cedula_rcn <> $request->cedula_rcn){
				$this->historialsp($request->id,'cedula_rcn',$sp->cedula_rcn,$request->cedula_rcn);
				
				$act = \App\Modelos\Facturacion\FacturasDS::where('sujetopasivo',$sp->nombre_razonsocial)->where('idperiodomensual',$pm[0]['id'])->update(['rnc'=>$request->cedula_rcn]);
				$sp->cedula_rcn = $request->cedula_rcn;
			}
			if($sp->fechanacimiento_fundada <> $request->fechanacimiento_fundada){
				$this->historialsp($request->id,'fechanacimiento_fundada',$sp->fechanacimiento_fundada,$request->fechanacimiento_fundada);
				$sp->fechanacimiento_fundada = $request->fechanacimiento_fundada;				
			}
			if($sp->direccion <> $request->direccion){
				$this->historialsp($request->id,'direccion',$sp->direccion,$request->direccion);
				$sp->direccion = $request->direccion;				
			}		
			if($sp->telefonoprincipal <> $request->telefonoprincipal){
				$this->historialsp($request->id,'telefonoprincipal',$sp->telefonoprincipal,$request->telefonoprincipal);
				$sp->telefonoprincipal = $request->telefonoprincipal;				
			}
			if($sp->telefonosecundario <> $request->telefonosecundario){
				$this->historialsp($request->id,'telefonosecundario',$sp->telefonosecundario,$request->telefonosecundario);
				$sp->telefonosecundario = $request->telefonosecundario;				
			}
			if($sp->email <> $request->email){
				$this->historialsp($request->id,'email',$sp->email,$request->email);
				$sp->email = $request->email;				
			}
			if($sp->idstatus <> $request->idstatus){
				$inactivar = 'si';
				$this->historialsp($request->id,'idstatus',$sp->idstatus,$request->idstatus);
				$tributos = \App\Modelos\Tributos\SujetoPasivo::find($request->id)->tributos()->get();
				foreach ($tributos as $value) {
					$tb = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$value->id)->where('idtipomovimientoedo',2)->where('idstatus',1)->get();
					if($tb->count()> 0){
						$inactivar = 'no';	
					}
				}
				$pago = \App\Modelos\Tributos\SujetoPasivo::ComprobantesTasas($request->id)->get();
				if($pago->count() > 0){
					$inactivar = 'no';	
				}
				if($inactivar == 'si'){
					if($tributos->count() > 0){
						foreach ($tributos as $value) {
							$inactivartrb = \App\Modelos\Tributos\Tributos::find($value->id);
							$inactivartrb->idstatus = 2;
							$inactivartrb->save();
						}
					}
					$sp->idstatus = $request->idstatus;	
				}else{
					$msj = '. El contribuyente tiene pagos asociados, no se puede inactivar. VERIFIQUE';
				}
							
			}
			$sp->save();
			\DB::commit();
			\Session::flash('transaccion','Se ha actualizado el contribuyente'. $msj);
			 return \Redirect::route('editsp', array('idsp' => $request->id));
		}		
		catch(\Exception $ex)
		{
 			\Session::flash('transaccion','hubo un problema en la actualizacion del contribuyente, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('editsp', array('idsp' => $request->id));
		}
		
	}
	public function updatetrb(Request $request)
	{
		try{
			\DB::beginTransaction();
			$msj='';
			$tributo = \App\Modelos\Tributos\Tributos::find($request->id);
			$pm = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',date('Y-m-d'))->orderby('fechafacturacion','desc')->limit(1)->get();
			# Update Tributo
			if ($request->idstatus == 2 ){
				$tb = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->id)->where('idtipomovimientoedo',2)->where('idstatus',1)->get();
				if($tb->count()> 0){
					$msj = '. El tributo tiene pagos asociados, no se puede inactivar. VERIFIQUE';	
				}else{
					$this->historialtributo($request->id,'status',$tributo->idstatus,$request->idstatus);
					$tributo->idstatus = $request->idstatus;	
				}
			}

			if (date('Y-m-d',strtotime($tributo->fechainicial)) <> $request->iniciocobro ){
				$this->historialtributo($request->id,'fechainicial',$tributo->fechainicial,$request->iniciocobro);
				$tributo->fechainicial = $request->iniciocobro;
			}
			# Fin Update Tributo
			$tributo->save();
			# Update Ubicacion Geografica
			if($tributo->ubg->idsector <> $request->idsector){
				$this->historialtributo($request->id,'idsector',$tributo->ubg->idsector,$request->idsector);
				$actubg = \App\Modelos\Tributos\UbicacionesGeograficas::where('id',$tributo->idubicaciongeografica)->update(['idsector'=>$request->idsector]);
					
			}
			if($tributo->ubg->idbarrio <> $request->idbarrio){
				$this->historialtributo($request->id,'idbarrio',$tributo->ubg->idbarrio,$request->idbarrio);
				$actubg = \App\Modelos\Tributos\UbicacionesGeograficas::where('id',$tributo->idubicaciongeografica)->update(['idbarrio'=>$request->idbarrio]);
					
			}


			if($tributo->ubg->direccion <> $request->direccion){
				$this->historialtributo($request->id,'direccion',$tributo->ubg->direccion,$request->direccion);
				$actubg = \App\Modelos\Tributos\UbicacionesGeograficas::where('id',$tributo->idubicaciongeografica)->update(['direccion'=>$request->direccion]);					
			}
			# Fin Update Ubicacion Geografica

			# Update Contrato de Desecho Solidos
			$ds = \App\Modelos\Tributos\ContratosDS::where('idtributo',$request->id)->get();

			if($ds[0]['idtarifa'] <> $request->idtarifa){
				$monto = \App\Modelos\Configuracion\TarifasDS::find($request->idtarifa);
				$this->historialtributo($request->id,'idtarifa',$ds[0]['idtarifa'],$request->idtarifa);
				$actds = \App\Modelos\Tributos\ContratosDS::where('idtributo',$request->id)->update(['idtarifa'=>$request->idtarifa]);
				# Update Movimientos Estado de Cuenta
				$actds = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->id)->where('idtipomovimientoedo',1)->where('idstatus',1)->whereraw('monto = montoremanente')->update(['monto'=>$monto->tarifa,'montoremanente'=>$monto->tarifa]);
			}
			if($ds[0]['iniciocobro'] <> $request->iniciocobro){
				$actds = \App\Modelos\Tributos\ContratosDS::where('idtributo',$request->id)->update(['iniciocobro'=>$request->iniciocobro]);	
			}

			# Fin Update Contrato Desechos Solidos

			# Update Inmueble
			$actinm = \App\Modelos\Tributos\Inmuebles::where('id',$ds[0]['idinm'])->update(['idusoinm'=>$request->idusoinm,'idtipoinm'=>$request->idtipoinm,'idusosuelo'=>$request->idusosuelo]);
			# Fin Update Inmueble
			# Update Factura
			$idfactura = \App\Modelos\Facturacion\Facturas::where('idtributo',$request->id)->where('idperiodomensual',$pm[0]['id'])->get();
			if($idfactura->count() > 0){
				$actualizar = 0;
				$actfact = \App\Modelos\Facturacion\Facturas::find($idfactura[0]['id']);
				if($actfact->idsector <> $request->idsector){
					$actfact->idsector = $request->idsector;
					$actualizar = 1;
				}
				if($actfact->idbarrio <> $request->idbarrio){
					$actfact->idbarrio = $request->idbarrio;
					$actualizar = 1;
				}
				if($actfact->idvia <> $request->idvia){
					$actfact->idvia = $request->idvia;
					$actualizar = 1;
				}
				if($actfact->direccion <> $request->direccion){
					$actfact->direccion = $request->direccion;
					$actualizar = 1;
				}
				$usosuelo = \App\Modelos\Tributos\UsosSuelos::find($request->idusosuelo);
				if($actfact->codigouso <> intval($usosuelo ->codigo)){
					$this->historialtributo($request->id,'idusosuelo',$actfact->codigouso, $usosuelo->codigo);
					$actfact->codigouso = $usosuelo->codigo;
					$this->historialtributo($request->id,'idusosuelo',$actfact->usosuelo, $usosuelo->descripcion);
					$actfact->usosuelo = $usosuelo->descripcion;
					$actualizar = 1;
				}
				if($actualizar == 1){
					$actfact->save();	
				}				
				if($ds[0]['idtarifa'] <> $request->idtarifa){
					$saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($request->id)
															->where('fecha','<',$pm[0]['hasta'])
															->where('idstatus',1)
															->where('montoremanente','>',0)
															->sum('montoremanente');
					$df = \App\Modelos\Facturacion\DetalleFactura::where('idfacturads',$actfact->id)->update(['categoria'=>$monto->codigo,'saldoanterior'=>$saldoanterior,'montomes'=>$monto->tarifa]);					
				}				
			}

			\DB::commit();
			\Session::flash('transaccion','Se ha actualizado el Triburo'. $msj);
			 return \Redirect::route('estadodecuenta', array('idtributo' => $request->id));
		}		
		catch(Exception $ex)
		{
 			\Session::flash('transaccion','hubo un problema en la actualizacion del tributo, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('edittrb', array('idtributo' => $request->id));
		}
		
	}

	public function historialsp($idsp,$campo,$valoranterior,$valornuevo)
	{
		$h = new \App\Modelos\Seguridad\HistorialActualizacionSP;
		$h->idsession = \Session::getId();
		$h->idsujetopasivo = $idsp;		
		$h->campo = $campo;
		$h->valoranterior = $valoranterior;
		$h->valornuevo = $valornuevo;
		$h->save();
		return;
	}

	public function historialtributo($idtributo,$campo,$valoranterior,$valornuevo)
	{
		$h = new \App\Modelos\Seguridad\HistorialActualizacionTributo;
		$h->idsession = \Session::getId();
		$h->idtributo = $idtributo;		
		$h->campo = $campo;
		$h->valoranterior = $valoranterior;
		$h->valornuevo = $valornuevo;
		$h->save();
		return;
	}
}
