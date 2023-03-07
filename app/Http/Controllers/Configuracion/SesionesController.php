<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class SesionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$sesiones = \App\Modelos\Main\Session::orderby('last_activity','desc')->get();
        return view('configuracion.session')->with(['sesiones' => $sesiones]);
    }
}
