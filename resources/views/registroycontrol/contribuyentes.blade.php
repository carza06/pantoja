<div class="row">	
	
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h5 class="widget-title smaller">Resultado por busqueda por nombre</h5>
			</div>
			<table id="simple-table" class="table table-sm table-striped table-bordered">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre | Razon Social</th>
					</tr>
				</thead>
										
				<tbody>
					@for($i = 0; $i < count($contribuyentes); $i++)
					<tr>
						<td><a href="ryc/{{ $contribuyentes[$i]['id']}}">{{ $contribuyentes[$i]['id'] }}</a></td>
						<td>{{ $contribuyentes[$i]['nombre_razonsocial'] }}</td>

					</tr>		
					@endfor
				</tbody>
			</table>
			
		</div>
	</div>
</div>