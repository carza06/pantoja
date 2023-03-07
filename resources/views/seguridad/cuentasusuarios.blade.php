@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Seguridad';
$submenu = 'Cuentas de Usuarios';
?>
@stop
@section('contenido')
  @parent
  <br>
    <div class="page-content">
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<h5>
					Cuentas de Usuarios
				</h5>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="clearfix">
						@if(Session::has('mensaje'))
						<div class="pull-left alert alert-success no-margin alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							{{ Session::get('mensaje') }}
						</div>
						@endif
						<div class="row col-xs-12" style="margin-left: 1px;">
							<div class="pull-left">
							<form class="form-search" action="{{route('cuentasusuarios')}}" method="GET">
								<select class="form-control" id="form-field-select-1" name = "idperfil" onchange='this.form.submit()'>
									<option value="">Filtrar por perfil</option>
									<option value="0">Todos</option>
									@foreach ($perfiles as $var)
										<option value="{{$var->id}}">{{$var->nombre}}</option>
									@endforeach
								</select>
								<noscript><input type="submit" value="Submit"></noscript>
							</form>
							</div>
							<div class="pull-right">
								<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target=".myModal">Agregar Usuario</button>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Perfil</th>
									<th>Usuario</th>									
									<th>Nombre</th>
									<th></th>
								</tr>
							</thead>
													
							<tbody>
								<tr>
								@foreach ($usuarios as $u)
									<td>{{$u->id}}</td>
									<td>{{$u->perfiles->nombre}}</td>
									<td>{{$u->usuario}}</td>
									<td>{{$u->nombre}}</td>
									<td>
										<div class="hidden-sm btn-group">
											<!-- <button class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-pencil bigger-120"></i>
											</button>
											<button class="btn btn-xs btn-danger">
												<i class="ace-icon fa fa-ban bigger-120"></i>
											</button> -->
											<button type="button" class="btn btn-xs btn-inverse" data-toggle="modal"  data-target="#setpassword" data-whatever= "{{ $u->id }}">
												<i class="ace-icon fa fa-key bigger-120"></i>
											</button>
				
										</div>
									</td>
								</tr>		
								@endforeach
								<!-- Modal cambiar password-->
								<div class="modal fade" id="setpassword" tabindex="-1" role="dialog">
									<div class="modal-dialog">
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;
												</button>
												<h4><span class="fa fa-key"></span> Cambiar Contraseña</h4>
											</div>
											<div class="modal-body" style="padding:10px 10px;">
												<form role="form" action="{{route('actualizarpassword')}}" method="post">
													<input type="hidden" name ="id" id="id">														
													<label> Nueva Contraseña </label><br>
													<input style="width: 50%;" id="password" name='password' placeholder="Nueva Contraseña"  type="password" min="8" required></li><br>
													<font><b>*la clave debe contener minimo 8 caracteres*</b></font><br><br>
											
													<div align="center">
														<button style="border-radius: 3px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button style="border-radius: 3px;" type="submit" class="btn btn-primary">Cambiar</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</tbody>
						</table>
						<center></center>
						{!! $usuarios->render()!!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 

 	<!-- Modal -->
  	<div class="modal fade myModal" tabindex="-1" role="dialog">
    	<div class="modal-dialog">
      	<!-- Modal content-->
      	<div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Usuario</h4>
	        </div>
        	<div class="modal-body" style="padding:10px 10px;">
          		<form role="form" action="{{route('nuevousuario')}}" method="post">
		            {!! csrf_field() !!}
		           
		            <div class="form-group">
						
						  <label class="radio-inline"><input type="radio" name="tipoavatar" value="Masculino" required>Masculino</label>
						  <label class="radio-inline"><input type="radio" name="tipoavatar" value="Femenino"  required>Femenino</label>
						
					</div>
		        
					
					<div class="row">
			            <div class="col-xs-6">
			            	<div class="form-group">
				              <label for="usrname">Nombre</label>
				              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
				            </div>
				        </div>
				         <div class="col-xs-6">
					        <div class="form-group">
				              <label for="usrname">Usuario</label>
				              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
				            </div>
				        </div>
				    </div>
				    <div class="row">
				    	<div class="col-xs-6">
				    		<div class="form-group">
				              <label for="email">Email</label>
				              <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
				            </div>
				        </div>
				        <div class="col-xs-6">
				            <div class="form-group">
							<label for="codigo">Codigo</label>
				              <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo">
				            </div>
				        </div>
				    </div>
					
					<div class="form-group">
		              <label for="idperfil">Perfil de Usuario</label>
		              <select class="form-control" id="idperfil" name="idperfil" required>
							@foreach ($perfiles as $perfil)
		              		<option value="{{$perfil->id}}">{{$perfil->nombre}}</option>
							@endforeach
		              </select>
		            </div>
					<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
						<label for="">Archivo</label>
						<input type="file" name="avatar">
						
						</div> 
					</div></div>
				    <div class="hr dotted"></div>
				    <div class="row">
				    	<div class="col-xs-6">
				    		<div class="form-group">
				    			<label>Acciones especiales</label>
				    		</div>
				    	</div>
				    </div>
				    <div class="row">
					    @foreach ($acciones as $accion)
					    <div class="col-xs-4">
				            <div class="form-group">
				          		<input  id="idaccion" type="checkbox" name="idaccion[]" value="{{$accion->id}}">{{$accion->descripcion}}				
				            </div> 
				        </div>
				        @endforeach
			        </div>
			        <div class="hr dotted"></div>
			        <div class="row">
			        	<div class="clearfix">
			        		<div class="col-xs-12">
								<center>
			        	   	<div>
								<button type="submit" style="border-radius: 3px;" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancelar</button>
								<button type="submit" style="border-radius: 3px;" class="btn btn-success btn-sm"> Guardar</button>
							</div>
							</center>
							</div>
						</div>
		            </div>
		    	</form>
        	</div>
		</div>
  	</div> 

 		
@endsection
@section('scripts')
<script>
$('#setpassword').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-body #id').val(recipient)
})
</script>
@append