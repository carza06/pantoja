@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Facturacion';
$submenu = 'Facturacion Especial DS';
$route1 = 'facturacionespecial';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		

		
		@if(isset($idtributo))
		<div class="row">
			<div class="col-xs-8">
			@if(isset($sp))
				@include('tributos.infosp')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
			@if(isset($facturas))
				@include('registroycontrol.facturaespecial')
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h5 class="widget-title smaller">Tarifa Especial</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main">
						<form action ="{{ route('facturaespecial')}}" method="POST">
							<input type="hidden" name="idtributo" value="{{ $idtributo }}">
							<div>
								<label for="form-field-mask-2">
									Seleccione la Tarifa
								</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-money"></i>
									</span>
								    <select name ='idtarifaespecial' required>

								        <option value="0" disabled="true" selected="true">Seleccione la tarifa especial</option>
								        @foreach($tdse as $tarifa)
								            <option value="{{$tarifa->id}}">RD$ {{$tarifa->tarifa}} - {{ $tarifa->descripcion }}</option>
								        @endforeach
								    </select>
								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Numero de Toneladas
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-balance-scale"></i>
									</span>

									<input class="form-control input-mask-text" type="text" maxlength="6" size="6" name = "tonelada" required>
								</div>
							</div>

							<div class="form-actions center">
								<button type="sumit" class="btn btn-sm btn-success">
									Continuar
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
							</div>					
						</form>
					</div>
				</div>
			</div>
		</div>
		@endif
    </div>

	<div class="col-xs-12" style="float:none !important; margin: 0 auto">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5>
					Factura Especial de Desechos Solidos
				</h5>
			</div>
			<div class="panel-body">
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
				@if(Session::has('transaccion'))
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
								{{Session::get('transaccion')}}
								@php(Session::forget('transaccion'))
							</font></font><br>
						</div>
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-xs-12">
						@include('core.busquedaxtributo')
					</div>		
				</div>
				<hr>
			</div>
		</div>
	</div>


@endsection