
<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			Datos del tipo de Negocio
			</h6>
	</div>
	<div class="panel-body">
				@php $cla = Session::get('CLALAE.CLA'); @endphp
					@foreach ($cla as $lae)
												
					<div class="row">
						<div class="col-sm-3">
							<dl id="dt-list-1">
								<dt>Clasificador</dt>
								<dd>{{ strtoupper($lae['actividad']) }}</dd>
							</dl>
						</div>
					
						<div class="col-sm-3">
							<dl id="dt-list-1">
								<dt>Zona</dt>
								<dd>{{ strtoupper($lae['idzonamercado']) }}</dd>
							</dl>
						</div>				
						<div class="col-sm-3">
							<dl id="dt-list-1">
								<dt>dias</dt>
								<dd>{{ strtoupper($lae['basecal']) }}</dd>
							</dl>
						</div>
						<div class="col-sm-3">
							<dl id="dt-list-1">
								<dt>metros</dt>
								<dd>{{ strtoupper($lae['metros']) }}</dd>
							</dl>
						</div>
					</div>
					@endforeach
	</div>
</div>
</div>


