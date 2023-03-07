@php ($total = 0)
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
    <title>Estado de Cuentas {{ $idtributo }}</title>
    
	 <style type="text/css">
		body {
		    font: normal 11px Verdana, Arial, sans-serif;
		}
	
	</style>    
  </head>
  <body>

  <div class="main-container" id="main-container">
     <div class="main-content">
        <div class="main-content-inner">
         	<div class="page-content">
			<table width="100%">
			    <tbody>
			      <tr>
					<td width="80%" align="left"><B>JUNTA MUNICIPAL DE PANTOJA</B>
						<br>CARRETERA LA ISABELA, PLAZA ESPEDITO, PANTOJA, SANTO DOMINGO, RD 
						<br>WHATSAPP: (829) 961-65-92 / (809) 655-06-89
						<br>RNC: 430-04474-1
						<br>recaudacion.pantoja@gmail.com
					</td>

			          
			          <td>
					  <img src="{{ url('/')}}/img/app/logo.jpg" width="100" height="100">
			          </td>
			      </tr>
			    </tbody>
			</table><br>
			<div class="col-xs-12" align="center">
				<h1 style="background-color:blue; width: 50%; color:#FFFFFF">Estado de Cuenta</h1>	
			</div><br>
			@if(isset($ds))
			<div class="col-xs-6">
				<h3>CLASIFICACION DEL SERVICIO</h3>
				<div class="row">
				<H3>{{ strtoupper($ds['clasificador']) }}</H3>
				</div>
			</div>
			@endif
			@if(isset($sp))
			<div class="col-xs-12" style="background-color: rgba(241, 229, 226,0.8); border: 1px solid black;" >
			<table width="100%" >
			  <tr>
			    <td width="22%">Nombre | Razon Social:</td>
			    <td>{{ $sp['nombre_razonsocial'] }}</td>
			  </tr>
			  <tr>
			    <td>Cedula | RNC:</td>
			    <td>{{ $sp['cedula_rcn'] }}</td>
			  </tr>
			  <tr>
			    <td>Dirección:</td>
			    <td>{{ $sp['direccion'] }}</td>
			  </tr>
			</table>
			</div>
			@endif
		
		<br>
			@if(isset($edo))
			<div class="col-xs-12" style="border: 1px solid black;">
			<table width="100%" >
				<thead style="background-color: rgba(241, 229, 226,0.8); height: 30px;">
					<tr>
						<th style="border: 1px  black;">Fecha</th>
						<th >Descripcion</th>
						<th >Monto RD$</th>
					</tr>
				</thead>
				<tbody>
					<?php

						$deuda_morosa = 0;
						$deuda_morosa_show = false;

					?>
					
					@foreach ($edo as $detalle)
						@php 
						$total+=$detalle->montoremanente;
						@endphp

						@if(strtotime($detalle->fecha) <= strtotime("2019-12-31"))
							@php
								$deuda_morosa += $detalle->montoremanente;
							@endphp
						@endif

						@if(strtotime($detalle->fecha) >= strtotime("2020-01-01"))							
							@if($deuda_morosa > 0 && !$deuda_morosa_show)
								<tr>
									<td style="border: 1px solid black;">0000-00-00</td>
									<td style="border: 1px solid black;">Deuda Morosa</td>
									<td style="border: 1px solid black;" align="right">{{number_format ($deuda_morosa,2)}}</td>
								</tr>

								@php 
									$deuda_morosa_show = true;
								@endphp
							@endif
							
							<tr>
								<td style="border: 1px solid #FAEBD7;" align="center">{{$detalle->fecha}}</td>
								<td style="border: 1px solid #FAEBD7;">{{$detalle->descripcion}}</td>

								@if($detalle->idtipomovimientoedo == 2)
									<td style="border: 1px solid #FAEBD7;" align="center">-{{number_format ($detalle->monto,2)}}</td>
								@else
									<td style="border: 1px solid #FAEBD7;" align="center">{{number_format ($detalle->monto,2)}}</td>
								@endif
							</tr>
						@endif
					@endforeach
					
					<tr style="background-color: rgba(241, 229, 226,0.8); height: 40px;">
						<td></td>
						<td align="right">Monto Total</td>
						<td align="center">{{number_format ($total,2)}}</td>
					</tr>
				</tbody>
			</table>
			</div>
			@endif
			</div>       
			<div class="row">
				<div class="col-xs-6">
					<h4>Fecha:</h4>
					<h4>Usuario:</h4>
				</div>
				<div class="col-xs-6">
				<img align="right" src="{{url('/')}}/img/app/logotipo.jpg" style="width: 10%; margin-top: 2%;"> <br><br>
				<div align="center">"SOLO PARA USO EXCLUSIVO DE LA EMPRESA D&D 2311 SERVICE AND SOLUTIONS"</div>         
				</div>
				</div>
				
			</div>
	</div>		
    </div>


