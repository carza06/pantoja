<!-- <div class="widget-box">
	<div class="widget-header col-xs-4 col-sm-8">
		<h6 class="widget-title">
			<i class="fa fa-check-square-o"></i>
			 Busque el IdTributo
		</h6>
	</div>
	<div class="widget-body" style="margin-top: 15px;">
		<div class="widget-main no-padding">
			<form class="form-search" action="{{ route($route1) }}" method="GET">
				<div class="row">
					<div class="col-xs-4 col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="idtributo" 
									placeholder="IdTributo" 
									required 
									pattern="[0-9]{1,10}"      							
									title="campo solo números. Tamaño mínimo: 1. Tamaño máximo: 8"
							/>
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-90"></span>
									Buscar
								</button>
							</span>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> -->
<div class="col-xs-6" style="float:none !important; margin: 0 auto">
<div class="panel panel-primary " style="margin-top: 50px;">
  <div class="panel-heading">
  	<h6 class="widget-title">
		<i class="fa fa-search"></i>
		Busqueda por Tributo
	</h6>
  </div>
  <div class="panel-body">
  <form class="form-search" action="{{ route($route1) }}" method="GET">
				<div class="row">
					<div class="col-xs-4 col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="idtributo" 
									placeholder="IdTributo" 
									required 
									pattern="[0-9]{1,10}"      							
									title="campo solo números. Tamaño mínimo: 1. Tamaño máximo: 8"
							/>
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-90"></span>
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