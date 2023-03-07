@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Facturacion';
$submenu = 'Facturarcion Mensual DS';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">

		<!-- PAGE CONTENT BEGINS -->
		
		
<br>
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary" >
				<div class="panel-heading">
					<h5>Generación de Facturas Sobre Desechos Solidos</h5>
				</div>
					<div class="panel-body">
						<div class="row">
							@if (Session::has('transaccion'))
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									{{ Session::get('transaccion') }}
								</div>
							@endif
						</div>
						@if(Auth::user()->idperfil == 1 || Auth::user()->idperfil== 2)
							<div class="row">
								<div class="col-xs-12">						
												<form action="{{ route('generarfacturas')}}" method="post">
													<div class="row">
														<div class="col-sm-12">
															<center>
															
																<label for="form-field-mask-2">
																	Seleccione el Tipo de Facturación
																</label>
																<div class="input-group">
															
																	<select class="idtipofactura" id="idtipofactura" name ='idtipofactura' required>

																		<option value="0" disabled="true" selected="true">- Seleccione el Tipo de facturacion -</option>
																		@foreach($tipofacturacion as $tipofactura)
																			<option value="{{$tipofactura->id}}">{{$tipofactura->tipofactura}}</option>
																		@endforeach
																	</select>
																</div>
																</center>
														</div>
													</div><br>
													<div class="row">
														<div class="form-actns center">
															<button type="sumit" class="btn btn-sm btn-success">
																Continuar
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
														</div>
													</div>
												</form>
											
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-xs-8" style="float:none !important; margin: 0 auto">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>
								Facturación de desechos sólidos
						</h5>
					</div>
					<div class="panel-body">
					@if(isset($facturados))
						<div class="row">
							<div class="col-xs-12">
								<table id="simple-tabl" class="table table-striped table-hover">
									<thead>
										<tr >
											<th>Mes Facturados</th>
											<th>Tipo Facturación</th>
											<th>Número de Facturas</th>
											<th>Total Deuda Morosa</th>
											<th>Total del Mes</th>
											<th>Total  Facturado</th>
										
										</tr>
									</thead>
															
									<tbody>
										<tr>
										@foreach ($facturados as $value)
											<td>
												<a href="/main/facturacion/sectorfacturas/{{$value->idperiodomensual}}/{{ $value->idtipofactura }}">{{$value->periodomensual->descripcion}}
												</a>
											</td>
											<td>{{$value->tipofactura->tipofactura}}</td>
											<td>{{$value->nrofacturas}}</td>
											<td><p class="pull-right">
												{{number_format($value->deudamorosa,2)}}
												</p>
											</td>
											<td><p class="pull-right">
												{{number_format($value->montomes,2)}}
												</p>
											</td>
											<td><p class="pull-right">
												{{number_format($value->deudamorosa + $value->montomes,2)}}
												</p>
											</td>

										</tr>		
										@endforeach
									</tbody>
								</table>
							</div>			
						</div>
					@endif
					</div>
				</div>
			</div>		
	</div>
 
@endsection
