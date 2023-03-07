<!-- <div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h5 class="widget-title smaller">Detalle Estado de cuenta </h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Descripcion</th>
									<th>Monto RD$</th>
								</tr>
							</thead>
													
							<tbody>
								<tr>
								@foreach ($edo as $detalle)
									@php 
									$total+=$detalle->montoremanente;
									@endphp
									<td>{{$detalle->fecha}}</td>
									<td>{{$detalle->descripcion}}</td>
									@if($detalle->idtipomovimientoedo == 2 || $detalle->idtipomovimientoedo == 7 || $detalle->idtipomovimientoedo == 8  )
										<td><p class="pull-right">-{{number_format ($detalle->monto,2)}}</p></td>
									@else
										<td><p class="pull-right">{{number_format ($detalle->monto,2)}}</p></td>
									@endif
								</tr>		
								@endforeach
								<tr>
									<td></td>
									<td><p class="pull-right">Total</p></td>
									<td><p class="pull-right">{{number_format ($total,2)}}</p></td>
								</tr>
							</tbody>
						</table>					
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="space-12"></div>
		<div class="btn-group btn-corner pull-right">
			<button class="btn btn-info"><i class="fa fa-print"></i></button>
			@if(isset($ds))
			<a href="{{ route('imprimirfactura',[$idtributo])}}" target="_blank"  class="btn btn-info"><i class="fa fa-file-text"></i></a>
			@endif
			@if(isset($pub))
			<a href="{{ route('imprimirfacturapub',[$idtributo])}}" target="_blank"  class="btn btn-info"><i class="fa fa-file-text"></i></a>
			@endif
			<button class="btn btn-info"><i class="fa fa-envelope-o"></i></button>
			<button class="btn btn-info">Metodos de pagos</button>
			@if($total > 0)
			<button class="btn btn-success" data-toggle="modal" data-target="#efectivo" data-toggle="tooltip" data-placement="top" title="Efectivo"><i class="fa fa-money"></i></button>
			<button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tarjeta"><i class="fa fa-credit-card"></i></button>
			<button class="btn btn-success" data-toggle="modal" data-target="#cheque" data-toggle="tooltip" data-placement="top" title="Cheque"><i class="fa fa-sticky-note-o"></i></button>
			<button class="btn btn-success" data-toggle="modal" data-target="#transferencia" data-toggle="tooltip" data-placement="top" title="Transferencias"><i class="fa fa-exchange"></i></button>
			@endif
		</div>
	</div>
</div>	 -->
<div class="col-xs-12" style="float:none !important; margin: 0 auto">
<div class="panel panel-primary" >
  <div class="panel-heading">
  	<h5 class="widget-title smaller">Detalle Estado de cuenta</h5>
  </div>
  <div class="panel-body">
  <div class="row">
	<div class="col-xs-12">
		<div class="space-12"></div>
		<div class="btn-group btn-corner pull-right">
			<a href="/main/estadodecuenta/{{$idtributo}}/imprimir" target="_blank" class="btn btn-info"><i class="fa fa-print"></i></a>
			@if(isset($ds))
			<a href="{{ route('imprimirfactura',[$idtributo])}}" target="_blank"  class="btn btn-info"><i class="fa fa-file-text"></i></a>
			@endif
			@if(isset($pub))
			<a href="{{ route('imprimirfacturapub',[$idtributo])}}" target="_blank"  class="btn btn-info"><i class="fa fa-file-text"></i></a>
			@endif
			<button class="btn btn-info"><i class="fa fa-envelope-o"></i></button>
			<button class="btn btn-info">Metodos de pagos</button>
			@if($total > 0)
			<button class="btn btn-success" data-toggle="modal" data-target="#efectivo" data-toggle="tooltip" data-placement="top" title="Efectivo"><i class="fa fa-money"></i></button>
			<button class="btn btn-success" data-toggle="modal" data-target="#tarjetas" data-toggle="tooltip" ata-placement="top" title="Tarjeta"><i class="fa fa-credit-card"></i></button>
			<button class="btn btn-success" data-toggle="modal" data-target="#cheque" data-toggle="tooltip" data-placement="top" title="Cheque"><i class="fa fa-sticky-note-o"></i></button>
			<button class="btn btn-success" data-toggle="modal" data-target="#transferencia" data-toggle="tooltip" data-placement="top" title="Transferencias"><i class="fa fa-exchange"></i></button>
			@endif
		</div>
	</div>
</div>	 <br>
  <div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table table-striped table-hover table-hover">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Descripcion</th>
									<th>Monto RD$</th>
								</tr>
							</thead>
													
							<tbody>
								<tr>
								@foreach ($edo as $detalle)
									@php 
									$total+=$detalle->montoremanente;
									@endphp
									<td>{{$detalle->fecha}}</td>
									<td>{{$detalle->descripcion}}</td>
									@if($detalle->idtipomovimientoedo == 2 || $detalle->idtipomovimientoedo == 7 || $detalle->idtipomovimientoedo == 8  )
										<td><p class="pull-right">-{{number_format ($detalle->monto,2)}}</p></td>
									@else
										<td><p class="pull-right">{{number_format ($detalle->monto,2)}}</p></td>
									@endif
								</tr>		
								@endforeach
								<tr>
									<td></td>
									<td><p class="pull-right">Total</p></td>
									<td><p class="pull-right">{{number_format ($total,2)}}</p></td>
								</tr>
							</tbody>
						</table>					
					</div>
				</div>
  </div>
</div>
</div>

