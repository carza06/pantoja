<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">
			<i class="fa fa-check-square-o"></i>
			 Busque el Catastro del Inmueble
		</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main no-padding">
			<form class="form-search" action="{{ route('datosinm') }}" method="POST">
				<div class="row">
					<div class="col-xs-12 col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-check"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="catastro" 
									placeholder="Ingrese el Numero de Catastro" 
									required 
									pattern="[0-9]{8,8}"      							
									title="campo solo números. Tamaño mínimo: 8. Tamaño máximo: 8"
							/>
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-purple btn-sm">
									<span class="fa fa-search icon-on-right bigger-110"></span>
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