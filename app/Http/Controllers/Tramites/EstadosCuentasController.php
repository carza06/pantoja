<?php

namespace App\Http\Controllers\Tramites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadosCuentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->idtributo){          
          $idtributo = $request->idtributo;
          \Session::put('IdTributo',$idtributo);
          list($sp,$ubg,$inm,$ds,$pub,$edo) = $this->infotributo($idtributo);
    
          $bancos = \App\Modelos\Configuracion\Bancos::all();
          $fecha = date('Y').'-'.date('m').'-01';
          $facturas = \App\Modelos\Facturacion\Facturas::where('idtributo',$idtributo)->where('created_at','<',$fecha)->orderby('created_at','desc')->get();
          
          if($request->imprimir){
            //$view =  \View::make('pdf.edocta')->with(['sp'=>$sp, 'ubg'=>$ubg,'inm'=>$inm,'ds'=>$ds,'pub'=>$pub,'edo'=>$edo,'idtributo'=>$idtributo])->render();
            return view('pdf.edocta')->with(['sp'=>$sp, 'ubg'=>$ubg,'inm'=>$inm,'ds'=>$ds,'pub'=>$pub,'edo'=>$edo,'idtributo'=>$idtributo])->render();
        
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $archivo = 'edocta'.$idtributo.'.pdf';
            return $pdf->download($archivo);
           
          }else{
            return view('tramites.edocuenta')->with(['sp'=>$sp, 'ubg'=>$ubg,'inm'=>$inm,'ds'=>$ds,'pub'=>$pub,'edo'=>$edo,'bancos'=>$bancos,'facturas'=>$facturas]);
          }
        }
        return view('tramites.edocuenta');
    }

    public function infotributo($idtributo)
    {
      $info = \App\Modelos\Tributos\Tributos::where('id',$idtributo)->where('idstatus',1)->get();
      $edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$idtributo)->where('idstatus',1)->orderby('fecha')->get();
      if($edo->count() == 0){
        \Session::flash('edocuenta','El tributo no posee estado de cuentas');
      }       
      foreach($info as $tributo){
      
        foreach($tributo->sp as $var){
          $sp['idanterior'] = $var->idanterior;
          $sp['nombre_razonsocial'] = $var->nombre_razonsocial;
          $sp['apellido_denominacioncomercial'] = $var->apellido_denominacioncomercial;
          $sp['cedula_rcn'] = $var->cedula_rcn;
          $sp['fechanacimiento_fundada'] = $var->fechanacimiento_fundada;
          $sp['direccion'] = $var->direccion;
          $sp['telefonoprincipal'] = $var->telefonoprincipal;
          $sp['telefonosecundario'] = $var->telefonosecundario;
          $sp['email'] = $var->email;
        }
        
        $datos = \App\Modelos\Tributos\UbicacionesGeograficas::where('id',$tributo->idubicaciongeografica)->get();
          foreach($datos as $var){
            $ubg['idsector'] = $var->sector->sector;
            $ubg['idbarrio'] = $var->barrio->barrio;
            $ubg['direccion'] = $var->direccion;

        }

        switch ($tributo->idhechoimponible) {
              case 6:
                      $datos = \App\Modelos\Tributos\ContratosDS::where('idtributo',$idtributo)->get();
                      foreach ($datos as $var) {
                        $ds['idtributo'] = $var->idtributo;
                        $ds['idinm'] = $var->idinm;
                        $ds['clasificador'] = 'clasificador: '.$var->clasificador->codigo;
                        $inm['idfrecuencia'] =$var->idfrecuencia;
                      }
                      $inm = null;
                      $pub = null;
                     return [$sp,$ubg,$inm,$ds,$pub,$edo];                    
              break;
              case 3:
                $inm = null;
                $ds = null;
                $datos = \App\Modelos\Tributos\PermisoPublicidad::where('idtributo',$idtributo)->get();
                foreach ($datos as $var) {
                  $pub['idtributo'] = $var->idtributo;
                  $pub['desde'] = $var->desde;
                  $pub['hasta'] = $var->hasta;                  
                }
                return [$sp,$ubg,$inm,$ds,$pub,$edo];
              case 1:
                $inm = null;
                $ds = null;
                $pub = null;
                return [$sp,$ubg,$inm,$ds,$pub,$edo];
              default:

              
              break;
         }
                
      }
    }
    public function seleccionaredo(Request $request)
    {
      if($request->idtributo){
          $sup = \App\Modelos\Tributos\Tributos::find($request->idtributo)->sp()->get()->toarray();
          $sp = $this->formatdata($sup);
          $edo = \App\Modelos\Tramites\EstadosCuentas::where('idtributo',$request->idtributo)->where('idstatus',1)->where('idtipomovimientoedo','<>',2)->whereRaw('montoremanente = monto')->orderby('fecha')->get();
          return view('registroycontrol.edocuenta')->with(['edo'=>$edo,'sp'=>$sp]);
      }
      return view('registroycontrol.edocuenta');
      
    }
    public function anularmovedo(Request $request)
    {
      //dd($request->all());
      try{
        \DB::beginTransaction();
        $movedo = \App\Modelos\Tramites\EstadosCuentas::find($request->id);
        $movedo->idstatus = 2;
        $movedo->save();
        $pm = \App\Modelos\Configuracion\PeriodosMensuales::where('fechafacturacion','<=',date('Y-m-d'))->limit(1)->orderby('fechafacturacion','desc')->get();
        $saldoanterior = \App\Modelos\Tramites\EstadosCuentas::Total($movedo->idtributo)
                              ->where('fecha','<',$pm[0]['hasta'])
                              ->where('idstatus',1)
                              ->where('montoremanente','>',0)
                              ->sum('montoremanente');

        $factura = \App\Modelos\Facturacion\Facturas::where('idtributo',$movedo->idtributo)->where('idperiodomensual',$pm[0]['id'])->get();
        if($factura->count() > 0){
          $df = \App\Modelos\Facturacion\DetalleFactura::where('idfactura',$factura[0]['id'])->update(['saldo'=>$saldoanterior]);
        }
        $h = new \App\Modelos\Seguridad\HistorialAnulacionMovEdo;
        $h->idsession = \Session::getId();
        $h->idmovedo = $request->id;
        $h->motivo = $request->descripcion;
        $h->save();
        \DB::commit();
        \Session::flash('busqueda','Se anulo movimiento del estado de cuenta exitosamente');
      }
      catch(\Exection $e)
      {
          \DB::rollback();
          \Session::flash('busqueda','comuniquese con el administrador del sitema, no se pudo anular el movimiento');
      }


      return \Redirect::route('seleccionaredo',array('idtributo' => $movedo->idtributo));           
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
}