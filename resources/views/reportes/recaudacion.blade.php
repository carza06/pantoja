@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Reportes';
$submenu = 'Recaudacion';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
			<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary" >
				<div class="panel-heading">
					<h5>Reporte de Recaudación</h5>
				</div>
					<div class="panel-body">
					<div class="row">
					@if (Session::has('transaccion'))
					    <div class="alert alert-success">
						    <button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
					        {{ Session::get('transaccion') }}
					    </div>
					@endif
							<div class="col-xs-12">
								<table id="simple-table" class="table table-striped  table-hover">
									<thead>
										<tr>
											<th>Tributos</th>
											<th>Recaudado RD$</th>

										</tr>
									</thead>
															
									<tbody>
										<tr>
										@php ($total = 0)
										@foreach ($reporte as $key => $value)
											<td>{{$key}}</td>
											<td><p class="pull-right">{{number_format ($value,2)}}</p></td>
											@php ($total += $value)
										</tr>		
										@endforeach
											<td><p class="pull-right">Total</td>
											<td><p class="pull-right">{{number_format ($total,2)}}</p></td>
									</tbody>
								</table>

						
							</div>
						</div>
					</div>
				</div>
			</div>

    </div>
 
@endsection