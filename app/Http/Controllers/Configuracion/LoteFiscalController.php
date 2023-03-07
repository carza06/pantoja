<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoteFiscalController extends Controller
{
	

	public function index()
	{
		 $lotes = \App\Modelos\Configuracion\LoteFiscal::all();
		 $tipolote =\App\Modelos\Configuracion\TipoLote::all();
		 return view('configuracion.lotefiscal')->with(['lotes'=>$lotes,'tipolote' => $tipolote]);
	}

	public function store(Request $request)
	{
		try{
			\DB::beginTransaction();
			$longitud = strlen($request->hasta);
			$loteinicial = $request->base.str_pad($request->desde, $longitud, "0", STR_PAD_LEFT);
			$lotefinal = $request->base.$request->hasta;

			$lote = new \App\Modelos\Configuracion\LoteFiscal;
			$lote->idsession = \Session::getId();
			$lote->loteinicial = $loteinicial;
			$lote->lotefinal = $lotefinal;
			$lote->save();
			$idlote = $lote->id;
			for($i = $request->desde; $i <= $request->hasta; $i++)
			{
				$valorfiscal = new \App\Modelos\Configuracion\LoteValorFiscal;
				$valorfiscal->idlotefiscal = $idlote;
				$valorfiscal->idtipolote = $request->idtipolote;
				$valorfiscal->valorfiscal = $request->base.str_pad($i, $longitud, "0", STR_PAD_LEFT);
				$valorfiscal->asignado = 0;
				$valorfiscal->save();
			}
			\DB::commit();
		    \Session::flash('transaccion','Se registro el lote exitosamente');
	        return \Redirect::route('lotefiscal');
		}
		catch(\Exception $ex)
        {
            \Session::flash('transaccion','hubo un problema en el registro del del ote fiscal, comunique de inmediato al departamento de sistema');
            \DB::rollback();
            return \Redirect::route('lotefiscal');			
		}
	}
}
