<?php

namespace App\Modelos\Tributos;

use Illuminate\Database\Eloquent\Model;
use App\Modelos\Facturacion\Facturas;

use DB;

class SujetoPasivo extends Model
{
    protected $table = 'sujetopasivo';
	
	protected $fillable = [
        'id',
        'idsession',
        'idtiposujetopasivo', 
        'nombre_razonsocial', 
        'apellido_denominacioncomercial', 
        'cedula_rcn',
        'fechanacimiento_fundada', 
        'direccion', 
        'telefonoprincipal',
        'telefonosecundario', 
        'email', 
        'fechadeingreso',
    ];
 

    public function scopeCedulaRcn($query,$var){
       
        $query->where('cedula_rcn', $var)->where('idstatus',1);
    } 

    public function scopeIdAnterior($query,$var){
       
        $query->where('idanterior', $var)->where('idstatus',1);
    }  

    public function scopeNombre($query,$var){
       
        $query->where('nombre_razonsocial','like', '%' .  $var .'%')->where('idstatus',1);
    } 

    public function tributos()
    {
        return $this->belongsToMany('App\Modelos\Tributos\Tributos','sujetopasivo_tributo','idsujetopasivo','idtributo')->withPivot('responsable','representantelegal','propietario');
    } 

    public function scopeComprobantesTasas($query,$id)
    {
    
        $query->select('p.id','fp.formapago','u.usuario','p.fechapago','pt.monto')
              ->join('tramites as tt','tt.idsujetopasivo','=','sujetopasivo.id')
              ->join('pagos as p','p.id','=','tt.idpago')
              ->join('pagostasas as pt','pt.idpago','=','p.id')
              ->join('formaspagos as fp','fp.id','=','p.idformapago')
              ->join('sessions as ss','ss.id','=','p.idsession')
              ->join('users as u','u.id','=','ss.user_id')
              ->where('p.idstatus','=',1)
              ->where('sujetopasivo.id','=',$id) ;        
        return $query;   
    }

