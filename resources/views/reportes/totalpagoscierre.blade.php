<style>
	th{
		font-size: 10px;
	}
	td{
		font-size: 10px;
	}
	h6{font-size: 10px;}
</style>

@php ($total = 0)
@php ($totalefectivo = 0)
@php ($totalcheque = 0)
@php ($totaltransferencias = 0)
@php ($totaltarjetas = 0)
    @for($i = 0;$i < count($efectivo); $i++)
        @php 
            $totalefectivo += $efectivo[$i][4];
            $total += $efectivo[$i][4];
        @endphp
    @endfor
	@for($j = 0;$j < count($verifone); $j++)
        @php 
            $totaltarjetas += $verifone[$j][6];
            $total += $verifone[$j][6];
        @endphp
    @endfor
    @for($x = 0;$x < count($cheques); $x++)
		@php 
			$totalcheque += $cheques[$x][6];
			$total += $cheques[$x][6];
		@endphp
	@endfor
    @for($t = 0;$t < count($transferencias); $t++)
		@php 
		    $totaltransferencias += $transferencias[$t][5];
			$total += $transferencias[$t][5];
		@endphp
	@endfor


<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-money"></i>
						RESUMEN OPERACIONES DEL DIA
					</h6>
				</div>
				<div class="panel-body">
				<table id="simple-table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th align="center">DESCRIPCION</th>								
								<th align="center">MONTO</th>
							</tr>
						</thead>														
						<tbody>
						
							<tr>
							<td>EFECTIVO</td>
                            <td>{{number_format($totalefectivo,2) }}</td>
							</tr>
                            <tr>
                            <td>CHEQUE</td>
                            <td>{{number_format($totalcheque,2)}}</td>
                            </tr>
                            <tr>
                            <td>TRANSFERENCIA</td>
                            <td>{{number_format($totaltransferencias,2)}}</td>
                            </tr>
                            <tr>
                            <td>VERIFONE</td>
                            <td>{{number_format($totaltarjetas,2)}}</td>
                            </tr>
                            <tr>
                            <td>DEPOSITOS</td>
                            <td>-</td>
                            </tr>
							<tr>
								<td align="right" colspan="1">TOTAL </td>
								<td>{{ number_format(($total),2)}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>


@if(isset($efectivo))
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-money"></i>
						EFECTIVO
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
								<th>Monto RD$</th>
							</tr>
						</thead>														
						<tbody>
						
						@for($i = 0;$i < count($efectivo); $i++)
						
							<tr>
								<td>{{$efectivo[$i][0]}}</td>
								<td>{{$efectivo[$i][1]}}</td>
								<td>{{$efectivo[$i][2]}}</td>
								<td>{{$efectivo[$i][3]}}</td>
								<td><p class="pull-right">{{number_format($efectivo[$i][4],2)}}</p></td>
							</tr>
							
						@endfor
							<tr>
								<td align="right" colspan="4">TOTAL EFECTIVO</td>
								<td><p class="pull-right">{{number_format($totalefectivo,2) }}</p></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
		@if(isset($verifone))
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-money"></i>
						Tarjetas
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
								<th>Tipo tarjeta</th>
								<th>Monto RD$</th>
							</tr>
						</thead>														
						<tbody>
						@php ($totaleverifone = 0)
						@for($i = 0;$i < count($verifone); $i++)
						
							<tr>
								<td>{{$verifone[$i][4]}}</td>
								<td>{{$verifone[$i][0]}}</td>
								<td>{{$verifone[$i][5]}}</td>
								<td>{{$verifone[$i][3]}}</td>
								<td>{{$verifone[$i][2]}}</td>
								<td>{{$verifone[$i][1]}}</td>
								<td><p class="pull-right">{{number_format($verifone[$i][6],2)}}</p></td>
							</tr>
								@php 
									$totaleverifone += $verifone[$i][6];
								@endphp
						@endfor
							<tr>
								<td align="right" colspan="6">Total Tarjetas RD$</td>
								<td><p class="pull-right">{{number_format($totaleverifone,2) }}</p></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
		@if(isset($cheques))
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
					<i class="fa fa-sticky-note-o"></i>
					 CHEQUES
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
						
						@for($x = 0;$x < count($cheques); $x++)
							<tr>
								<td>{{$cheques[$x][0]}}</td>
								<td>{{$cheques[$x][1]}}</td>
								<td>{{$cheques[$x][2]}}</td>
								<td>{{$cheques[$x][3]}}</td>
								<td>{{$cheques[$x][4]}}</td>
								<td>{{$cheques[$x][5]}}</td>
								<td><p class="pull-right">{{number_format($cheques[$x][6],2)}}</p></td>
						
							</tr>
						@endfor
							<tr>
								<td align="right" colspan="6">TOTAL CHEQUES</p></td>
								<td><p class="pull-right">{{number_format($totalcheque,2)}}</p></td>
							</tr>							
						</tbody>
					</table>	
				</div>
			</div>
		</div>
		@endif
		@if(isset($transferencias))
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-exchange"></i>
					 	TRANSFERENCIAS
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

						@for($t = 0;$t < count($transferencias); $t++)
							<tr>
								<td>{{$transferencias[$t][0]}}</td>
								<td>{{$transferencias[$t][1]}}</td>
								<td>{{$transferencias[$t][2]}}</td>
								<td>{{$transferencias[$t][3]}}</td>
								<td>{{$transferencias[$t][4]}}</td>
								<td><p class="pull-right">{{number_format($transferencias[$t][5],2)}}</p></td>
					
							</tr>
						@endfor
							<tr>
								<td align="right" colspan="5">TOTAL TRANSFERENCIAS</p></td>
								<td><p class="pull-right">{{number_format($totaltransferencias,2)}}</p></td>
							</tr>							
						</tbody>
					</table>	
				</div>
			</div>
		</div>
		@endif
		@if(isset($total))
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading" style="height: 35px	;">
						<span class="pull-right">
						<b>TOTAL GENERAL: {{ number_format(($total),2)}}</b>	
						</span>	
				</div>
			</div>
		</div>
		@endif
		<br>
		<div align="center">
          <font size="1">"FORMATO PARA USO EXCLUSIVO DE LA EMPRESA D&D 2311 SERVICE AND SOLUTIONS"</font>
        </div>