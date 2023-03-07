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
						<i class="ace-icon fa fa-angle-double-right"> INMUEBLE</i>						
					</small>
				</h1>
			</div><!-- /.page-header -->
			
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-8">
			<!-- BUSQUEDA DEL SUJETO PASIVO-->
			@include('core.busquedaxcatastro')
			<hr>

			@if (!Session::has('INM'))
				@if(Session::has('fail'))
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>

						<strong>
							<i class="ace-icon fa fa-times"></i><font><font>
							¡Ah!
						</font></font></strong><font><font>
							{{Session::get('fail')}}
						
						</font></font><br>
					</div>
					@if(Session::get('TMT.generainm') == 1)
					<form action="{{ route('reginm')}}" method="post">
					{!! csrf_field() !!}
						@include('tributos.inm')
						<div class="form-actions center">
							<button type="sumit" class="btn btn-sm btn-success">
								Continuar
								<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
							</button>
						</div>
					</form>
					@endif
				@endif
				
			</div>
			@else
				@php
				$inm = Session::get('INM');
				@endphp
				@include('tributos.infoinm')
					<div class="form-actions center">
						<a class="btn btn-sm btn-success" href="{{ route('tramitetasas')}}">
							Continuar
							<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
						</a>
					</div>				
			@endif
		</div>

    </div>
@endsection

