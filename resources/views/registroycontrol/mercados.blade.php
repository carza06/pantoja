@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'Registro de Contribuyentes';
$tramite = Session::get('TMT');
$sp = Session::get('SP');
//dd($sp);
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    
				
		<!-- PAGE CONTENT BEGINS
		<div class="row">
			<div class="col-xs-8">
		
			<div class="widget-box">
				<div class="widget-header">
					<h6 class="widget-title">
						<i class="fa fa-check-square-o"></i>
						 Busque al Contribuyente
					</h6>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						
					</div>
				</div>
			</div>
			<hr>

		

    </div> -->
	<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
			Busque al Contribuyente
			</h6>
	</div>
	<div class="panel-body">
	<form class="form-search" action="{{ route('busquedaspmercados') }}" method="POST">
							<div class="row">
								<div class="col-sm-6">
									<label class="radio-inline"><input type="radio" name="search" value="1" checked>Id Control</label>
									<label class="radio-inline"><input type="radio" name="search" value="2">Cedula | RNC</label>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-8">
									<label for="form-field-mask-2">
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
						</form><br>
				@if (Session::has('SP'))
				@include('tributos.infosp')
				@if(Session('ARBITRIO') == 'DS')
					<a href="{{ route('duplicidad') }}" class="btn btn-xs btn-warning">
						Introducir otros datos
					</a>
				@endif		
			@else
				@if(Session::has('fail'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>

					<strong>
						<i class="ace-icon fa fa-times"></i><font><font>
						¡Ah!
					</font></font></strong><font><font>
						{{Session::get('fail')}}
					
					</font></font><br>
				</div>
				@endif
			@endif
			@if(\Session::has('ARBITRIO') && Session::has('search'))
			    <form action="{{ route(Session::get('GUARDAR')) }}" method="POST">	
				@if (!Session::has('SP') )
					@if(Session::has('duplicidad'))
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>

						<strong>
							<i class="ace-icon fa fa-times"></i><font><font>
							¡Advertencia!
						</font></font></strong><font><font>
							{{Session::get('duplicidad')}}
						
						</font></font><br>
					</div><br>
					@endif
					@include('registroycontrol.sp')								
				@endif
				@if(\Session::get('ID')==1)
				@include('registroycontrol.formmercados')
				@endif
				<div class="form-actions center">
					<button type="submit" class="btn btn-sm btn-success">
						Continuar
						<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</button>
				</div>
				</form>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection