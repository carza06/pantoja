@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Facturacion';
$submenu = 'Facturarcion Mensual DS';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<div class="page-header">
			<h1>
				Generar Facturacion de Desechos Solidos
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>						
				</small>
			</h1>
		</div><!-- /.page-header -->
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			@if (Session::has('transaccion'))
			    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>
			        {{ Session::get('transaccion') }}
			    </div>
			@endif
		</div>
		@if(isset($data))
		<div class="row">
			<div class="col-xs-10">
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Via</th>
							<th>Numero de Facturas</th>
							<th>Total Deuda Morosa</th>
							<th>Total del Mes</th>
							<th>Total  Facturado</th>
							
						</tr>
					</thead>
											
					<tbody>
						
					@for($i = 0; $i < count($data); $i++)
					<tr>
						<td><a href="/main/facturacion/facturas/{{$idperiodomensual }}/{{ $idtipofactura }}/{{ $idsector }}/{{ $idbarrio }}/{{$data[$i][0]}}">{{$data[$i][1]}}</a></td>
						<td>{{$data[$i][2]}}</td>
						<td><p class="pull-right">{{number_format($data[$i][3],2)}}<p></td>
						<td><p class="pull-right">{{number_format($data[$i][4],2)}}</p></td>
						<td><p class="pull-right">{{number_format($data[$i][3] + $data[$i][4],2)}}</p></td>
					</tr>		
						@endfor
					</tbody>
				</table>
			</div>			
		</div>
		@endif
		
		</div>			
	</div>
 
@endsection