@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Estado de Cuenta';
$route ='procesarpago';
$route1 = 'estadodecuenta';
$total = 0;
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="row">
					@if (Session::has('edocuenta'))
					    <div class="alert alert-success">
						    <button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
					        {{ Session::get('edocuenta') }}
					    </div>
					@endif
					
				</div>
			</div>
		
		<div class="row">
			<div class="col-xs-12">
				@include('core.busquedaxtributo')
			</div>
		</div>
		@if(isset($sp))
		<div class="row">
			<div class="col-xs-12">
				@include('tributos.infosp')
			</div>
		</div>
		@endif
		@if(isset($inm))
		<div class="row">
			<div class="col-xs-12">
				@include('tributos.infoinm')
			</div>
		</div>
		@endif
		@if(isset($ds))
		<div class="row">
			<div class="col-xs-12">
				@include('tributos.infods')
			</div>
		</div>
		@endif
		@if(isset($pub))
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
		@endif
		@if(isset($edo))
		@php
			$idtributo = Session::get('IdTributo');
		@endphp
		<div class="row">
			<div class="col-xs-9">
				@include('tramites.infoedo')
			</div>
			@if(isset($facturas))
				<div class="col-xs-3">
					@include('tributos.hisfact')
				</div>
			@endif
		</div>
		@endif		
	
    </div>
 <!-- Modal -->
 @if(isset($edo))
@include('taquilla.modalefectivo')
@include('taquilla.modalcheque')
@include('taquilla.modaltransferencia')
@include('taquilla.modaltarjetas')
@endif
@endsection

