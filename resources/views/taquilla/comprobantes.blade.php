@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Taquilla';
$submenu = 'Comprobantes de Pagos';

$route ='resumen';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
<br>
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Comprobantes de pago
					</h6>
				</div>
				<div class="panel-body">
				<form class="form-search" action="{{ route('comprobantes') }}" method="POST">
						<div class="row">
							<div class="col-xs-12 col-sm-8">
								<div class="row">
									<div class="col-sm-12">
										<center>
										<label class="radio-inline"><input type="radio" name="search" value="1" checked>Id Control</label>
										<label class="radio-inline"><input type="radio" name="search" value="2">Cedula | RNC</label>
										</center>
									</div>
								</div><br>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-search"></i>
									</span>
									<input type="text" 
											class="form-control"
											name="cedularcn" 
											placeholder="Ingrese la Cedula" 
											required 
											pattern="[a-Z0-9]{4,15}"     						title="Tamaño mínimo: 4. Tamaño máximo: 11"
									/>
									<span class="input-group-btn">
										<button type="sumit" class="btn btn-success btn-sm">
											<span class="fa fa-search icon-on-right bigger-60"></span>
											Buscar
										</button>
									</span>
								</div>
							</div>
						</div>
					</form>
					@if(Session::has('busqueda'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<strong>
								<i class="ace-icon fa fa-times"></i><font><font>
								!
							</font></font></strong><font><font>
								{{Session::get('busqueda')}}
								@php(Session::forget('busqueda'))
							</font></font><br>
						</div>
					@endif
					@if(Session::has('busquedatasas'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<strong>
								<i class="ace-icon fa fa-times"></i><font><font>
								¡Ah!
							</font></font></strong><font><font>
								{{Session::get('busquedatasas')}}
							
							</font></font><br>
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@if(isset($sp))
					@include('tributos.infosp')
				@endif
			</div>
		</div>
		@if(isset($pagostributos))
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Comprobantes de Tributos
					</h6>
				</div>
				<div class="panel-body">
				<table id="simple-table" class="table table-sm table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Id Pago</th>
							<th>Cargado por</th>
							<th>Fecha</th>
							<th>Forma de Pago</th>							
							<th>Monto RD$</th>
							<th></th>
						</tr>
					</thead>
											
					<tbody>
						<tr>
						@php ($pp = 0)
						@foreach ($pagostributos as $tributos)
							<td>{{$tributos->id}}</td>
							<td>{{$tributos->usuario}}</td>
							<td>{{$tributos->fechapago}}</td>
							<td>{{$tributos->formapago}}</td>
							<td>{{number_format($tributos->monto,2)}}</td>
							<td>
								<div class="hidden-sm btn-group">
									<a href="comprobante/{{$tributos->id}}" target="_blank" class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</a>
									@if($anular == 1 && $pp == 0)
									<a href="anularpago/{{$tributos->id}}" class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-check-circle-o bigger-120"></i>
									</a>
									@endif
								</div>
							</td>
						</tr>
						@php ($pp++)		
						@endforeach
					</tbody>
				</table>
				</div>
			</div>
		</div>
		@endif
		@if(isset($pagostasas))
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						<i class="fa fa-check-square-o"></i>
						Comprobantes de Tasas
					</h6>
				</div>
				<div class="panel-body">
				<table id="simple-table" class="table table-sm table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Id Pago</th>
							<th>Cargado por</th>
							<th>Fecha</th>
							<th>Forma de Pago</th>							
							<th>Monto RD$</th>
							<th></th>
						</tr>
					</thead>
											
					<tbody>
						
						@foreach ($pagostasas as $tasas)
						<tr>
							<td>{{$tasas->id}}</td>
							<td>{{$tasas->usuario}}</td>
							<td>{{$tasas->fechapago}}</td>
							<td>{{$tasas->formapago}}</td>
							<td>{{number_format($tasas->monto,2)}}</td>
							<td>
								<div class="hidden-sm btn-group">
									<a href="comprobante/{{$tasas->id}}" target="_blank" class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</a>
									@if($anular == 1)
									<a href="anularpago/{{$tasas->id}}" class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-check-circle-o bigger-120"></i>
									</a>
									@endif
								</div>
							</td>
						</tr>		
						@endforeach
					</tbody>
				</table>
				</div>
			</div>
		</div>
		@endif
    </div>



@endsection

