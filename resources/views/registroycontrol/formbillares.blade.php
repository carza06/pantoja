<!-- <div class="row">
	<div class="col-xs-10">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h5 class="widget-title smaller">Datos del Arbitrio</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">

					
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
			Datos del Arbitrio
			</h6>
	</div>
	<div class="panel-body">
	<div class="row">
						<div class="col-sm-12">
							<div class="row">
							<div class="col-xs-6">
								<label for="form-field-mask-1">
									Inicio de Cobro
									<small class="text-success">aaaa/mm/dd</small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
											<i class="ace-icon fa fa-calendar bigger-110"></i>
									</span>
									<input type='text' class="form-control" id='iniciocobro' name="iniciocobro">
								
								</div>
							</div>
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Numero de Mesas
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" id="form-field-mask-2" name ="mesas" required>
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
		$("#iniciocobro").datepicker();
		
	});
</script>
@append