@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'Registro de Contribuyentes';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">  
	
		
		<!-- PAGE CONTENT BEGINS -->
		@if(Session::has('transaccion'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>

			<strong>
				<i class="ace-icon fa fa-times"></i><font><font>
				¡Ups!
			</font></font></strong><font><font>
				{{Session::get('transaccion')}}
			
			</font></font><br>
		</div>
		@endif

		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>
						Registro de Arbitrios
					</h5>
				</div>
				<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- @foreach ($registro as $reg)
							@if(!is_null($reg->route))
								<div style="margin-top: 10px;">
								<button type="button" style="border-radius: 10px;" class="btn btn-primary">
									<a style="color: black;" href="../registro/{{ $reg->route }}/{{ $reg->id }}">{{$reg->tiporegistro}}</a>
								</button>
								</div>
							@endif
						@endforeach -->

						<div class="col-xs-12">
									
									<table id="simple-table" class="table table-striped  table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Tipo de Registro</th>
											</tr>
										</thead>
																
										<tbody>
											@php 
											$i=1
											@endphp
											@foreach ($registro as $reg)
												@if(!is_null($reg->route))
												<tr>
													<td>{{$i}}</td>
												<td>
												<a style="color: black;" href="../registro/{{ $reg->route }}/{{ $reg->id }}">{{$reg->tiporegistro}}</a>
												</td>
												</tr>
												@php
												$i++
												@endphp
												@endif
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
@endsection

