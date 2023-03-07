<?php
		if(!isset($mod)){
			$inicio = 'active';
			$mod    = '';
			$submenu= '';

		}
		
?>

<nav class="" style="background-color: rgba(112, 100, 97,0.8); height:55px">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	  
		@php
		$modulos = $usuario->Perfil()->get();
		$funciones = $modulos;
		$m = '';
		@endphp
		@foreach ($modulos as $modulo)
	            @if($m != $modulo->modulo)
	            <li class= "<?php if($mod == $modulo->modulo) echo 'active open'; ?>" >
				<button class=" dropdown-toggle" type="button" id="{{$modulo->modulo}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="height:45px;width:165px;border: none; background: rgba(255, 255, 255, 0); margin-top: 5px; margin-right:2px; border-radius:3px; ">
				<i style="color: black;" class="menu-icon {{$modulo->micon}}" aria-hidden="true"></i>
				<span class="menu-text" style="font-size: 15px; font-weight:bold; color:black">{{$modulo->modulo}}</span>
				</button>
				
				
	            	<ul class="dropdown-menu" aria-labelledby="{{$modulo->modulo}}">
		            @foreach($funciones as $funcion)
		                @if($funcion->modulo == $modulo->modulo)
						<li class= "<?php if($submenu == $funcion->funcion)echo 'active'; ?>">
						<a href="{{route($funcion->route)}}" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight:bold">
							<i class="menu-icon {{$funcion->ficon}}" ></i>
							{{ $funcion->funcion }}
							
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
 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- <div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Home</a>
		</li>
		<li class="active">
		
    	@if(isset($_SESSION['barrainfo']) && $_SESSION['barrainfo'] == 1) 
        	Barra de informacion del tributo
        @elseif(!isset($_SESSION['barrainfo']) || (isset($_SESION['barrainfo']) && $_SESSION['barrainfo'] == 0))
			<div class="nav-search" id="nav-search" align="center">
				<form class="form-search">
					<span class="input-icon">
						<input type="text" placeholder="IdTributo ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
					</span>
				</form>
			</div>
        @endif
    
		</li>
	</ul> 
</div> -->