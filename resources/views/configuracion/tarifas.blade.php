@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Tarifas';
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
							Tarifas de desechos solidos
						</h6>
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
										<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar Tarifa</button>
									</div><br>
									<table id="simple-table" class="table table-striped  table-hover">
										<thead>
											<tr>
												<th>id</th>
												<th>Codigo</th>
												<th>Monto</th>
												<!-- <th width="20%">Acciones</th> -->
											</tr>
										</thead>
																
										<tbody>
											<tr>
											@foreach ($tarifasds as $tarifas)
												<td>{{$tarifas->id}}</td>
												<td>{{$tarifas->codigo}}</td>
												<td>{{$tarifas->tarifa}}</td>
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
									{!! $tarifasds->render()!!}
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
          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Tarifa</h4>
        </div>
        <div class="modal-body" style="padding:10px 50px;">
          <form role="form" action="{{route('guardartarifa')}}" method="post">
            {!! csrf_field() !!}
		   
            <div class="form-group">
            	<label for="monto">Monto</label>
              	<input type="text" class="form-control" id="monto" name="monto" placeholder="Monto" required>
            </div>
			<div class="alert alert-info">
			    <button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
				Las tarifas son establecidas mediante la Ordenanza y por ningún motivo la empresa las puede establecer, continúe si está seguro, de lo contrario diríjase a un supervisor, tenga presente que su usuario queda registrado en esta transacción, usted será el único responsable de esta acción.		        
		    </div>
			  <center>
				<button type="submit" class="btn btn-danger btn-sm pull-center" data-dismiss="modal"> Cancelar</button>
				<button type="submit" class="btn btn-success btn-sm pull-center"> Guardar</button>
			  </center>
			</form>
        </div>
    </div>
  </div> 
</div>
@endsection