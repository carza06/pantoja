@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Taquilla';
$submenu = 'Pagos Diversos';
$sp = Session::get('SP');
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<div class="page-header">
			<h1> 
				Pagos Diversos
				<small>
					<i class="ace-icon fa fa-angle-double-right"> Seleccion de Tasa</i>
				</small>
			</h1>
		</div><!-- /.page-header -->
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-8">
				@include('tributos.infosp')
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<div class="widget-body">
					<div class="widget-main no-padding">
						<form class="form-search" action="{{route('pagotasa')}}" method="post">
							<select 
								class="form-control" 
								id="form-field-select-1" 
								name = "id" 
								onchange='this.form.submit()'
							>
								<option value="0">Seleccione el concepto a cobrar</option>
								@foreach ($tasas as $tasa)
									@if(Request::get('id') == $tasa->id)
									<option value="{{$tasa->id}}" selected>{{$tasa->tasa}}</option>
									@else
									<option value="{{$tasa->id}}">{{$tasa->tasa}}</option>
									@endif
								@endforeach
							</select>
							 <noscript><input type="submit" value="Submit"></noscript>
						</form>
					</div>
				</div>
			</div>			
		</div>
    </div>

@endsection

