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
						<i class="ace-icon fa fa-angle-double-right"> TIPO DE NEGOCIO</i>			
					</small>
				</h1>
			</div><!-- /.page-header -->
			
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-8">
			<!-- PUB-->
				<form role="form" action="{{route('lae')}}" method="post">
				{!! csrf_field() !!} 
					<div class="form-group">
						<label for="idtipopub">Seleccione el tipo de Negocio</label>
						<select 
							class="form-control" 
							id="id" 
							name = "idtipoactividad" 
							onchange='this.form.submit()'
							required
						>
							<option value="0" disabled="true" selected="true">- Seleccione -</option>
							@foreach ($tipoactividad as $actividad)
								<option value="{{$actividad->id}}">{{$actividad->actividad }}</option>
							@endforeach
						</select>
					</div>
					<noscript><input type="submit" value="Submit"></noscript>
				</form>			
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
			@if(Session::has('CLALAE'))
			@include('tributos.infolae')	
			@endif
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
			@if(Session::has('NEWCLA'))
			@php $new=Session::get('NEWCLA'); @endphp
			
			@include('tramites.newclalae')
			
			@endif
			</div>
		</div>		
    	<div class="form-actions center">
			<a class="btn btn-sm btn-success" href="{{ route('tramitetasas')}}">
			
				Continuar
				<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
			
			</a>
		</div>
    </div>
@endsection