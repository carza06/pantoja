
<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			
			Datos de la Propiedad Inmobiliaria
			</h6>
	</div>
	<div class="panel-body">
	<div class="row">
						<div class="col-sm-6">
							<dl id="dt-list-1">
								<dt>Sector</dt>
								
								<dt>Via</dt>
								@if (isset($inm['idusoinm']))
								<dt>Uso Inmueble</dt>
								<dd>{{ strtoupper($inm['idusoinm']) }}</dd>

								<dt>Tipo Inmueble</dt>
								<dd>{{ strtoupper($inm['idtipoinm']) }}</dd>
								@endif
								<dt>Direccion</dt>
								
								<dt>Fecha Adquisicion</dt>
								<dd>{{ strtoupper($inm['fechadeadquisicion']) }}</dd>						
								<dt>Frecuencia de Facturacion</dt>
								<dd></dd>						
							</dl>
						</div>
						<div class="col-sm-6">
							<dl id="dt-list-2">
								<dt>Numero de Catastro</dt>
								<dd>{{ strtoupper($inm['catastro']) }}</dd>		
								<dt>Metros 2 de Terreno</dt>
								<dd>{{ strtoupper($inm['areaterreno']) }}</dd>
								<dt>Metros 2 de Construccion</dt>
								<dd>{{ strtoupper($inm['areacontruccion']) }}</dd>
								<dt>Ingresos</dt>
								<dd>{{ strtoupper($inm['numerohabitantes']) }}</dd>
								<dt>Valor del Inmueble</dt>
								<dd>{{ strtoupper($inm['valorinmueble']) }}</dd>
								<dt>Lindero Norte</dt>
								<dd>{{ strtoupper($inm['linderonorte']) }}</dd>
								<dt>Lindero Sur</dt>
								<dd>{{ strtoupper($inm['linderosur']) }}</dd>
								<dt>Lindero Este</dt>
								<dd>{{ strtoupper($inm['linderoeste']) }}</dd>	
								<dt>Lindero Oeste</dt>
								<dd>{{ strtoupper($inm['linderooeste']) }}</dd>																								
							</dl>
						</div>						
					</div>
	</div>
</div>
</div>


