@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Barrios';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<br>
		<div class="col-xs-10" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>
						Barrios
					</h5>
				</div>
				<div class="panel-body">
					<div class="col-xs-12">
						<div class="row">
							@if (Session::has('mensaje'))
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									{{ Session::get('mensaje') }}
								</div>
							@endif
							<div class="col-xs-12">
								<div align="right">
									<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar barrio</button>
								</div><br>
								<table id="simple-table" class="table table-striped table-hover">
									<thead>
										<tr>
											<th widht="10%">id</th>
											<th width="20%">Nombre</th>
											<th width="70%">Sector</th>
											<!-- <th>Acciones</th> -->
										</tr>
									</thead>
															
									<tbody>
										<tr>
										@foreach ($barrios as $barrio)
											<td>{{$barrio->id}}</td>
											<td>{{$barrio->barrio}}</td>

																				
											<td>
												@foreach ($barrio->sector as $sector)
													{{$sector->sector}}
												@endforeach
											</td>
											<!-- <td>
												<div class="hidden-sm btn-group">
													<button class="btn btn-xs btn-info">
														<i class="ace-icon fa fa-pencil bigger-120"></i>
													</button>
													<button class="btn btn-xs btn-danger">
														<i class="ace-icon fa fa-ban bigger-120"></i>
													</button>
												</div>
											</td> -->
										</tr>		
										@endforeach
									</tbody>
								</table>
								<center>
								{!! $barrios->render()!!}
								</center>
							</div>
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
          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Barrio</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="{{route('guardarbarrio')}}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
            	<label for="usrname">Nombre</label>
              	<input type="text" class="form-control" id="lugar" name="barrio" placeholder="Nombre del Barrio" required>
            </div>

            <div class="row">
			<div><label for="form-group" style="margin-left: 3%;"><B>SECTORES:</B></label><br></div>
            @foreach ($sectores as $sector)
            <div class="col-xs-4">
				
	            <div class="form-group">
	            					
	          		<input  id="idsector" type="checkbox" name="idsector[]" value="{{$sector->id}}">{{$sector->sector}}
					
	            </div>
	        </div>
          	@endforeach
          	</div>
			<center>
              <button type="submit" style="border-radius: 3px;" class="btn btn-danger btn-sm pull-center" data-dismiss="modal"> Cancelar</button>
              <button type="submit" style="border-radius: 3px;" class="btn btn-success btn-sm pull-center"> Guardar</button>
			</center>
		</form>
        </div>

      
    </div>
  </div> 
</div>
@endsection