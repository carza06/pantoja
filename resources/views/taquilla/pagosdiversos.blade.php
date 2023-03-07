@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Taquilla';
$submenu = 'Pagos Diversos';
$sp = Session::get('SP');
?>
@stop
@section('contenido')
  @parent
  <br>
    <div class="page-content">
	<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Busque al Contribuyente
					</h6>
				</div>
				<div class="panel-body">
				<form class="form-search" action="{{ route('pagosdiversos') }}" method="GET">
								<div class="row">
									<div class="col-sm-12">
										<center>
										<label class="radio-inline"><input type="radio" name="search" value="1" checked>Id Control</label>
										<label class="radio-inline"><input type="radio" name="search" value="2">Cedula | RNC</label>
										</center>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-8">
										<label for="form-field-mask-2">
												
										<small class="text-warning"></small>
										</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-search"></i>
											</span>
											<input type="text" 
													class="form-control"
													name="cedularcn" 
													required 
													pattern="[a-Z0-9]{4,18}"    
													placeholder="Cedula: 00300000011 | RNC: 987654321"  							
													title="campo solo números. Tamaño mínimo: 11. Tamaño máximo: 11"
											/>
											<span class="input-group-btn">
												<button type="sumit" class="btn btn-success btn-sm">
													<span class="fa fa-search icon-on-right bigger-60"></span>
													Buscar
												</button>
											</span>
										</div>
									</div>
								</div>
							</form>
							@if(Session::has('transaccion'))
							<div class="row">
								<div class="col-xs-8">
									<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<strong>
											<i class="ace-icon fa fa-times"></i><font><font>
											¡Ups!
										</font></font></strong><font><font>
											{{Session::get('transaccion')}}
										
										</font></font><br>
									</div>
								</div>
							</div>
							@endif
							@if(Session::has('operacion'))
								<div class="row">
									<div class="col-xs-8">
										<div class="alert alert-danger">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>

											<strong>
												<i class="ace-icon fa fa-times"></i><font><font>
												¡Ups!
											</font></font></strong><font><font>
												{{Session::get('operacion')}}
											
											</font></font><br>
										</div>
									</div>
								</div>
								@endif
				</div>
			</div>
		</div>
		@if(Session::has('SP'))
		<div class="row">
			<div class="col-xs-12">
				@include('tributos.infosp')
				<div class="form-actions center">
					<a class="btn btn-sm btn-success" href="{{ route('selecciontasa')}}">						Continuar
						<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</a>
				</div>
			</div>
		</div>	
		@else
		@if(isset($busqueda))
			<div class="row">
				<div class="col-xs-12">
					<form class="form-search" action="{{ route('tasasujetopasivo') }}" method="GET">
					@include('registroycontrol.sp')
					<div class="form-actions center">
						<button type="sumit" class="btn btn-sm btn-success">
							Continuar
							<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
						</button>
					</div>
					</form>
				</div>
			</div>
			@endif
			@endif
			</div>
@endsection

