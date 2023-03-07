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
			
		<div class="col-xs-8" style="float:none !important; margin: 0 auto">
			<div class="panel panel-primary">
			<div class="panel-heading">
			<h6>
					<i class="fa fa-check-square-o"></i>
						Clasificador de publicidad
					</h6>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-8">
						<!-- PUB-->
						<form role="form" action="{{route('pub')}}" method="post">
							{!! csrf_field() !!} 
							<div class="form-group">
									<label for="idtipopub">Publicidad a pagar:</label>
									<select class="form-control" id="id" name = "id" onchange='this.form.submit()'mrequired>
										<option value="0" disabled="true" selected="true">- Seleccione -</option>
										@foreach ($tipopub as $pub)
											<option value="{{$pub->id}}">{{$pub->descripcion }}</option>
										@endforeach
									</select>
							</div>
								<noscript><input type="submit" value="Submit"></noscript>
						</form>			
					</div>
				</div>
			</div>
    	</div>	
		<div class="row">
			@if(Session::has('NEWCLA'))
			@php $new=Session::get('NEWCLA'); @endphp
			
			@include('tramites.newclapub')
			
			@endif
		</div>
		<div class="row">

			@if(Session::has('CLAPUB'))
				@include('tributos.infopub')
			@endif

		</div>
	
		@if(Session::has('CLAPUB'))
    	<div class="form-actions center">
			<a class="btn btn-sm btn-success" href="{{ route('tramitetasas')}}">
				Continuar
				<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
			</a>
		</div>
		@endif
		</div>
@endsection