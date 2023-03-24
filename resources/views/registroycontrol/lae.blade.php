

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
		<h5>
			Ambiente y Drenaje
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
								<th>Tipo de Actividad</th>
								<th>Saldo RD$</th>
								@if(isset($editartrib))
									@if($editartrib == 1)
									<th>Cargado por</th>
									
									@endif
								@endif
								
							</tr>
						</thead>
												
						<tbody>
							@for($i = 0; $i < count($lae); $i++)
							<tr>
								<td><a href="/main/estadodecuenta/{{$lae[$i][0]}}">{{$lae[$i][0]}}</a></td>
								<td>{{$lae[$i][1]}}</td>
								<td>{{$lae[$i][2]}}</td>
								<td>{{number_format($lae[$i][3],2)}}</td>
								@if($editartrib == 1)
									<td>
										{{ $lae[$i][4] }}
									</td>
								@endif
							</tr>		
							@endfor
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>

