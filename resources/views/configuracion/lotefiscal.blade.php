@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Lote Fiscal';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
			<br>
			<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>
							Lote Fiscal
						</h5>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								@if (Session::has('transaccion'))
									<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>
										{{ Session::get('transaccion') }}
									</div>
								@endif
								<div class="col-xs-12">
									<div align="right">
										<button type="button" style="border-radius: 3px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar Lote</button>
									</div><br>
									<table id="simple-table" class="table table-striped table-hover">
										<thead>
											<tr>
												<th>id</th>
												<th>Desde</th>
												<th>Hasta</th>
												<th>Asignadas</th>
												<th>Disponibles</th>
											</tr>
										</thead>
																
										<tbody>
											
											@foreach ($lotes as $lote)
											<tr>
												@php
													$total =  $lote->Lote()->where('idlotefiscal',$lote->id)->count();
													$asignadas = $lote->Lote()->where('idlotefiscal',$lote->id)->where('asignado',1)->count();
													$disponibles = $total - $asignadas; 
												@endphp
												<td>{{$lote->id}}</td>
												<td>{{$lote->loteinicial}}</td>
												<td>{{$lote->lotefinal}}</td>
												<td>{{$asignadas }}</td>
												<td>{{$disponibles}}</td>
											</tr>		
											@endforeach
										</tbody>
									</table>									
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
          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Lote de Valor Fiscal</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="{{route('guardarlote')}}" method="post">
            {!! csrf_field() !!}
             <div class="form-group">
              <label for="usrname">Clasificacion del sector</label>
              <select name="idtipolote" required style="width: 100%;">
					@foreach ($tipolote as $tl)
              		<option value="{{$tl->id}}">{{$tl->tipolote}}</option>
					@endforeach
              </select>
            </div>  
            <div class="form-group">
              <label for="tasa">Base del Lote</label>
              <input type="text" class="form-control" id="base" name="base" placeholder="Base del Lote" required>
            </div>
            <div class="form-group">
              <label for="tasa">Generar desde numeración</label>
              <input type="text" class="form-control" id="desde" name="desde" placeholder="Inicio de Numeración" required>
            </div>
             <div class="form-group">
              <label for="tasa">Generar hasta numeración</label>
              <input type="text" class="form-control" id="hasta" name="hasta" placeholder="Fin de Numeración" required>
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
