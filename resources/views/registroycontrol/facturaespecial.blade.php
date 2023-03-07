<div class="row">	
	
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h5 class="widget-title smaller">Facturas Especiales</h5>
			</div>
			<table id="simple-table" class="table table-sm table-striped table-bordered">
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Numero de Factura</th>
						
						<th></th>
					</tr>
				</thead>
										
				<tbody>
					@foreach($facturas as $factura)
					<tr>
						<td>{{ $factura->created_at}}</td>
						<td>{{ str_pad($factura->id, 6, "0", STR_PAD_LEFT) }}</td>
						<td>
							<div class="hidden-sm btn-group">
								<a href=" {{ route('imprimirfacturaespecial',[$factura->id])}}" target="_blank" class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-print bigger-120"></i>
								</a>
							</div>
						</td>
					</tr>		
					@endforeach
				</tbody>
			</table>
			
		</div>
	</div>
</div>