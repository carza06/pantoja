@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
$tramite = Session::get('TMT');
$sp = Session::get('SP');
//dd($sp);
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">

	
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-12">
			<!-- BUSQUEDA DEL SUJETO PASIVO-->
			@include('core.busquedaxcedula')
		
			@if (!Session::has('SP'))
				
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
					<form action="{{ route('regsp')}}" method="post">
						@include('tributos.spn')
						<div class="form-actions center">
							<button type="sumit" class="btn btn-sm btn-success">
								Continuar
								<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
							</button>
						</div>
					</form>
					
				@endif
			</div>
			@else
			
				@include('tributos.infosp')
					<div class="form-actions center">
						<a class="btn btn-sm btn-success" href="{{ route('ubg')}}">
							Continuar
							<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
						</a>
					</div>
				@endif
		</div>

    </div>
@endsection