    public function scopeDeudaMorosa($query,$hi,$inicio,$hasta,$sector)
    {
    if ($hi == 10){
    $query->select('a.id as numero de recibo pago', 'b.idtributo', 'a.talonario', 'sujetopasivo.nombre_razonsocial', 'h.sector', 'e.formapago', 'a.monto', 'a.fechapago') 
        ->join('sujetopasivo_tributo as st','st.idsujetopasivo','=','sujetopasivo.id')
        ->join('pagostributos as b', 'b.idtributo', '=', 'st.idtributo')
        ->join('pagos as a', 'a.id', '=', 'b.idpago')
        ->join('formaspagos as e', 'a.idformapago', '=', 'e.id')
        ->join('tributo as t','t.id','=','st.idtributo')
        ->join('ubicacionesgeograficas as g', 't.idubicaciongeografica', '=', 'g.id')
        ->join('sectores as h', 'g.idsector', '=', 'h.id')
        ->where('t.idstatus','=',1)
        ->where('sujetopasivo.idstatus','=',1)
        ->groupby('a.id')
        ->orderBy('a.fechapago','asc');
        if ($sector != null){
            $query->where('g.idsector', $sector);
        }
        if ($inicio != null && $hasta != null){
           $query->whereBetween('a.fechapago', [$inicio, $hasta]);
        }
     
    
    }else if ($hi == 9){
    $query->select('tributo.id AS idtributo', 'sujetopasivo.nombre_razonsocial', 'sectores.sector','barrios.barrio', 'ubicacionesgeograficas.direccion', 'tarifasds.tarifa', DB::raw('Sum(estadosdecuentas.montoremanente) as deuda'))
        ->join('sujetopasivo_tributo','sujetopasivo.id','=','sujetopasivo_tributo.idsujetopasivo')
        ->join('tributo','tributo.id','=','sujetopasivo_tributo.idtributo')
        ->join('ubicacionesgeograficas','ubicacionesgeograficas.id','=','tributo.idubicaciongeografica')
        ->join('sectores','sectores.id','=','ubicacionesgeograficas.idsector')
        ->join('barrios','barrios.id','=','ubicacionesgeograficas.idbarrio')
        ->join('estadosdecuentas','tributo.id','=','estadosdecuentas.idtributo')
        ->join('contratosds','tributo.id','=','contratosds.idtributo')
        ->join('tarifasds','tarifasds.id','=','contratosds.idtarifa')
        ->where('tributo.idstatus','=',1)
        ->where('estadosdecuentas.idstatus','=',1)
        ->groupby('tributo.id');
        if ($sector != null){
            $query->where('ubicacionesgeograficas.idsector', $sector);
        }
        if ($inicio != null && $hasta != null){
            $query->whereBetween('estadosdecuentas.fecha', [$inicio, $hasta]);
         }
    }else if ($hi == 12){
        
        $query= Facturas::select('facturas.idtributo','facturas.id','facturas.sujetopasivo','facturas.rnc','c.descripcion','facturas.usosuelo','f.tipofactura','b.valorfiscal', 'facturas.created_at as fecha_factura',DB::raw('Sum(e.saldo) as saldo'),DB::raw('Sum(e.monto) as monto'),DB::raw('Sum(e.saldo + e.monto) as total_factura'))
            ->join('lotevalorfiscal as b','facturas.idlotevalorfiscal','=','b.id')
            ->join('periodomensual as c','facturas.idperiodomensual','=','c.id')
            ->join('detallefactura as e','facturas.id','=','e.idfactura')
            ->join('tipofactura as f','facturas.idtipofactura','=','f.id');
            if ($inicio != null && $hasta != null){
                $query->whereBetween('b.updated_at', [$inicio, $hasta]);
             }
        }else if ($hi == 13){
            $query= Facturas::select('facturas.idtributo','facturas.id','facturas.sujetopasivo','facturas.rnc','facturas.idperiodomensual as descripcion','facturas.usosuelo','f.tipofactura','b.valorfiscal', 'facturas.created_at as fecha_factura',DB::raw('Sum(e.saldo) as saldo'),DB::raw('Sum(e.monto) as monto'),DB::raw('Sum(e.saldo + e.monto) as total_factura'))
                ->join('lotevalorfiscal as b','facturas.idlotevalorfiscal','=','b.id')
                ->join('detallefactura as e','facturas.id','=','e.idfactura')
                ->join('tipofactura as f','facturas.idtipofactura','=','f.id')
                ->where('facturas.idperiodomensual', null)
                ->groupby('facturas.id')
                ->orderBy('b.valorfiscal', 'ASC');
                if ($inicio != null && $hasta != null){
                    $query->whereBetween('b.updated_at', [$inicio, $hasta]);
                }
        }else{
            $query->select('sujetopasivo.nombre_razonsocial','t.id','s.sector','b.barrio','ubg.direccion',DB::raw('SUM(edo.montoremanente) as monto'))
              ->join('sujetopasivo_tributo as st','st.idsujetopasivo','=','sujetopasivo.id')
              ->join('tributo as t','t.id','=','st.idtributo')
              ->join('ubicacionesgeograficas as ubg','t.idubicaciongeografica','=','ubg.id')
              ->join('sectores as s','ubg.idsector','=','s.id')
              ->join('barrios as b','ubg.idbarrio','=','b.id')
              ->join('estadosdecuentas as edo','t.id','=','edo.idtributo')
              ->where('t.idhechoimponible','=',$hi)
              ->where('t.idstatus','=',1)
              ->where('edo.idstatus','=',1)
              ->where('edo.fecha','<',date('Y-m-d'))
              ->groupby('t.id')
              ->havingRaw('Sum(edo.montoremanente)> 0');  
              if ($sector != null){
                $query->where('ubg.idsector', $sector);
            } 
        }     
        return $query;
        
    }

    public function scopeComprobantesTributos($query,$id)
    {
    
        $query->select('p.id','fp.formapago','u.usuario','p.fechapago','p.monto')
              ->join('sujetopasivo_tributo as st','st.idsujetopasivo','=','sujetopasivo.id')
              ->join('tributo as t','t.id','=','st.idtributo')
              ->join('pagostributos as pt','pt.idtributo','=','t.id')
              ->join('pagos as p','p.id','=','pt.idpago')              
              ->join('formaspagos as fp','fp.id','=','p.idformapago')
              ->join('sessions as ss','ss.id','=','p.idsession')
              ->join('users as u','u.id','=','ss.user_id')
              ->where('sujetopasivo.id','=',$id)
              ->where('p.idstatus','=',1)
              ->groupby('p.id')->get() ;        
        return $query;
    }


}
