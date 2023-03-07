@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
$tramite = Session::get('TMT');
$sp = Session::get('SP');
$req = Session::get('REQ');
$st = Session::get('ST');
$ubg = Session::get('UBG');
$inm = Session::get('INM');
//dd($inm);
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		

		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Resumen del Tramite
					</h6>
				</div>
				<div class="panel-body">
				@if(Session::has('ST'))
					@include('tramites.infosolicitante')
				@endif				
				@if(Session::has('REQ'))
					@include('tramites.inforequisitos')
				@endif				
				@if(Session::has('SP'))
					@include('tributos.infosp')
				@endif
				@if(Session::has('INM'))
					@include('tributos.infoinm')
				@endif
				@if(Session::has('CLAPUB'))
					@include('tributos.infopub')
				@endif
				@if(Session::has('CLALAE'))
					@include('tributos.infolae')
				@endif					
				<div class="form-actis center">
					<a class="btn btn-sm btn-success" href="{{ route('registrotramite')}}">			Continuar
						<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</a>
				</div>
				</div>
    		</div>
		</div>

    </div>
@endsection

