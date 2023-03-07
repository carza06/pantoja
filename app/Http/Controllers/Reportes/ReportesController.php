<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Configuracion\Sectores;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deudamorosa()
    {
    	$tributos = \App\Modelos\Main\HechoImponible::where('id','<>',7)->get();
    	//dd($tributos);
    	foreach ($tributos as $key => $value) {    		
    		$reporte[$value->nombrehechoimponible] = $value->Deuda()->sum('montoremanente');
    	}
    	return view('reportes.deuda')->with(['reporte' =>  $reporte]);
    }

    public function detalledeudamorosa(Request $request)
    {
        //$tributos = \App\Modelos\Main\HechoImponible::whereIn('id',[1,3,6,8,9,10,11])->get();
        $tributos = \App\Modelos\Main\HechoImponible::whereIn('id',[3,6,9,10,12,13])->get();
        //dd($tributos);
        if($request->idhi == 10){
            $name = 'CobroSectores';
        }else if ($request->idhi == 9){
            $name = 'ContribuyentesConDeuda';
        }else if ($request->idhi == 3){
            $name = 'Publicidad';
        }else if ($request->idhi == 12){
            $name = 'Valor fiscal desechos solidos';
        }else if ($request->idhi == 13){
            $name = 'Valor fiscal publicidad';
        }

        if($request->idhi){  

                $deuda = \App\Modelos\Tributos\SujetoPasivo::DeudaMorosa($request->idhi, $request->inicio, $request->hasta, $request->sector)->get();       
           
                //$orderItems = \App\OrderItem::select('name','price')->get();
                \Excel::create($name, function ($excel) use ($deuda) {
                    $excel->setTitle("Title");
                    $excel->sheet("Sheet 1", function ($sheet) use ($deuda) {
                        $sheet->fromArray($deuda);
                        //$sheet->row(1, array("name", "price"));
                    });
                })->download('xls');
                return back();
        }else{
            $sectors = Sectores::all();
            return view('reportes.detalledeudamorosa')->with(['hi' =>  $tributos, 'sectors'=>$sectors]);
        }
    }

    public function recaudacion()
    {
    	$tributos = \App\Modelos\Main\HechoImponible::all();
    	//dd($tributos);
    	foreach ($tributos as $key => $value) {
            if($value->nombrehechoimponible == 'Tasas'){
                $reporte[$value->nombrehechoimponible] = \App\Modelos\Taquilla\PagosTasas::Recaudacion()->sum('p.monto');
            } else{
                $reporte[$value->nombrehechoimponible] = $value->Recaudacion()->sum('pt.monto');
            }   		
    		  
    	}
    	return view('reportes.recaudacion')->with(['reporte' =>  $reporte]);
    }

    public function cuentas(Request $request)
    {
    	if($request->desde){
            $desde = $request->desde;
        }else{
            $desde = $this->desde();
        }

        if($request->hasta){
            $hasta = $request->hasta;
        }else{
            $hasta = $this->hasta();
        }

        $reporte = \App\Modelos\Main\Cuentas::where('habilitada',1)->get();
        if($request->imprimir){
            $view =  \View::make('pdf.cuentas')->with(['reporte' =>  $reporte,'desde'=>$desde,'hasta'=>$hasta])->render();
            return $view;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('micaja.pdf');
        }else{       
    	   return view('reportes.cuentas')->with(['reporte' =>  $reporte,'desde'=>$desde,'hasta'=>$hasta]);
        }
    }
    public  function hasta() { 
          $month = date('m');
          $year = date('Y');
          $day = date("d", mktime(0,0,0, $month+1, 0, $year));     
          return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
    }
     
      /** Actual month first day **/
    public  function desde() {
          $month = date('m');
          $year = date('Y');
          return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }

    public function pagos(Request $request)
    {
        if($request->fecha){
            $fecha = $request->fecha;
        }else{
            $fecha = date('Y-m-d');
        }
        $pagos = \App\Modelos\Taquilla\Pagos::where('fechapago',$fecha)->where('idstatus',1)->get();
        $efectivo      = null;
        $cheques       = null;
        $puntovt       = null;
        $transferencias = null;
        foreach ($pagos as $value) {
            $comprobante = str_pad($value->id, 6, "0", STR_PAD_LEFT);
            //echo $comprobante;
            if($value->idtipopago == 1){
                $tributo = \App\Modelos\Taquilla\PagosTributos::select('idtributo')->where('idpago',$value->id)->get();
                $id = 'Tri'.$tributo[0]['idtributo'];
                $hi = \App\Modelos\Tributos\Tributos::where('id',$tributo[0]['idtributo'])->get();
                $descripcion = $hi[0]->hi->nombrehechoimponible;
                $sp = \App\Modelos\Tributos\Tributos::find($tributo[0]['idtributo'])->sp()->get();
                //echo $sp[0]['nombre_razonsocial'];
                
            }else{
                $tramite  = \App\Modelos\Tramites\Tramites::where('idpago',$value->id)->get();
                //dd($tramite);
                $sp       = \App\Modelos\Tramites\Tramites::find($tramite[0]['id'])->sujetopasivo()->get();
                $id       = 'Tra'.$tramite[0]['id'];
                $pagotasa = \App\Modelos\Taquilla\PagosTasas::where('idpago',$value->id)->get();
                $tasa     = \App\Modelos\Taquilla\PagosTasas::find($pagotasa[0]['id'])->tasa()->get();
                //echo $sp[0]['nombre_razonsocial'];
                //echo 'Tasa:'.$tasa[0]['tasa'];
                //die;
                $descripcion = 'Tasa:'.$tasa[0]['tasa'];
            }
            switch ($value->idformapago) {
                case 1:
                    # Efectivo
                    $efectivo[] = array($comprobante,
                                        $id,
                                        $sp[0]['nombre_razonsocial'],
                                        $descripcion,
                                        $value->monto);
                    break;
                case 2:
                    # Puntos de Venta
                    break;
                case 3:
                    # Cheque
                    $cheque = \App\Modelos\Taquilla\Cheques::where('idpago',$value->id)->get();
                    //echo $cheque[0]->banco->banco;
                    //echo $cheque[0]['nrodecheque'];
                    $cheques[] = array($comprobante,
                                        $id,
                                        $sp[0]['nombre_razonsocial'],
                                        $descripcion,
                                        $cheque[0]->banco->banco,
                                        $cheque[0]['nrodecheque'],
                                        $value->monto);
                    break;
                case 4:
                    # Transferencia
                    $transferencia = \App\Modelos\Taquilla\Transferencias::where('idpago',$value->id)->get();
                    $transferencias[] = array($comprobante,
                                        $id,
                                        $sp[0]['nombre_razonsocial'],
                                        $descripcion,
                                        $transferencia[0]['nrotransferencia'],
                                        $value->monto);
                    break;                      
                default:
                    # code...
                    break;
            }
        }
        //dd($cheques);
        if($request->imprimir){
            $view =  \View::make('pdf.pagos')->with(['efectivo'=>$efectivo,'cheques'=>$cheques,'transferencias'=>$transferencias,'fecha'=>$fecha])->render();
            return $view;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('pagos.pdf');
        }else{
            return view('reportes.pagos')->with(['efectivo'=>$efectivo,'cheques'=>$cheques,'transferencias'=>$transferencias,'fecha'=>$fecha]);            
        }
    }
}
