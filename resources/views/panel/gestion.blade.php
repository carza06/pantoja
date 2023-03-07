@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
		<div class="page-header">
			<h1>
				 Panel de Gestion
			</h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<!-- Informacion de Recaudacion del Dia -->
				@include('panel.inforecauda')
				<!-- Informacion Frontdesk -->
				@include('panel.infofront')
				<hr>
			</div>
		</div>
    </div>
@endsection