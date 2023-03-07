<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">Datos del Contribuyente</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-sm-6">
							<label class="radio-inline"><input type="radio" name="tiposp" value="1"  checked>Juridico</label>
							<label class="radio-inline"><input type="radio" name="tiposp" value="2">Natural</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
			
							<div>
								<label for="form-field-mask-2">
									Cedula | RNC
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" id="form-field-mask-2" name ="cedula_rcn">
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

									<input class="form-control input-mask-text" type="text" name = "nombre_razonsocial" id="form-field-mask-2" required>
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

									<input class="form-control input-mask-phone" name="apellido_denominacioncomercial" type="text" id="form-field-mask-2">
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
									<input type='text' class="form-control" id='datepicker' name="fechanacimiento_fundada">
								
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

									<input class="form-control input-mask-phone" name ="direccion" type="text" id="form-field-mask-2">
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

									<input class="form-control input-mask-phone" name ="telefonoprincipal" type="text" id="form-field-mask-2">
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

									<input class="form-control input-mask-phone" name = "telefonosecundario" type="text" id="form-field-mask-2">
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

									<input class="form-control input-mask-phone" name = "email" type="text" id="form-field-mask-2">
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
	$(document).ready(function(){
	    $("#myBtn").click(function(){
	        $("#myModal").modal();
	    });
	});
</script>
@stop
