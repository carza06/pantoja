<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Main\Modulos;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = \Auth::user();
        if($usuario->idperfil == 1 || $usuario->idperfil == 2 || $usuario->idperfil == 3 || $usuario->idperfil == 6){
            //$ufront = \App\User::where('idperfil',4)->where('idstatus',1)->get();
            $ufront = \App\User::where('idstatus',1)->get();
            $tributos = \App\Modelos\Main\HechoImponible::all();
            foreach ($tributos as $key => $value) {  
                if($value->nombrehechoimponible == 'Tasas'){
                    $recauda[$value->nombrehechoimponible] = \App\Modelos\Taquilla\PagosTasas::all()->sum('monto');
                }else{
                    $recauda[$value->nombrehechoimponible] = $value->Recaudacion()->where('p.idstatus',1)->sum('pt.monto');    
                }      
                
            }
            $mes = null;
            $estimado = null;
            $monto = null;
            $porcentaje = null;
            $anio = date('Y');
            $meta =  \App\Modelos\Configuracion\MetaEstimada::where('anio',$anio)->orderby('id')->get();
            foreach ($meta as $detalle) {
                $dia= date("d",(mktime(0,0,0,$detalle->mes1,1,$detalle->anio)-1));
                $desde = $detalle->anio.'-'.$detalle->mes.'-01';
                $hasta = $detalle->anio.'-'.$detalle->mes.'-'.$dia;
                $suma = \App\Modelos\Taquilla\Pagos::where('fechapago','>=',$desde)->where('fechapago','<=',$hasta)->where('p.status',1)->sum('pt.monto');
                $pje=($suma * 100)/$detalle->estimado;
                $estimado[] =number_format($detalle->estimado,2);
                $porcentaje[]= number_format($pje,2);
                $monto[]= number_format($suma,2);
                $mes[]= date("M", strtotime($desde));  
                
            }          
           
            return view('panel.gestion')->with(['ufront'=>$ufront,'recauda'=>$recauda,'mes'=>$mes,'estimado'=>$estimado,'monto'=>$monto,'porcentaje'=>$porcentaje]);
        }else{
            return view('core.main');   
        }
        
    }


}
