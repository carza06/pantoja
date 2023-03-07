@extends('core.main')
@section('submenu')
@parent
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<br>
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>
						Requisitos
					</h5>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
							<div class="row">
								@if (Session::has('message'));
									<div class="alert alert-success">
										{{ Session::get('message') }}
									</div>
								@endif
									
								<div class="col-xs-12">
									<div align="right">
										<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Nuevo Requisito</button>
									</div>
									<br>
									<table id="simple-table" class="table table-striped  table-hover">
										<thead>
											<tr>
												<th>id</th>
												<th>Status</th>
												<th>Nombre</th>
												<th>Cargada por</th>
												<!-- <th></th> -->
											</tr>
										</thead>
																
										<tbody>
											<tr>
											@foreach ($requisitos as $requisito)
												<td>{{$requisito->id}}</td>
												<td>{{$requisito->estatus->nombre}}</td>
												<td>{{$requisito->requisito}}</td>
												<td>
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
										{!! $requisitos->render()!!}
									</center>
								</div>
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
          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Ingresar Nuevo Requisito</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="{{route('guardarreq')}}" method="post">
            {!! csrf_field() !!} 
            <div class="form-group">
              <label for="usrname">Nombre</label>
              <input type="text" class="form-control" id="lugar" name="requisito" placeholder="Nombre del requisito" required>
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