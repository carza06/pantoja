@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Facturacion';
$submenu = 'Asignar Valor Fiscal';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
	
			<!-- PAGE CONTENT BEGINS -->

		
		
		

		<div class="row">
			<div class="col-xs-12">
			@if(isset($sp))
				@include('tributos.infosp')
				<div class="space-8"></div>
				<form class="form-inline" action="{{ route('procesardeuda') }}" method="POST">
						<div class="form-group">			
				
						<input type="hidden" name="idtributo" value="{{ $idtributo }}">
						
							<label for="form-field-mask-1">
								Generar deuda Desde
							</label>

							<div class="input-group">
								<span class="input-group-addon">
										<i class="ace-icon fa fa-calendar bigger-110"></i>
								</span>
								<input type='text' class="form-control" id='iniciocobro' name="iniciocobro" required>
							</div>
						
						
							<label for="form-field-mask-1">
								Hasta
							</label>

							<div class="input-group">
								<span class="input-group-addon">
										<i class="ace-icon fa fa-calendar bigger-110"></i>
								</span>
								<input type='text' class="form-control" id='hastacobro' name="hastacobro" required>
							</div>
						
						<div class="input-group">
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-60"></span>
									Generar Deuda
								</button>
							</span>
						</div>
					
				</form>
				</div>
			@endif
			</div>
<br>
			<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>
							Asignar Valor fiscal
						</h5>
					</div>
					<div class="panel-body">
						@if(Session::has('busqueda'))
						<div class="row">
							<div class="col-xs-12">
								<div class="alert alert-primary">
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
								@include('core.busquedaxfactura')
							</div>		
						</div>
					</div>
				</div>
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