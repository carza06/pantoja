
<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Busque al Contribuyente
					</h6>
				</div>
				<div class="panel-body">
				<form class="form-search" action="{{ route('sujetopasivo') }}" method="POST">
				<div class="row">
					<div class="col-sm-6">
						<label class="radio-inline"><input type="radio" name="search" value="1" checked>Id Control</label>
						<label class="radio-inline"><input type="radio" name="search" value="2">Cedula | RNC</label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-8">
						<label for="form-field-mask-2">
								
						<small class="text-warning">Cedula: 00300000011 | RNC: 987654321</small>
						</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="cedularcn" 
									placeholder="Ingrese Cedula | RNC" 
									required 
									pattern="[a-Z0-9]{4,18}"      							
									title="campo solo números. Tamaño mínimo: 11. Tamaño máximo: 11"
							/>
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-60"></span>
									Buscar
								</button>
							</span>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
		</div>