@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	<div class="row">
    		<div class="page-header">
				<h3>
					Introduzca los Datos
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>						
					</small>
				</h3>
			</div><!-- /.page-header -->
			
		<!-- PAGE CONTENT BEGINS -->
		</div>
		<form>
		<div class="row">
			<div class="col-xs-4">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="widget-title">
							<i class="fa fa-check-square-o"></i>
							{{$tramites['titulosp']}}
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
						@if($tramites['idhechoimponible'] == 2)
							@include('tributos.spn')	
						@endif
						</div>
					</div>

				</div>
			</div>
			<div class="col-xs-8">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="widget-title">
							<i class="fa fa-check-square-o"></i>
							{{$tramites['tituloinm']}}						
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
						
							@include('tributos.inm')	
						
						</div>							
						</div>
					</div>

				</div>
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
@endsection