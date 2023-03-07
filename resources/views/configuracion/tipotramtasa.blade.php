@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Configuración';
$submenu = 'Tramites';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">

	
		<div class="col-xs-12" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>
						Asociación de Tasas
					</h5>
				</div>
				<div class="panel-body">
				<form role="form" action="{{route('asociartramtasa')}}" method="post">
		<!-- PAGE CONTENT BEGINS -->
		<input type="hidden" name="idtipotramite" value="{{ $tipotramite['id'] }}">
			@foreach ($tasas as $tasa)
			<div class="col-xs-4">
				<div class="panel panel-default">
					<div class="panel-body">
		      			<div class="col-xs-7">
		      				<input  type="checkbox" name="idtasa[]" value="{{$tasa->id}}"> {{$tasa->tasa}}
		      			</div>
		      			<div class="col-xs-5">
		      				RD$ {{$tasa->monto}}
		      			</div>
		      		</div>
	      		</div>
	  		</div>
			@endforeach
			<div class="col-xs-12">
				<div class="form-actios center">
					<button type="sumit" class="btn btn-sm btn-success">
							Asociar
							<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</button>
				</div>
			</div>
		</form>
				</div>
			</div>
		</div>
    </div>
@endsection