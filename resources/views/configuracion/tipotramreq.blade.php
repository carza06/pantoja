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
						Asociar Requisitos 
					</h5>
				</div>
				<div class="panel-body">
					<form role="form" action="{{route('asociartrareq')}}" method="post">
						<input type="hidden" name="idtipotramite" value="{{ $tipotramite['id'] }}">
							@foreach ($requisitos as $requisito)
							<div class="col-xs-4">
								
										<div class="col-xs-12">
											<input  type="checkbox" name="idrequisito[]" value="{{$requisito->id}}"> {{$requisito->requisito}}
										</div>
										<div class="col-xs-5">
											<input  type="checkbox" name="requerido[{{ $requisito->id }}]"> Obligatorio 
										</div>
									
							</div>
							@endforeach
							<div class="col-xs-12">
								<div class="form-acti center">
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