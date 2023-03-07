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
					<i class="ace-icon fa fa-angle-double-right"></i> TASAS						
				</small>
			</h1>
		</div><!-- /.page-header -->
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-10">
				<div class="widget-box">
					<div class="widget-header">
						<h5 class="widget-title">
							<i class="fa fa-check-square-o"></i>
							Cancele las siguientes tasas
						</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="profile-user-info profile-user-info-striped">
							@php $total = 0; @endphp
							@foreach ($tasas as $tasa)
								<div class="profile-info-row">
									<div class="profile-info-value">{{$tasa->tasa}}</div>

									<div class="profile-info-value">
										<span>$RD {{$tasa->monto}}</span>
									</div>
								</div>
							@php $total+=$tasa->monto; @endphp
							@endforeach
							</div>

							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-10">
				<div class="btn-group btn-corner pull-right">
					<button class="btn btn-info">Metodos de pagos</button>
					<button class="btn btn-success" data-toggle="modal" data-target="#efectivo"><i class="fa fa-money"></i></button>
					<button class="btn btn-success"><i class="fa fa-credit-card"></i></button>
					<button class="btn btn-success" data-toggle="modal" data-target="#cheque"><i class="fa fa-sticky-note-o"></i></button>
					<button class="btn btn-success"><i class="fa fa-exchange"></i></button>
				</div>
		</div>
    </div>

@include('taquilla.modalefectivo')
@include('taquilla.modalcheque')
@endsection

