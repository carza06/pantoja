<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h5>
				Desechos Solidos
			</h5>
		</div>
		<div class="panel-body">
			<div class="row">	
				<div class="col-xs-12">
						<table id="simple-table" class="table table-sm table-striped ">
							<thead>
								<tr>
									<th>Id Tributo</th>
									<th>Categoria</th>
									<th>Tarifa</th>
									<th>Saldo</th>
									@if(isset($editartrib))
										@if($editartrib == 1)
										<th>Cargado por</th>
										<th width="10%">Acciones</th>
										@endif
									@endif
								</tr>
							</thead>
													
							<tbody>
								@for($i = 0; $i < count($ds); $i++)
								<tr>
									<td><a href="/main/estadodecuenta/{{$ds[$i][0]}}">{{$ds[$i][0]}}</a></td>
									<td>{{$ds[$i][1]}}</td>
									<td>{{$ds[$i][2]}}</td>
									<td>{{number_format($ds[$i][3],2)}}</td>
									@if(isset($editartrib))
										@if($editartrib == 1)
										<td>
											{{ $ds[$i][4] }}
										</td>
										<td align="center">
											<a href="{{ route('edittrb',array($ds[$i][0]))}}" class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
											</a>
										</td>
										@endif
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