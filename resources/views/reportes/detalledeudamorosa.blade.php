@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Reportes';
$submenu = 'Detalle Deuda Morosa';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
		
		
<br>
			<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary" >
				<div class="panel-heading">
					<h5>Exportar detalles</h5>
				</div>
					<div class="panel-body">
						<div class="col-xs-12">
							<div class="row">
								@if (Session::has('transaccion'))
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>
										{{ Session::get('transaccion') }}
									</div>
								@endif
								
							</div>
						</div>
						<div class="col-xs-12">
							<form action="{{route('detalledeudamorosa')}}" method="GET">
								<center>
								<div class="col-xs-12">
									
									<label for="form-field-select-1"> Intervalos de Fechas</label>
									<div class="row">
										<div class="col-xs-6">
										<label for="form-field-mask-1">
											Desde
										</label><br>
										<div class="input-group">
											<span class="input-group-addon">
													<i class="ace-icon fa fa-calendar bigger-110"></i>
											</span>
											<input type='date' class="form-control" id='inicio' name="inicio" required>
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
											<input type='date' class="form-control" id='hasta' name="hasta" required>
										</div>
										</div>
									</div>
								</div>
								<div class="col-xs-8">
									<label for="form-field-select-1"> Filtro Por Sector</label>
									<select class="form-control" id="form-field-select-1"  name = "sector">

										<option value="" selected>----Filtrar por Sector----</option>
										@foreach ($sectors as $sector)
											<option value="{{$sector->id}}">{{$sector->sector}}</option>
										@endforeach
									</select>
									<font sizeof="3px" style="color:red">(Puede seleccionar para filtrar el reporte por sector)</font>
								</div>
								<div class="col-xs-8">
									<br>
									<label for="form-field-select-1"> Seleccionar Reporte a Exportar</label>
									<select class="form-control" id="form-field-select-1"  name = "idhi" onchange='this.form.submit()'>

										<option value="" selected>----Seleccionar Tipo de Reporte----</option>
										@foreach ($hi as $var)
											<option value="{{$var->id}}">{{$var->nombrehechoimponible}}</option>
										@endforeach
									</select>
									<noscript><input type="submit" value="Submit"></noscript>
								</div>
								</center>
							</form>
						</div>
					</div>
				</div>
			</div>


			@if(isset($detalle))
			<div class="col-xs-10">
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Nombre | Razon Social</th>
							<th>IdTributo</th>
							<th>Sector</th>
							<th>Barrio</th>						
							<th>Deuda</th>
						</tr>
					</thead>
											
					<tbody>
						@foreach ($detalle as $value)
						<tr>
							<th>{{ $value->nombre_razonsocial }}</th>
							<th>{{ $value->id }}</th>
							<th>{{ $value->sector }}</th>
							<th>{{ $value->barrio }}</th>
							<th>{{ $value->nombre }}</th>
							<th>{{ $value->monto }}</th>
						</tr>		
						@endforeach
					</tbody>
				</table>
			</div>
			@endif
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