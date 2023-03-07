



<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Datos del impuesto
			</h6>
	</div>
	<div class="panel-body">
			@php $cla = Session::get('CLAPUB.CLA'); @endphp
			@foreach ($cla as $pub)								
				<div class="row">
						<div class="col-sm-6">
							<dl id="dt-list-1">
								<dt>Clasificador</dt>
								<dd>{{ strtoupper($pub['descripcion']) }}</dd>
							</dl>
						</div>
						<div class="col-sm-6">
							<dl id="dt-list-2">
								<dt>Distancia (Mt2|Caras|Unidad)</dt>
								<dd>{{ strtoupper($pub['basecal']) }}</dd>		
							</dl>
						</div>						
					</div>
					@endforeach
	</div></div></div>


