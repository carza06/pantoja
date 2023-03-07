@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Listado de Tramites';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<div class="col-xs-12" style="float:none !important; margin: 0 auto; margin-top:30px">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<h4>
							<i class="fa fa-check-square-o"></i>
							Tramites
							<div class="pull-right">
							{{$tramites->total()}} tramites</i>
							</div>
					</h4>
					</div>
					<div class="panel-body">
					<div class="row" style="margin-top: 20px;">
			<div class="col-xs-10">
				<div>
					@if (Session::has('transaccion'))
					    <div class="alert alert-success">
						    <button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
					        {{ Session::get('transaccion') }}
					    </div>
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table id="simple-table" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>id</th>
							
							<th>Fecha</th>
							<th>Tramite</th>
							<th>Sujeto Pasivo</th>
							<th>Tributos</th>
							<th></th>
						</tr>
					</thead>
											
					<tbody>
						<tr>
						@foreach ($tramites as $tramite)
							<td>{{$tramite->id}}</td>
							
							<td>{{$tramite->fechasolicitud}}</td>
							<td>{{$tramite->tiporamite->tramite}}</td>
							<td>{{$tramite->sujetopasivo->nombre_razonsocial}}</td>
							<td>
								@foreach ($tramite->tributos as $tributo)
								<a href="/main/estadodecuenta/{{$tributo->id}}">
								{{$tributo->hi->abreviaturahechoimponible}}| IdTributo: {{$tributo->id}}</br></a>
								@endforeach
							</td>
							<td>
								<div class="hidden-sm btn-group">
									<button class="btn btn-xs btn-primary">
										<i class="ace-icon fa fa-print bigger-120"></i>
									</button>
									<button class="btn btn-xs btn-warning">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-ban bigger-120"></i>
									</button>
								</div>
							</td>
						</tr>		
						@endforeach
					</tbody>
				</table>

				{!! $tramites->render()!!}
			</div>
		</div>
					</div>
				</div>
		</div>
			<!-- PAGE CONTENT BEGINS -->
	
    </div>
@endsection



