@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'Generar Deuda';
$route1 = 'generardeuda';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		
			<!-- PAGE CONTENT BEGINS -->

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
			<div class="col-xs-12">
				@include('core.busquedaxtributo')
			</div>		
		</div>
		<hr>

		<div class="row">
			<div class="col-xs-12">
			@if(isset($sp))
				@include('tributos.infosp')
				<div class="space-8"></div>
				<div class="col-xs-8"style="float:none !important; margin: 0 auto" >
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>Generacion de deuda</h5>
					</div>
					<div class="panel-body">
						<div class="col-xs-12">
							<center>
					<form class="form-inline" action="{{ route('procesardeuda') }}" method="POST">
						<div class="form-group">			
				
						<input type="hidden" name="idtributo" value="{{ $idtributo }}">
							
						<div class="row">
							<div class="col-xs-6">
							<label for="form-field-mask-1">
								Desde
							</label><br>
							<div class="input-group">
								<span class="input-group-addon">
										<i class="ace-icon fa fa-calendar bigger-110"></i>
								</span>
								<input type='text' class="form-control" id='iniciocobro' name="iniciocobro" required>
							</div><br>
							</div>
							<div class="col-xs-6">
							<label for="form-field-mask-1">
								Hasta
							</label><br>
							<div class="input-group">
								<span class="input-group-addon">
										<i class="ace-icon fa fa-calendar bigger-110"></i>
								</span>
								<input type='text' class="form-control" id='hastacobro' name="hastacobro" required>
							</div>
							</div>
						</div>
						<br>
						
						<div class="input-group col-xs-12" align="center">
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-60"></span>
									Generar Deuda
								</button>
							</span>
						</div>
					
					</form>
					</center>
					</div>
					</div>
				</div>
				</div>
				</div>
			@endif
			</div>
		</div>
		
    </div>
@endsection
@section('scripts')
<script type="text/javascript">

	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'yy-mm-dd',
		 changeYear: true,
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
	 };
	$.datepicker.setDefaults($.datepicker.regional['es']);

	$(function () {
		$("#iniciocobro").datepicker();
	});
	$(function () {
		$("#hastacobro").datepicker();
	});	
</script>
@stop