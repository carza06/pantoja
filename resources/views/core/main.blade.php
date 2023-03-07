<?php 
$usuario = Auth::user();
$id = $usuario->id;
?>
<!DOCTYPE html>
<html>
	
	{!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300') !!}
	{!! Html::style('img/app/logoFondo.png', array('rel' => 'shortcut icon', 'type' => 'image/x-icon'))!!}
	{!! Html::style('assets/css/font-awesome.min.css') !!}
	{!! Html::style('assets/css/bootstrap.css') !!}
	{!! Html::style('assets/css/ace.min.css', array('class' => 'ace-main-stylesheet', 'id' => 'main-ace-style')) !!}
	{!! Html::style('assets/css/app.css') !!}
	{!! Html::script('assets/js/ace-extra.min.js') !!}
	<!--{!! Html::style('assets/css/jquery-ui.css') !!}-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<title>D&D Services & Solutions</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<style type="text/css">
		.jqstooltip { 
			position: absolute;left: 0px;top: 0px;
			visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
			color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;
				z-index: 10000;
		}
		.jqsfield { 
			color: white;font: 10px arial, san serif;text-align: left;
		}
	</style>
	@yield('style')
</head>

<body class="no-skin">
	<!-- Seccion del menu superior -->
	<div id="navbar" class="navbar navbar-default" style="background-image: linear-gradient(284deg, #48c9c2  22%,#103637 99%);">
		<div class="navbar-container" id="navbar-container" style="height: 55px;">
			@section('menu')
			@include('core.menu')	
			@show
		</div>
	</div>
	<div class="main-container" id="main-container">
	
		<!-- Seccion del contenido del aplicativo-->
		<div class="main-content">
			<div class="main-content-inner">
				@section('contenido')
				@include('core.contenido')
				@show
			</div>
		</div>
	@include('seguridad.cambiarclave')
	</div>	
<!-- js jquery -->
	{!! Html::script('assets/js/jquery.min.js') !!}
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<!-- Scripts -->
    
  	
  	{!! Html::script('assets/js/jquery-ui.js') !!}  
	{!! Html::script('assets/js/jquery-ui.custom.min.js') !!}
	{!! Html::script('assets/js/bootbox.js') !!}

	<!-- js bootstrap-->
	{!! Html::script('/assets/js/bootstrap.min.js') !!}
		 
		@yield('scripts')
	<!--js app -->
	{!! Html::script('assets/js/ace-elements.min.js') !!}
	{!! Html::script('assets/js/ace.min.js') !!}

		
</body>
</html>
