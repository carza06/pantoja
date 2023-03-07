
	<div class="col-xs-12">
		<table class="table table-striped  table-hover">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th style="width: 30%;">Monto Recaudado RD$</th>
				</tr>
			</thead>
								
			<tbody>	
				@php ($total = 0)
				@foreach ($reporte as $value)
				<tr>
					<td>{{$value->codigo}}</td>
					<td>{{$value->descripcion}}</td>
					<td><p class="pull-right">
					@php ($valorimp = $value->Catalogo()->where('p.fechapago','>=',$desde)->where('p.fechapago','<=',$hasta)->sum('pt.monto'))
					@php ($total += $valorimp)
					@php ($valortasa = $value->CatalogoTasa()->where('p.fechapago','>=',$desde)->where('p.fechapago','<=',$hasta)->sum('p.monto'))
					@php ($valor = $valorimp + $valortasa)
					{{number_format ($valor,2)}}
					@php ($total += $valortasa)
					</p>
					</td>
				</tr>		
				@endforeach
				<tr>
					<td align="right" colspan="2">Total</td>
					<td><p class="pull-right">{{number_format ($total,2)}}</p></td>
				</tr>
			</tbody>
		</table>

</div>