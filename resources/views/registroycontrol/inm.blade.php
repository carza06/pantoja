

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
		<h5>
			Inmuebles
		</h5>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
					<table id="simple-table" class="table table-sm table-striped ">
						<thead>
							<tr>
								<th>Id Tributo</th>
								<th>Direccion</th>
								<th>Uso Inmueble</th>
								<th>Tipo de inmueble</th>
								<th>Uso Suelo</th>
								<th>Catastro</th>
								<th>Mts</th>
								<th>Saldo</th>
								
							</tr>
						</thead>
												
						<tbody>
							@for($i = 0; $i < count($inm); $i++)
							<tr>
								<td><a href="/main/estadodecuenta/{{$inm[$i][0]}}">{{$inm[$i][0]}}</a></td>
								<td>{{$inm[$i][1]}}</td>
								<td>{{$inm[$i][2]}}</td>
								<td>{{$inm[$i][3]}}</td>
								<td>{{$inm[$i][4]}}</td>
								<td>{{$inm[$i][5]}}</td>
								<td>{{$inm[$i][6]}}</td>
								<td>{{number_format($inm[$i][7],2)}}</td>
							</tr>		
							@endfor
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>