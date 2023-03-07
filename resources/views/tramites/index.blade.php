@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">  
		<div class="row" style="margin-top: 30px;">
		<div class="col-xs-4" style="margin-left: 15px;">

			
			<form class="form-search pull-left" action="{{route('solicitudtramite')}}" method="GET">
				<label for="form-field-select-1" style="font-weight: bold;"> Filtrar por tramite</label>
				<select 
					class="form-control" 
					id="form-field-select-1" 
					name = "idhi" 
					onchange='this.form.submit()'
				>
					<option value=""></option>
					@foreach ($hi as $var)
						<option value="{{$var->id}}">{{$var->nombrehechoimponible}}</option>
					@endforeach
				</select>
				 <noscript><input type="submit" value="Submit"></noscript>
			</form>
		</div><!-- /.page-header -->
		
			<!-- PAGE CONTENT BEGINS -->
		
			<div class="col-xs-6">
				@foreach ($tramites as $tramite)
				
					<div style="margin-top: 10px;">
						<button type="button" style="border-radius: 10px;" class="btn btn-primary">
						<a href="{{route('tramitesolicitante')}}" style="color: white;"
							onclick="event.preventDefault();
	                		document.getElementById({{$tramite->id}}).submit();
	                	">
					{{$tramite->tramite}}</a>
					<form id="{{$tramite->id}}" action="{{ route('tramitesolicitante') }}" method="POST" style="display: none;">
							{{ Form::hidden('id', $tramite->id) }}
							{{ Form::hidden('tramite', $tramite->tramite) }}
	                 </form>	
						</button>
					</div>
				
				@endforeach
			</div>
		</div>
    </div>
@endsection

