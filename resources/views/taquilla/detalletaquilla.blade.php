
@php ($total = 0)
@if(isset($efectivo))
<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Efectivo
					</h6>
				</div>
				<div class="panel-body">
					<table id="simple-table" class="table  table-hover">
						<thead>
							<tr>
								<th>Nro Comprobante</th>								
								<th>Id</th>
								<th>Nombre | Razon Social</th>
								<th>Descripcion</th>
								<th>Monto RD$</th>
							</tr>
						</thead>														
						<tbody>
						@php ($totalefectivo = 0)
						@for($i = 0;$i < count($efectivo); $i++)
						
							<tr>
								<td>{{$efectivo[$i][0]}}</td>
								<td>{{$efectivo[$i][1]}}</td>
								<td>{{$efectivo[$i][2]}}</td>
								<td>{{$efectivo[$i][3]}}</td>
								<td><p class="pull-right">{{number_format($efectivo[$i][4],2)}}</p></td>
							</tr>
								@php 
									$totalefectivo += $efectivo[$i][4];
									$total += $efectivo[$i][4];
								@endphp
						@endfor
							<tr>
								<td align="right" colspan="4">Total Efectivo RD$</td>
								<td><p class="pull-right">{{number_format($totalefectivo,2) }}</p></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
		@if(isset($cheques))
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Cheques
					</h6>
				</div>
				<div class="panel-body">
				<table id="simple-table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Nro Comprobante</th>								
								<th>Id</th>
								<th>Nombre | Razon Social</th>
								<th>Descripcion</th>
								<th>Banco</th>
								<th>Nro Cheque</th>
								<th>Monto RD$</th>
							</tr>
						</thead>														
						<tbody>
						@php ($totalcheque = 0)
						@for($x = 0;$x < count($cheques); $x++)
							<tr>
								<td>{{$cheques[$x][0]}}</td>
								<td>{{$cheques[$x][1]}}</td>
								<td>{{$cheques[$x][2]}}</td>
								<td>{{$cheques[$x][3]}}</td>
								<td>{{$cheques[$x][4]}}</td>
								<td>{{$cheques[$x][5]}}</td>
								<td><p class="pull-right">{{number_format($cheques[$x][6],2)}}</p></td>
								@php 
									$totalcheque += $cheques[$x][6];
									$total += $cheques[$x][6];
								@endphp
							</tr>
						@endfor
							<tr>
								<td align="right" colspan="6">Total Cheques RD$</p></td>
								<td><p class="pull-right">{{number_format($totalcheque,2)}}</p></td>
							</tr>							
						</tbody>
					</table>	
				</div>
			</div>
		</div>
		@endif
		@if(isset($transferencias))
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Transferencias
					</h6>
				</div>
				<div class="panel-body">
				<table id="simple-table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Nro Comprobante</th>								
								<th>Id</th>
								<th>Nombre | Razon Social</th>
								<th>Descripcion</th>
								<th>Nro Transferencia</th>
								<th>Monto RD$</th>
							</tr>
						</thead>														
						<tbody>
						@php ($totaltransferencias = 0)
						@for($t = 0;$t < count($transferencias); $t++)
							<tr>
								<td>{{$transferencias[$t][0]}}</td>
								<td>{{$transferencias[$t][1]}}</td>
								<td>{{$transferencias[$t][2]}}</td>
								<td>{{$transferencias[$t][3]}}</td>
								<td>{{$transferencias[$t][4]}}</td>
								<td><p class="pull-right">{{number_format($transferencias[$t][5],2)}}</p></td>
								@php 
									$totaltransferencias += $transferencias[$t][5];
									$total += $transferencias[$t][5];
								@endphp
							</tr>
						@endfor
							<tr>
								<td align="right" colspan="5">Total Transferencias RD$</p></td>
								<td><p class="pull-right">{{number_format($totaltransferencias,2)}}</p></td>
							</tr>							
						</tbody>
					</table>	
				</div>
			</div>
		</div>
		@endif
		@if(isset($total))
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading" style="height: 35px	;">
						<span class="pull-right">
						<b>Total Caja RD$: {{ number_format(($total),2)}}</b>	
						</span>	
				</div>
			</div>
		</div>
		@endif