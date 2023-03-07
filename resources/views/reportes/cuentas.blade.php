@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Reportes';
$submenu = 'Cuentas';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">

		
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary" >
				<div class="panel-heading">
					<h5>Catalogo de Cuentas</h5>
				</div>
					<div class="panel-body">
					<div class="clearfix">
				<div class="form-group">
					<form action="{{ route('cuentas')}}" class="form-inline" method="get">
						<center>
						<label for="form-field-mask-1">
							Desde:
						</label>
						<div class="input-group">
							<span class="input-group-addon">
									<i class="ace-icon fa fa-calendar bigger-110"></i>
							</span>
							<input type='text' class="form-control" id='desde' name="desde" required>
						</div>
						<label for="form-field-mask-1">
							Hasta:
						</label>
						<div class="input-group">
							<span class="input-group-addon">
									<i class="ace-icon fa fa-calendar bigger-110"></i>
							</span>
							<input type='text' class="form-control" id='hasta' name="hasta" required>
						</div>
						<div class="input-group">
									<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-60"></span>
									Buscar
								</button>
							</span>			
						</div>
						</center>
					</form>
					</div>
					<div class="row">
							<div class="col-xs-12">
								<div class="btn-group btn-corner pull-right">
									<a href="/main/cuentas/{{ $desde }}/{{ $hasta }}/imprimir" target="_blank" class="btn btn-info pull-right"><i class="fa fa-print"></i></a>
								</div>
							</div>
						</div>
				<!-- /.page-header -->
				
					<!-- PAGE CONTENT BEGINS -->
						<div class="row">
							@if (Session::has('transaccion'))
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									{{ Session::get('transaccion') }}
								</div>
							@endif
							@include('reportes.detallecuentas')
						</div>
						</div>
					</div>
				</div>
			</div>
 
@endsection
@section('scripts')
<script>
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
		$("#desde").datepicker();
		$("#hasta").datepicker();
	});
</script>
@endsection
