<div class="row">	
	
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h5 class="widget-title smaller">Industria y Comercio</h5>
			</div>
			<table id="simple-table" class="table table-sm table-striped table-bordered">
				<thead>
					<tr>
						<th>Id Tributo</th>
						<th>Direccion</th>
						<th>Tipo de Actividad</th>
						<th><p class="text-center">Saldo RD$</p></th>
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
						<td><p class="pull-right">{{number_format($lae[$i][3],2)}}</p></td>
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