<?php

namespace App\Http\Controllers\Tributos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Tributos\TipoInmuebles;

class TipoInmueblesController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function buscartipoinm(Request $request)
    {
        
        $data = TipoInmuebles::where('idusoinmueble',$request->id)->get()->toarray();
        //$data = $data->toarray();
        return response()->json($data);//then sent this data to ajax success

    }
}
