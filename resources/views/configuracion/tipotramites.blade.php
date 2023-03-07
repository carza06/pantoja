@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'tramites';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
			
		<!-- PAGE CONTENT BEGINS -->
<br>
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary">
				<div class="panel-heading">
					<h6>
						Tramites
					</h6>
				</div>
				<div class="panel-body">
					<div class="row">
						@if (Session::has('mensaje'))
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>
								{{ Session::get('mensaje') }}
							</div>
						@endif
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div align="right">
								<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar tramite</button>
							</div><br>
							<table id="simple-table" class="table table-striped  table-hover">
								<thead>
									<tr>
										<th>id</th>
										<th>Nombre</th>
										<th>Hecho Imponible</th>
										<th width="20%">Acciones</th>
									</tr>
								</thead>
														
								<tbody>
									<tr>
									@foreach ($tramites as $tramite)
										<td>{{$tramite->id}}</td>
										<td>{{$tramite->tramite}}</td>
										<td>{{$tramite->hechoimponible->nombrehechoimponible}}</td>
										<td>
											<div class="hidden-sm btn-group">
												<!--Inactivar Tramite -->

												<a href="" class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-check-circle-o bigger-120"></i>
												</a>
												<!--Asociar Requisitos -->
												<a href="trareq/{{$tramite->id}}" class="btn btn-xs btn-danger">
													<i class="ace-icon fa fa-list-ol bigger-120"></i>
												</a>
												<!--Asociar Tasas -->
												<a href="tramtasas/{{$tramite->id}}" class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-money bigger-120"></i>
												</a>
												<!--Editar Tipo Tramite -->
												<!-- <a href="editartipotramite/{{$tramite->id}}" class="btn btn-xs btn-warning">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</a> -->
											</div>
										</td>
									</tr>		
									@endforeach
								</tbody>
							</table>
							<center>
								{!! $tramites->render()!!}
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Tramite</h4>
			</div>
			<div class="modal-body" style="padding:40px 50px;">
				<form role="form" action="{{route('guardartipotramite')}}" method="post">
				{!! csrf_field() !!}
					<div class="form-group">
						<label for="usrname">Nombre Tramite</label>
						<input type="text" class="form-control" id="lugar" name="tramite" placeholder="Nombre del Tramite" required>
					</div>
					<div class="form-group">
						<label for="idhechoimponible">Hecho Imponible</label>
						<select class="form-control" name="idhi" required>
						@foreach ($hi as $data)
							<option value="{{$data->id}}">{{$data->nombrehechoimponible}} </option>
						@endforeach
						</select>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-6">
							<div><input  type="checkbox" name="aprobacion"> Requiere Aprobacion</div>
							<div><input  type="checkbox" name="notificacionporemail"> Notificar por email</div>
						</div>
						<div class="col-xs-6">
							<div><input  type="checkbox" name="requieretributo"> Requiere tributo</div>
							<div><input  type="checkbox" name="generaedocuenta"> Genera Estado de Cuenta</div>						
						</div>
					</div>
					<hr>
				
					<div class="row">
						<div class="col-xs-6">
							<div><input  type="checkbox" name="generatributo"> Genera Tributo</div>
							<div><input  type="checkbox" name="generainm"> Genera Inmueble</div>
							<div><input  type="checkbox" name="generads"> Genera Desechos Solidos</div>
							<div><input  type="checkbox" name="generalae"> Genera Actividad Economica</div>
						</div>
						<div class="col-xs-6">
							<div><input  type="checkbox" name="generapub"> Genera Publicidad</div>
							<div><input  type="checkbox" name="generaal"> Genera Apuestas Licitas</div>
							<div><input  type="checkbox" name="generaep"> Genera Espectaculos Publicos</div>
						</div>
					</div>
					<hr>
					<center>
					<div class="row">
						<button type="submit" class="btn btn-danger btn-sm pull-center" data-dismiss="modal"> Cancelar </button>
						<button type="submit" class="btn btn-success btn-sm pull-center"> Guardar</button>						
					</div>
					</center>
				</form>
			</div>
		</div>
	</div> 
</div>
@endsection