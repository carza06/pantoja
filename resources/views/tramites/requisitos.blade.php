@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
$tramite = Session::get('TMT');
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<div class="page-header">
			<h1> 
				{{$tramite->tramite}}
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i> Requisitos						
				</small>
			</h1>
		</div><!-- /.page-header -->
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-10">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="widget-title">
							<i class="fa fa-check-square-o"></i>
							Seleccione los Requisitos
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<form action="{{ route('regrequisitos')}}" method="post">
							@foreach ($tramite->requisitos as $requisito)
								<!-- <legend>Form</legend> -->
								<fieldset>
									<label class="">
										<input
											type="checkbox" 
											name="idrequisito[]"
											value="{{$requisito->id}}"
											@php if($requisito->pivot->requerido == 1) echo 'required'@endphp
										/>
										<span class="lbl"> {{$requisito->requisito}} </span>
									</label>
								</fieldset>
								<input name="requisito[]" type="hidden" value="{{$requisito->requisito}}">
							@endforeach
								<div class="form-actions center">
									<button type="sumit" class="btn btn-sm btn-success">
										Continuar
										<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
									</button>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
    </div>
@endsection

