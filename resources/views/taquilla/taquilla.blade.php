@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Taquilla';
$submenu = 'Mi Taquilla';
?>
@stop
@section('contenido')
  @parent

		<!-- PAGE CONTENT BEGINS -->
	
		
		<br>
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Filtrar por fecha
					</h6>
				</div>
				<div class="panel-body">
				<div class="col-xs-8">
				<div class="row">
					<div class="col-sm-12">
				<form action="{{ route('mitaquilla')}}" method="get">
				<label for="form-field-mask-1">
					Fecha:
				</label>
				<div class="input-group">
					<span class="input-group-addon">
							<i class="ace-icon fa fa-calendar bigger-110"></i>
					</span>
					<input type='text' class="form-control" id='datepicker' name="fecha" required>
					<span class="input-group-btn">
						<button type="sumit" class="btn btn-success btn-sm">
							<span class="fa fa-search icon-on-right bigger-60"></span>
							Buscar
						</button>
					</span>
				</div>
				</form>
				</div>
				</div>
				</div>
				</div>
			</div>
		</div>

		@include('taquilla.detalletaquilla')
		</div>
		<div class="row">
			<div class="col-sm-10">
			<div class="btn-group btn-corner pull-right">
				<a href="/main/mitaquilla/{{ $fecha }}/imprimir" target="_blank" class="btn btn-info pull-right"><i class="fa fa-print"></i></a>
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
		$("#datepicker").datepicker();
		
	});
</script>
@stop
