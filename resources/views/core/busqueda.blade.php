<!-- <div class="widget-box">
	<div class="widget-header">
		<h6 class="widget-title">
			<i class="fa fa-check-square-o"></i>
			 Busque al Contribuyente
		</h6>
	</div>
	<div class="widget-body">
		<div class="widget-main no-padding">
			<form class="form-search" action="{{ route($route) }}" method="get"><br>
				<div class="row">
					<div class="col-xs-12">
						<label for="form-field-mask-2">
								
						<small >Id Control: 010102IZ0060A</small>
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="idanterior" 
									placeholder="Ingrese el id" 
								
							/>
						</div>
					</div>
				</div><br>
				<div class="row">				
					<div class="col-xs-12">
						<label for="form-field-mask-2">
								
						<small >Cedula: 00300000011 | RNC: 987654321</small>
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="cedularcn" 
									placeholder="Ingrese Cedula | RNC" 
							/>
						</div>
					</div>
				</div><br>
				<div class="row">				
					<div class="col-xs-12">
						<label for="form-label" style="font-size: medium;">
								
						Nombre | Razon Social
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="nombre_razonsocial" 
									placeholder="Nombre | Razon Social" 
									
									pattern="[a-Z0-9]"      							
									title="campo Alfa Numerico."
							/>

						</div>
					</div>
				</div>
				<div class="space-4"></div>
				<div class="row">				
					<div class="col-xs-12">
						<span class="input-group-btn">
							<button type="sumit" class="btn btn-success btn-sm pull-right">
								<span class="fa fa-search icon-on-right bigger-60"></span>
								Buscar
							</button>
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> -->
<div class="panel panel-primary">
  <div class="panel-heading">
  <h6>
		<i class="fa fa-check-square-o"></i>
			 Busque al Contribuyente
		</h6>
  </div>
  <div class="panel-body">
  <form class="form-search" action="{{ route($route) }}" method="get"><br>
				<div class="row">
					<div class="col-xs-12">
						<label for="form-field-mask-2" style="font-size: medium;">
								
						Id Control:
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="idanterior" 
									placeholder="Ingrese el id" 
								
							/>
						</div>
					</div>
				</div><br>
				<div class="row">				
					<div class="col-xs-12">
						<label for="form-field-mask-2" style="font-size: medium;">
								
						Cedula: 
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="cedularcn" 
									placeholder="Ingrese Cedula " 
							/>
						</div>
					</div>
				</div><br>
				<div class="row">				
					<div class="col-xs-12">
						<label for="form-label" style="font-size: medium;">
								
						Razon Social
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="nombre_razonsocial" 
									placeholder="Nombre | Razon Social" 
									
									pattern="[a-Z0-9]"      							
									title="campo Alfa Numerico."
							/>

						</div>
					</div>
				</div>
				<div class="space-4"></div>
				<div class="row">				
					<div class="col-xs-12">
						<span class="input-group-btn">
							<button type="sumit" class="btn btn-success btn-sm pull-right">
								<span class="fa fa-search icon-on-right bigger-60"></span>
								Buscar
							</button>
						</span>
					</div>
				</div>
			</form>
  </div>
</div>