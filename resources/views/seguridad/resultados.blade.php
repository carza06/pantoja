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
		<div class="page-header">
			<h1>
				Migracion
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>						
				</small>
			</h1>
		</div><!-- /.page-header -->
		
			<!-- PAGE CONTENT BEGINS -->
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
			<div class="col-xs-10">
				<div>
					@if (isset($error))

							@for($i = 0; $i < count($error); $i++)
												    <div class="alert alert-success">
						    <button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
								{{$error[$i]}}
								</div>
							@endfor
					    
					@endif
				</div>
			</div>
		</div>		
		
    </div>
@endsection