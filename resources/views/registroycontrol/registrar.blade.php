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
    	
    	
				
		<!-- PAGE CONTENT BEGINS -->
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Busque al Contribuyente
			</h6>
	</div>
	<div class="panel-body">
		<div class="widget-main no-padding">
							<form class="form-search" action="{{ route('busquedasp') }}" method="POST">
								<div class="row">
									<center>
									<div class="col-sm-12">
										<label class="radio-inline"><input type="radio" name="search" value="1" checked>Id Control</label>
										<label class="radio-inline"><input type="radio" name="search" value="2">Cedula | RNC</label>
									</div>
									</center>
								</div><br>
								<div class="row">
									<div class="col-xs-12 col-sm-8">
										
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
						</div>
		</div>
	</div>
</div>

			@if (Session::has('SP'))
				@include('tributos.infosp')		
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
			@if(\Session::has('ARBITRIO'))
			    <form action="{{ route(Session::get('GUARDAR')) }}" method="POST">	
				@if (!Session::has('SP'))	
				@include('registroycontrol.sp')								
				@endif
				@if(isset($sectores))
				@include('registroycontrol.formubg')
				@include('registroycontrol.formambiente')
				@endif
				@if(\Session::get('ID')==1)
				@include('registroycontrol.formmercados')
				@endif
				@if(\Session::get('ID')==2)
				@include('registroycontrol.formhoteles')
				@endif
				@if(\Session::get('ID')==3)
				@include('registroycontrol.formbillares')
				@endif
				@if(\Session::get('ID')==4)
				@include('registroycontrol.formbillares')
				@endif
				@if(\Session::get('ID')==5)
				@include('registroycontrol.formds')
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


@endsection