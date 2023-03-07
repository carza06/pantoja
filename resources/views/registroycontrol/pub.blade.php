

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
		<h5>
			Publicidad
		</h5>
	</div>
	<div class="panel-body">
		<div class="row">	
			<div class="col-xs-12">
					<table id="simple-table" class="table table-sm table-striped">
						<thead>
							<tr>
								<th>Id Tributo</th>
								<th>Direccion</th>
								<th>Permiso Vigente</th>
								<th>Saldo </th>
								@if(isset($editartrib))
									@if($editartrib == 1)
									<th>Cargado por</th>
									<th width="10%">Acciones</th> 
									@endif
								@endif
							</tr>
						</thead>
												
						<tbody>
							@for($i = 0; $i < count($pub); $i++)
							<tr>
								<td><a href="/main/estadodecuenta/{{$pub[$i][0]}}">{{$pub[$i][0]}}</a></td>
								<td>{{$pub[$i][1]}}</td>
								<td>{{$pub[$i][2]}}</td>
								<td><p class="pull-left">{{number_format($pub[$i][3],2)}}</p></td>
								@if(isset($editartrib))
									@if($editartrib == 1)
									<td>
										{{ $pub[$i][4] }}
									</td>
									<td align="center">
										<a href="{{ route('edittrb',array($pub[$i][0]))}}" class="btn btn-xs btn-success">
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