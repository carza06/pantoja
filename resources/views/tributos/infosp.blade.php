
<div class="col-xs-8" style="float:none !important; margin: 0 auto">
<div class="panel panel-primary" >
  <div class="panel-heading">
    <h3 class="panel-title">
		<div class="row">

		@if(isset($editar))
			@if($editar == 1)
			<div class="col-xs-2 pull-right">
				<a href="{{ route('editsp',array($sp['id'])) }}" class="btn btn-xs btn-warning">
					<i class="ace-icon fa fa-pencil bigger-120"></i>
				</a>
			</div>
			@endif
		@endif
		<h5 class="widget-title smaller"> Datos del Contribuyente</h5>
		</div>
	</h3>
		
  </div>
  <div class="panel-body">
  <div class="row">
						<div class="col-sm-6">
							<dl id="dt-list-1">
								@if(isset($sp['idanterior']))
								<dt>Id Control</dt>
								<dd>
									<a href="{{ route('comprobantes') }}"
									   onclick="event.preventDefault();
                                       document.getElementById('idcontrol').submit();">
                                       {{ strtoupper($sp['idanterior']) }}
                                    </a>
                                    <form id="idcontrol" action="{{ route('comprobantes') }}" method="POST" style="display: none;">
                                    	<input type="hidden" name="search" value="1">
                                    	<input type="hidden" name="cedularcn" value="{{$sp['idanterior']}}">
                                    {{ csrf_field() }}
                             		</form>
                                </dd>
								
								@endif
								@if(isset($sp['cedula_rcn']))
								<dt>Cedula | RNC</dt>
								<dd>{{ strtoupper($sp['cedula_rcn']) }}</dd>
								@endif
								@if(isset($sp['nombre_razonsocial']))
								<dt>Razon Comercial</dt>
								<dd>{{ strtoupper($sp['nombre_razonsocial']) }}</dd>
								@endif
								@if(isset($sp['apellido_denominacioncomercial']))
								<dt>Apellido | Denominacion Comercial</dt>
								<dd>{{ strtoupper($sp['apellido_denominacioncomercial']) }}</dd>
								@endif
								@if(isset($sp['fechanacimiento_fundada']))
								<dt>Fecha de Nacimiento | Fecha de Fundada</dt>
								<dd>{{ strtoupper($sp['fechanacimiento_fundada']) }}</dd>
								@endif
							</dl>
						</div>
						<div class="col-sm-6">
							<dl id="dt-list-2">
								@if(isset($sp['direccion']))
								<dt>Direccion</dt>
								<dd>{{ strtoupper($sp['direccion']) }}</dd>
								@endif
								@if(isset($sp['telefonoprincipal']))
								<dt>Telefono principal</dt>
								<dd>{{ strtoupper($sp['telefonoprincipal']) }}</dd>
								@endif
								@if(isset($sp['telefonosecundario']))
								<dt>Telefono secundario</dt>
								<dd>{{ strtoupper($sp['telefonosecundario']) }}</dd>
								@endif
								@if(isset($sp['email']))
								<dt>Correo electronico</dt>
								<dd>{{ strtoupper($sp['email']) }}</dd>
								@endif
							</dl>
						</div>						
					</div>
  </div>
</div>
</div>

