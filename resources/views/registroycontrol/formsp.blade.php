@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'R.U.C';
?>
@stop
@section('contenido')
@parent
    <div class="page-content">
		<div class="page-header">
			<h1>
				Editar Datos del Contribuyente
				<small>
					<i class="ace-icon fa fa-angle-double-right"> {{ $sp["nombre_razonsocial"] }} </i>						
				</small>
			</h1>
		</div>
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
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">Datos del Contribuyente</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<form class="form-search" action="{{ route('updatesp') }}" method="POST">
								<input type="hidden" name="id" value="{{ $sp["id"] }}">
								@if($sp["idstatus"] == 1)
								<div class="row">
									<div class="col-sm-6">
										<label for="form-field-mask-2">
												Estatus
												<small class="text-warning"></small>
											</label>
										<select class="usoinm" id="idstatus" name ='idstatus' required>
								        	<option value="1" selected="true">Activo</option>
								        	<option value="2">Inactivar</option>						     
								    	</select>
								    </div>
								</div>
								@else
								<div class="row">
									<div class="col-sm-6">
										<div>
											<label for="form-field-mask-2">
												Este sujeto pasivo fue inactivado
												<small class="text-warning"></small>
											</label>
										</div>
									</div>
								</div>								
								@endif
								<div class="row">
									<div class="col-sm-6">
										@if($sp["idtiposujetopasivo"] == 1)
										<label class="radio-inline"><input type="radio" name="tiposp" value="1" checked>Juridico</label>
										@else
										<label class="radio-inline"><input type="radio" name="tiposp" value="1" >Juridico</label>
										@endif
										@if($sp["idtiposujetopasivo"] == 2)
										<label class="radio-inline"><input type="radio" name="tiposp" value="2" checked>Natural</label>
										@else
										<label class="radio-inline"><input type="radio" name="tiposp" value="2">Natural</label>
										@endif
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div>
											<label for="form-field-mask-2">
												Id Control
												<small class="text-warning"></small>
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-id-card"></i>
												</span>

												<input class="form-control" type="text" id="form-field-mask-2" name ="idanterior" value ="{{ $sp["idanterior"]}}" readonly>
											</div>
										</div>
						
										<div>
											<label for="form-field-mask-2">
												Cedula | RNC
												<small class="text-warning"></small>
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-id-card"></i>
												</span>

												<input class="form-control" type="text" name ="cedula_rcn" value ="{{ $sp["cedula_rcn"]}}">
											</div>
										</div>

										<div>
											<label for="form-field-mask-2">
												Nombre | Razon Social
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-id-card"></i>
												</span>

												<input class="form-control input-mask-text" type="text" name = "nombre_razonsocial" value = "{{ $sp["nombre_razonsocial"] }}" required> 
											</div>
										</div>

										<div>
											<label for="form-field-mask-2">
												Apellido | Denominacion Comercial
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-id-card"></i>
												</span>

												<input class="form-control input-mask-phone" name="apellido_denominacioncomercial" type="text" value="{{ $sp["apellido_denominacioncomercial"] }}">
											</div>
										</div>
										<div>
											<label for="form-field-mask-1">
												Fecha de Nacimiento | Fecha de Registro
												<small class="text-success">aaaa/mm/dd</small>
											</label>

											<div class="input-group">
												<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar bigger-110"></i>
												</span>
												<input type='text' class="form-control" id='datepicker' name="fechanacimiento_fundada" value="{{ $sp["fechanacimiento_fundada"] }}">
											
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div>
											<label for="form-field-mask-2">
												Direccion
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-compass"></i>
												</span>

												<input class="form-control input-mask-phone" name ="direccion" type="text" value="{{ $sp["direccion"] }}">
											</div>
										</div>						
										<div>
											<label for="form-field-mask-2">
												Telefono principal
												<small class="text-warning">(999) 999-9999</small>
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-phone"></i>
												</span>

												<input class="form-control input-mask-phone" name ="telefonoprincipal" type="text" value="{{ $sp["telefonoprincipal"] }} ">
											</div>
										</div>

										<div>
											<label for="form-field-mask-2">
												Telefono secundario
												<small class="text-warning">(999) 999-9999</small>
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-phone"></i>
												</span>

												<input class="form-control input-mask-phone" name = "telefonosecundario" type="text" value="{{ $sp["telefonoprincipal"] }} ">
											</div>
										</div>
										<div>
											<label for="form-field-mask-2">
												Correo Electronico
												<small class="text-warning">(999) 999-9999</small>
											</label>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="ace-icon fa fa-envelope-o"></i>
												</span>

												<input class="form-control input-mask-phone" name = "email" type="text" value="{{ $sp["email"] }}">
											</div>
										</div>							
									</div>
								</div>
								<div class="form-actions center">
									<button type="sumit" class="btn btn-sm btn-success @if($sp["idstatus"] == 2) disabled @endif">
									Continuar
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal -->
  <div class="modal fade" id="dialog-modal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-exclamation-triangle"></span> Notificación</h4>
        </div>
        <div class="modal-body">
        <p>Ha decidido inactivar el sujeto pasivo, este proceso es irreversible, verifique antes de continuar, los tributos de este sujeto pasivo tambien seran inactivados siempre y cuando no tengan pagos asociados </p>
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
	$(document).ready(function () {
	    $('#idstatus').change(function () {
	        if ($(this).val() == "2") {

	            $('#dialog-modal').modal({
	            	show: true
	        	});
	        }
	    });
	});
</script>
@stop
