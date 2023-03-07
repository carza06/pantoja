	@yield ('submenu')
	<?php
		if(!isset($mod)){
			$inicio = 'active';
			$mod    = '';
			$submenu= '';

		}
		
	?>


	<!-- <ul class="nav nav-list" style="top: 0px;">
		<li class="<?php echo $inicio; ?>">

			<a href="#">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Menu </span>
			</a>

			<b class="arrow"></b>
		</li> -->
		@php
		$modulos = $usuario->Perfil()->get();
		$funciones = $modulos;
		$m = '';
		@endphp
		<!-- Modulos por perfil -->
	       
	       <!-- @foreach ($modulos as $modulo)
	            @if($m != $modulo->modulo)
	            <li class= "<?php if($mod == $modulo->modulo) echo 'active open'; ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon {{$modulo->micon}}" aria-hidden="true"></i>
					<span class="menu-text" style="font-family: Arial, Helvetica, sans-serif; font-weight:bold;">{{$modulo->modulo}}</span>

					
				</a>
				<b class="arrow"></b>
	            	<ul class="submenu">
		            @foreach($funciones as $funcion)
		                @if($funcion->modulo == $modulo->modulo)
						<li class= "<?php if($submenu == $funcion->funcion)echo 'active'; ?>">
						<a href="{{route($funcion->route)}}" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight:bold">
							<i class="menu-icon fa fa-caret-right"></i>
							{{ $funcion->funcion }}
							<i class="menu-icon {{$funcion->ficon}}" aria-hidden="true"></i>
						</a>

						<b class="arrow"></b>
						</li>
						@endif
		            @endforeach
		        	</ul>
				</li>
				@endif
				@php($m = $modulo->modulo)    
	        @endforeach	 
 	

	</ul> 

	 <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div> -->

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
