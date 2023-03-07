@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'R.U.C';
$route = 'ruc';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		

		@if(Session::has('busqueda'))
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>

					<strong>
						<i class="ace-icon fa fa-times"></i><font><font>
						¡!
					</font></font></strong><font><font>
						{{Session::get('busqueda')}}
						@php(Session::forget('busqueda'))
					</font></font><br>
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-6">
				@include('core.busqueda')
			</div>		
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-12">
			@if(isset($contribuyentes))
				@include('registroycontrol.contribuyentes')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
			@if(isset($sp))
				@include('tributos.infosp')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
			@if(isset($lae))
				@include('registroycontrol.lae')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
			@if(isset($pub))
				@include('registroycontrol.pub')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
			@if(isset($inm))
				@include('registroycontrol.inm')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
			@if(isset($ds))
				@include('registroycontrol.ds')
			@endif
			</div>
		</div>
    </div>
@endsection