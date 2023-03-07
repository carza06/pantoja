<div class="row">
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-header">
				<h6 class="widget-title">
					<i class="fa fa-check-square-o"></i>
					 Recaudacion
				</h6>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				
					<div class="profile-user-info profile-user-info-striped">
						@php
							$total = 0;
						@endphp
							<div class="profile-info-row">
								<div class="profile-info-value">Hecho Imponible</div>
								<div class="profile-info-value">
									<span class="pull-right">Monto RD$</span>
								</div>
							</div>		
						@foreach ($recauda as $key => $value)
							@php
								$total+= $value;
							@endphp
							<div class="profile-info-row">
								<div class="profile-info-value">{{$key}}</div>
								<div class="profile-info-value">
									<span class="pull-right">{{number_format($value,2)}}</span>
								</div>
							</div>
						@endforeach
						<div class="profile-info-row">
							<div class="profile-info-value"><p class="pull-right">Total</p></div>
							<div class="profile-info-value">
								<p class="pull-right">{{number_format($total,2)}}</p>
							</div>
						</div>						
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-header">
				<h6 class="widget-title">
					<i class="fa fa-check-square-o"></i>
					 Meta Estimada
				</h6>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-value">Mes</div>
							<div class="profile-info-value">Estimado RD$</div>
							<div class="profile-info-value">Recaudado RD$</div>
							<div class="profile-info-value">Porcentaje</div>
						</div>
						@for($i = 0; $i < count($mes); $i++)
						<div class="profile-info-row">
							<div class="profile-info-value">{{$mes[$i]}}</div>
							<div class="profile-info-value">{{$estimado[$i]}}</div>
							<div class="profile-info-value">{{$monto[$i]}}</div>
							<div class="profile-info-value">{{$porcentaje[$i]}}%</div>
						</div>
						@endfor
					</div>	
				</div>
			</div>
		</div>		
	</div>	
</div>
