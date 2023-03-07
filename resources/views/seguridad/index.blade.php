@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Seguridad';
$submenu = 'Migracion';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		
		
			<!-- PAGE CONTENT BEGINS -->

		
		
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>
						Seleccionar Sector a Migrar
					</h5>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-10">
							<div>
								@if (Session::has('transaccion'))
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>
										{{ Session::get('transaccion') }}
									</div>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div >
								
									<h4 >UBICACIÓN GEOGRAFICA</h4>
								
								<div class="widget-body">
									<div class="widget-main" >
										
										<form action="{{ route('migracion')}}" method="post">
											<div class="row">
												<div class="col-sm-12">
													<div>
														<label for="form-field-mask-2">
															Sectores
														</label>
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-puzzle-piece"></i>
															</span>
															<select class="sectores" id="idsector" name ='idsector' required>

																<option value="0" disabled="true" selected="true">- Seleccione el Sector -</option>
																@foreach($sectores as $sector)
																	<option value="{{$sector->id}}">{{$sector->sector}}</option>
																@endforeach
															</select>
														</div>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="form-actins center">
													<button type="sumit" class="btn btn-sm btn-success">
														Continuar
														<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
													</button>
												</div>
											</div>
										</form>
										
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>

    </div>
@endsection