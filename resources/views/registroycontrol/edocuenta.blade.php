@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'Anular Movimiento Estado de Cuentas';
$route1 = 'seleccionaredo';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		
			<!-- PAGE CONTENT BEGINS -->

		@if(Session::has('busqueda'))
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>

					<strong>
						<i class="ace-icon fa fa-times"></i><font><font>
						¡!
					</font></font></strong><font><font>
						{{Session::get('busqueda')}}
						@php(Session::forget('busqueda'))
					</font></font><br>
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-xs-12">
				@include('core.busquedaxtributo')
			</div>		
		</div>
		<hr>

		<div class="row">
			<div class="col-xs-12">
			@if(isset($sp))
				@include('tributos.infosp')
			@endif
			</div>
		</div>
		@if(isset($edo))
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
				<h5>
					Detalle Estado de cuenta
						</h5>
				</div>
				<div class="panel-body">
				<table id="simple-table" class="table table-striped  table-hover">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Descripcion</th>
											<th>Monto RD$</th>
											<th>Anular</th>
										</tr>
									</thead>
															
									<tbody>
										<tr>
										@foreach ($edo as $detalle)

											<td>{{$detalle->fecha}}</td>
											<td>{{$detalle->descripcion}}</td>
											@if($detalle->idtipomovimientoedo == 2)
												<td><p class="pull-right">-{{number_format ($detalle->monto,2)}}</p></td>
											@else
												<td><p class="pull-right">{{number_format ($detalle->monto,2)}}</p></td>
											@endif
											<td>
												<button type="button" class="btn btn-xs btn-danger" data-toggle="modal"  data-target="#anularmovimiento" data-whatever= "{{ $detalle->id }}">
										<i class="ace-icon fa fa-ban bigger-120"></i>
									</button>
											</td>
										</tr>		
										@endforeach
									</tbody>
								</table>	
				</div>
			</div>
		</div> 
	
		@endif
<!-- Modal cambiar password-->
<div class="modal fade" id="anularmovimiento" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4><span class="fa fa-ban"></span> Anular Movimiento de Estado de Cuentas</h4>
			</div>
			<div class="modal-body" style="padding:10px 10px;">
				<form role="form" action="{{route('anularmovedo')}}" method="post">
					<input type="hidden" name ="id" id="id">
					<label for="descripcion">Descripcion de la anulación:</label>
					<textarea rows="4" cols="78" id="descripcion" name='descripcion' required></textarea>
				<br><br><br>
				<center>
				    <div class="modal-footr">
						<button type="button" style="border-radius: 3px;" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" style="border-radius: 3px;" class="btn btn-primary">Anular Movimiento</button>
					</div>
				</center>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
$('#anularmovimiento').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-body #id').val(recipient)
})
</script>
@endsection