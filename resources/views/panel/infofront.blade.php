<hr>
<div class="row">
@foreach($ufront as $agentef)
@if($agentef->Recaudado()->where('p.fechapago',date('Y-m-d'))->count('p.monto') > 0)
<div class="col-sm-4">
	<div class="col-sm-4" >
		<span class="profile-picture"><img class="editable img-responsive" src="/img/usuarios/{{$agentef->avatar}}"></span>
	</div>
	<div class="col-sm-8" >
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Nombre</div>
				<div class="profile-info-value">
					<span>{{$agentef->nombre}}</span>
				</div>
			</div>

			<div class="profile-info-row">
				<div class="profile-info-name">Recaudado</div>

				<div class="profile-info-value">
					<span class="pull-right">{{number_format($agentef->Recaudado()->where('p.idstatus',1)->where('p.fechapago',date('Y-m-d'))->sum('p.monto'),2)}}</span>
					
				</div>
			</div>

			<div class="profile-info-row">
				<div class="profile-info-name">Nro Pagos</div>

				<div class="profile-info-value">
					<span class="pull-right">{{$agentef->Recaudado()->where('p.fechapago',date('Y-m-d'))->count('p.monto')}}</span>
				</div>
			</div>
			<div class="profile-info-row">
				<div class="profile-info-name">Nro Tramites</div>

				<div class="profile-info-value">
					<span class="pull-right">{{$agentef->Tramites()->count('t.id')}}</span>
				</div>
			</div>			
		</div>		
	</div>
</div>
@endif
@endforeach

</div>


	
