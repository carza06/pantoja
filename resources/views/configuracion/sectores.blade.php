@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Sectores';
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
							Sectores
						</h6>
					</div>
					<div class="panel-body">
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
									<div align="right">
										<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar Sector</button>
									</div><br>
									<table id="simple-table" class="table table-striped table-hover">
										<thead>
											<tr>
												<th>id</th>
												<th>Codigo</th>
												<th>Sector</th>
												<th>Cargado por</th>
												<!-- <th>Acciones</th> -->
											</tr>
										</thead>
																
										<tbody>
											<tr>
											@foreach ($sectores as $sector)
												<td>{{$sector->id}}</td>
												<td>
													{{$sector->codcatastro}}
													
												</td>

												<td>{{$sector->sector}}</td>
												<td>
												</td>
												<!-- <td width="10%">
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
										{!! $sectores->render()!!}
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
          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Sector</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="{{route('guardarsector')}}" method="post">
            {!! csrf_field() !!} 
             <div class="form-group">
              <label for="usrname">Clasificacion del sector</label>
              <select name="idtiposector" required>
					@foreach ($tiposectores as $tiposector)
              		<option value="{{$tiposector->id}}">{{$tiposector->tipo}} {{$tiposector->descripcion }}</option>
					@endforeach
              </select>
            </div>          
            <div class="form-group">
              <label for="usrname">Nombre</label>
              <input type="text" class="form-control" id="lugar" name="sector" placeholder="Nombre del sector" required>
            </div>
            <div class="form-group">
              <label for="usrname">Codigo Catastral</label>
              <input type="text" class="form-control" id="lugar" name="codcatastro" placeholder="Codigo catastral del sector" required>
            </div> 
			  <center>         
              <button type="submit" style="border-radius: 3px;" class="btn btn-danger btn-sm pull-center" data-dismiss="modal"> Cancelar </button>
              <button type="submit" style="border-radius: 3px;" class="btn btn-success btn-sm pull-center"> Guardar</button>
			  </center>  
			</form>
        </div>

      
    </div>
  </div> 
</div>
@endsection