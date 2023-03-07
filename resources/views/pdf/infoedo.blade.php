<table id="simple-table" class="table table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Descripcion</th>
			<th align="right">Monto RD$</th>
		</tr>
	</thead>
							
	<tbody>
		@php 
			$total=0;
		@endphp
		@foreach ($edo as $detalle)
		<tr>
			@php 
			$total+=$detalle->montoremanente;
			@endphp
			<td>{{$detalle->fecha}}</td>
			<td>{{$detalle->descripcion}}</td>
			@if($detalle->idtipomovimientoedo == 2)
				<td  align="right"><p class="pull-right">-{{number_format ($detalle->monto,2)}}</p></td>
			@else
				<td  align="right"><p class="pull-right">{{number_format ($detalle->monto,2)}}</p></td>
			@endif
		</tr>		
		@endforeach
		<tr>
			<td></td>
			<td  align="right">Total</td>
			<td  align="right">{{number_format ($total,2)}}</td>
		</tr>
	</tbody>
</table>					


			