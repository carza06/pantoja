<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class CuentasUsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	
    	if($request->idperfil && $request->idperfil!=0){
    		$usuarios = User::where('idperfil',$request->idperfil)->where('idstatus',1)->paginate(20);
    	}else{
    		$usuarios = User::where('idstatus',1)->paginate(20);
    	}
    	$perfiles = \App\Perfil::all();
    	$acciones = \App\Modelos\Main\Acciones::all();
    	return view('seguridad.cuentasusuarios')->with(['usuarios'=>$usuarios,'perfiles'=>$perfiles,'acciones'=>$acciones]);
    }

    public function store(Request $request)
    {
    	

    	$idaccion = $request->idaccion;
    	$nuevo = new User;
		$nuevo->idssesion =    \Session::getId();
		$nuevo->idstatus  =    1;
		$nuevo->idperfil  =    $request->idperfil; 
       
        if ($request->tipoavatar == "Masculino") {
           $nuevo->avatar = "hombre.png";
        } else {
            $nuevo->avatar = "mujer.png";
        }
        	 
		$nuevo->nombre	  =    $request->nombre	; 
		$nuevo->usuario	  =    $request->usuario;
		$nuevo->password  =    bcrypt($request->usuario);
		$nuevo->codigo	  =    $request->codigo; 
		$nuevo->email	  =    $request->email;    
	   	$nuevo->save();
	   	if(count($idaccion) > 0){	
		   	for ($x = 0; $x < count($idaccion); $x++){
	            $relacion = new \App\Modelos\Main\AccionesUsuarios;
	            $relacion->idusuario =$nuevo->id;
	            $relacion->idaccion = $idaccion[$x];
	            $relacion->save();   
	        }
	    }
	    \Session::flash('mensaje','Se ha creado el usuario exitosamente');
        return \Redirect::route('cuentasusuarios');
    }

    public function update(Request $request)
    {
    	$nuevo = User::find($request->id);
		$nuevo->idssesion =    \Session::getId();
		$nuevo->idstatus  =    $request->idstatus;
		$nuevo->idperfil  =    $request->idperfil; 
		$nuevo->avatar	  =    $request->avatar;	 
		$nuevo->nombre	  =    $request->nombre	; 
		$nuevo->usuario	  =    $request->usuario;
		$nuevo->cargo	  =    $request->cargo;	 
		$nuevo->codigo	  =    $request->codigo; 
		$nuevo->email	  =    $request->email;    
	   	$nuevo->save();	
    }

        public function password(Request $request)
    {
    	//dd($request->all());
    	$nuevo = User::find($request->id);
		$nuevo->password  = bcrypt($request->password);    
	   	$nuevo->save();
	   	return redirect()->back()->with('mensaje', 'Se actualizo la clave exitosamente!');	
    }
}
