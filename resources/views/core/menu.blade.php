<!-- Barra de menu superior de la aplicacion -->

	<div style="margin-top: 10px;">
		<!-- Logo de la empresa -->
		<div class="navbar-header pull-left col-md-7" >
		
			<a href="{{ route('main') }}" class="navbar-brand">
				<p style="font-family: sans-serif; font-weight: bold; color:#48c9c2; font-size:30px"><img  src="{{url('/')}}/img/app/logoFondo.png" alt="" style="height:50px"> D&D 2311 SERVICES AND SOLUTIONS </p>
			</a>
		</div>
		
		<!-- Menu derecho |Alertas|Usuario| -->
		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<!--Menu contextual del Usuario -->
				<li class="transparent">
					<!--Avatar del usuario -->
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<img class="nav-avatar-usuario" src="/img/usuarios/{{$usuario->avatar}}" alt="{{$usuario->nombre}}">
						<span class="user-info" style="font-family: Arial, Helvetica, sans-serif;">
							<small>Bienvenido,</small>							
							{{ $usuario->nombre }}
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>
					<!-- Submenu |Perfil|Cierre de Session -->
					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="">
								<i class="ace-icon fa fa-id-card-o"></i>
								{{ $usuario->perfiles->nombre }}
							</a>
						</li>
						<li>
							<a href="">
								<i class="ace-icon fa fa-desktop"></i>
								{{ Request::getClientIp() }}
							</a>
						</li>
						<li class="divider"></li>
						<li>
                            <a href="" data-toggle="modal" data-target="#passwordModal">
                                <i class="ace-icon fa fa-key"></i>
                                Cambiar Contraseña
							</a>

						</li>
						
						<li class="divider"></li>

						<li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-sign-out"></i>
                                Logout
                            </a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                             </form>
						</li>
					</ul><!--Fin Submenu Perfil-->
				</li>
				<!-- Fin Menu contextual del Usuario-->
			</ul>
		</div>
	</div>

