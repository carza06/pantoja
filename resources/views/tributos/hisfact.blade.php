@if($facturas->count() > 0 || !is_null($facturas))


<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h6>
			Historial Facturas
				</h6>
		</div>
		<div class="panel-body">
			<div class="col-xs-12">
							<table id="simple-table" class="table  table-hover">
								<thead>
									<tr>
										<th>Facturas</th>
									</tr>
								</thead>														
								<tbody>									
									@foreach ($facturas as $factura)
										<tr>
										@if(!is_null($factura->idperiodomensual))
										
										<?php 
											// CHECK DESCRIPTION
											if(isset($factura->periodo->descripcion)) {
												// DEFINE DEFAULT VARIABLES
												$description = $factura->periodo->descripcion;
											} else {												
												// DEFINE DEFAULT VARIABLES
												$description = isset($facturas[1]->periodo->descripcion) ? $facturas[1]->periodo->descripcion : "NO FECHA";
												
												// CHECK IF PENULTIMATE IS SET TO | ENERO 2021
												if($description == "Enero 2021") {
													// SET TO | FEBRERO 2021
													$description = "Febrero 2021";
												}
											}
										?>

										<td><a href="{{ route('imprimirhfactura',[$factura->id, $factura->idtributo])}}" target="_blank">{{ $description }}</a></td>
										@endif
										<tr>
									@endforeach
								</tbody>
							</table>					
						</div>
		</div>
	</div>
</div> 
@endif


