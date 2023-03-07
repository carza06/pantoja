<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Datos de el Tramitante
			</h6>
	</div>
	<div class="panel-body">
			<div class="row">
						<div class="col-sm-6">
							<dl id="dt-list-1">
								<dt>Cedula</dt>
								<dd>{{ strtoupper($st['cedula1']) }}-{{ strtoupper($st['cedula2']) }}-{{ strtoupper($st['cedula3']) }}</dd>
								<br><dt>NOMBRE</dt>
								<dd>{{ strtoupper($st['nombre']) }}</dd>
							</dl>
						</div>
						<div class="col-sm-6">
							<dl id="dt-list-2">
								<dt>TELEFONO</dt>
								<dd>{{ strtoupper($st['telefono']) }}</dd>		
							</dl>
						</div>						
					</div>
	</div>
</div>
</div>


