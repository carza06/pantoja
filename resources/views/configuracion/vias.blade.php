@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Vias';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
    		<div class="page-header">
				<h1>
					VIAS
					<small>
						<i class="ace-icon fa fa-angle-double-right"> Existen {{$vias->total()}} Vias registradas</i>						
					</small>
				</h1>
			</div><!-- /.page-header -->
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
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
						<table id="simple-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Nombre</th>
									<th>Tipo de Via</th>
									
									<th>Sector</th>
									<th></th>
								</tr>
							</thead>
													
							<tbody>
								<tr>
								@foreach ($vias as $via)
									<td>{{$via->id}}</td>
									<td>{{$via->nombre}}</td>

									<td>{{$via->tipovia->tipovia}}</td>
									
									<td>
										@foreach ($via->barrio as $barrio)
											{{$barrio->barrio}}
										@endforeach
									</td>
									<td>
										<div class="hidden-sm btn-group">
											<button class="btn btn-xs btn-info">
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
						<div>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar via</button>
						</div>
						{!! $vias->render()!!}
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
          <h4><span class="glyphicon glyphicon-lock"></span> Ingrese la nueva via</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="{{route('guardarvia')}}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
            	<label for="usrname">Nombre</label>
              	<input type="text" class="form-control" id="lugar" name="via" placeholder="Nombre del via" required>
            </div>

            <div class="form-group">
	        	<label for="idtipovia">Tipo del via</label>
	          	<select class="form-control" name="idtipovia" required>
					@foreach ($tipovias as $tipovia)
	          		<option value="{{$tipovia->id}}">{{$tipovia->tipovia}} </option>
					@endforeach
	          	</select>
            </div>
            
            <div class="form-group">
              <label for="idtipoclavia">Clasificacion de la via</label>
              <select class="form-control" name="idtipoclavia" required>
					@foreach ($tipoclavia as $clavia)
              		<option value="{{$clavia->id}}">{{$clavia->tipoclasificacion}} </option>
					@endforeach
              </select>
            </div>
            <div class="row">
            	@foreach ($barrios as $barrio)
            	<div class="col-xs-4">
		            <div class="form-group">
		          		<input  id="idbarrio" type="checkbox" name="idbarrio[]" value="{{$barrio->id}}">{{$barrio->barrio}}
		            </div>
		        </div>
	            @endforeach
	        <div>
          
              <button type="submit" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              <button type="submit" class="btn btn-success btn-sm pull-rigth"><span class="glyphicon glyphicon-save"></span> Guardar</button>
          </form>
        </div>

      
    </div>
  </div> 
</div>
@endsection