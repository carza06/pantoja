<!-- <div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">Datos del Contribuyente</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-sm-6">
							<label class="radio-inline"><input type="radio" name="tiposp" value="1" checked>Juridico</label>
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

						</div>
						<div class="col-sm-6">
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
</div> -->

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Datos del Contribuyente
			</h6>
	</div>
	<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<center>
							<label class="radio-inline"><input type="radio" name="tiposp" value="1" checked>Juridico</label>
							<label class="radio-inline"><input type="radio" name="tiposp" value="2">Natural</label>
							</center>
						</div>
					</div><br>
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
							</div><br>
							<div>
								<label for="form-field-mask-2">
									Telefono principal
									
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>

									<input class="form-control input-mask-phone" min="0" max="3" placeholder="(999) 999-9999" name ="telefonoprincipal" type="number" id="form-field-mask-2">
								</div>
							</div>

						</div>
						<div class="col-sm-6">
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
							</div>		<br>				


							<div>
								<label for="form-field-mask-2">
									Correo Electronico
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-envelope-o"></i>
									</span>

									<input class="form-control input-mask-phone" placeholder="example@gmail.com" name = "email" type="text" id="form-field-mask-2">
								</div>
							</div>							
						</div>
					</div>
		</div>
	</div>
</div>
