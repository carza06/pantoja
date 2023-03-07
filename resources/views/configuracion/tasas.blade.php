@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Tasas';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
			
				<!-- PAGE CONTENT BEGINS -->
			
<br>
			<div class="col-xs-10" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>
							Tramites
						</h5>
					</div>
					<div class="panel-body">
					<div class="row">
						<div class="col-xs-12">
							@if (Session::has('message'));
								<div class="alert alert-success">
									{{ Session::get('message') }}
								</div>
							@endif
							<div class="col-xs-12">
								<div align="right">
									<button type="button" style="border-radius: 3px" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar Tasas</button>
								</div><br>
								<table id="simple-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>id</th>
											<th>Status</th>
											<th>Nro Cuenta</th>
											<th>Nombre</th>
											<th>Monto</th>
											<th>Metraje</th>
											<th>Cargado por</th>
											<!-- <th width="10%">Acciones</th> -->
										</tr>
									</thead>
															
									<tbody>
										<tr>
										@foreach ($tasas as $tasa)
											<td>{{$tasa->id}}</td>
											<td>{{$tasa->estatus->nombre}}</td>
											<td>{{$tasa->cuenta->codigo}}</td>
											<td>{{$tasa->tasa}}</td>
											<td>{{$tasa->monto}}</td>
											<td>@if ($tasa->monto == 1)
													Si
												@else
													No
												@endif
											</td>
											<td></td>
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
									{!! $tasas->render()!!}
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
          <h4><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Tasa</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="{{route('guardartasa')}}" method="post">
            {!! csrf_field() !!}
             <div class="form-group">
              <label for="tipotasas">Tipo de Tasa</label><br>
              <select name="idtipotasa" required style="width: 100%;">
					@foreach ($tipotasas as $tipo)
              		<option value="{{$tipo->id}}">{{$tipo->tipotasa}} </option>
					@endforeach
              </select>
            </div>
             <div class="form-group">
              <label for="idcuenta">Catalogo de Cuenta</label>
              <select name="idcuenta" required style="width: 100%;">
					@foreach ($cuentas as $cuenta)
              		<option value="{{$cuenta->id}}">{{$cuenta->codigo}} - {{$cuenta->descripcion}}</option>
					@endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="tasa">Tasa</label>
              <input type="text" class="form-control" id="tasa" name="tasa" placeholder="Nombre de la tasa" required>
            </div>
            <div class="form-group">
              <label for="tasa">Monto</label>
              <input type="text" class="form-control" id="monto" name="monto" placeholder="monto" required>
            </div>
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input name="metraje" class="ace ace-checkbox-2" type="checkbox">
						<span class="lbl"> Requiere Clasificacion por Metraje</span>
					</label>
				</div>
			</div>  
        
			<div>
				<label for="form-field-mask-1">
					Vigente Desde
				
				</label>

				<div class="input-group">
					<span class="input-group-addon center">
							<i class="ace-icon fa fa-calendar bigger-110"></i>
					</span>
					<input type='text' class="input-append date" id='datepicker' style="width: 100%;" name="vigentedesde" required>
				</div>
			</div><br>
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
@section('scripts')
<script type="text/javascript">
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'yy-mm-dd',
		 changeYear: true,
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
	 };
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$(function () {
		$("#datepicker").datepicker();
	});

</script>
@stop