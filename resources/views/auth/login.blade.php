<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>D&D Services & Solutions</title>
        <meta name="description" content="Login Sigespro" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Sisprinca" />
        {!! Html::style('img/app/logoFondo.png', array('rel' => 'shortcut icon', 'type' => 'image/x-icon'))!!}
        <link rel="shortcut icon" href="../favicon.ico">
        {!! Html::style('assets/css/font-awesome.min.css')!!}
		<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <script src="assets/js/modernizr.custom.63321.js"></script>
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>	
		
			body {

				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: contain;
			}
			
			

		</style>
    </head>
    <body style="background-image: linear-gradient(284deg, #103637  22%,#48c9c2 99%);">
        <div class="container">

			<section class="main">

				<div class="card" >
					<div class="card-body">
				<form class="form-2" action="{{ route('login') }}" method="post" >
					
							{!! csrf_field() !!} 
							<center>
							<img  src="{{url('/')}}/img/app/logoFondo.png" alt="" style="height:120px">
							<h1> Iniciar Sesion</h1>
							</center>
							@if ($errors->any())
								<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Por favor corrige los siguentes errores:</strong>
								<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
								</div>
							@endif				
					<p class="float">
						<label for="login" >Usuario</label>
					</p>
					<p>
						<input type="text" placeholder="Usuario" name="usuario" value="{{ old('usuario') }}" title="Ingrese su usuario" required/>
					</p>
					<p class="float">
						<label for="password" style="font-family: Georgia, 'Times New Roman', Times, serif;">Contraseña</label>
					</p>
					<p>
						<input type="password"  name="password" placeholder="Contraseña" class="showpassword" title="Introduzca su clave" required/>
					</p>
					<p class="clearfix" > 
						<center>
						<input type="submit"  name="submit" value="Iniciar sesion">
						</center>
					</p>
					</form>
					</div>
				</div>
				​​
			</section>
        </div>
		<!-- jQuery if needed -->
         {!! Html::script('//code.jquery.com/jquery-1.11.3.min.js')!!}
    	 {!! Html::script('assets/js/bootstrap.min.js') !!}
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Contraseña' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Mostrar Contraseña")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.fa fa-lock').addClass('fa fa-unlock');
						$('.fa fa-unlock').removeClass('fa fa-lock');    
					} else {
						$('.fa fa-unlock').addClass('fa fa-lock');
						$('.fa fa-lock').removeClass('fa fa-unlock');
					}
			    });
			});
		</script>
    </body>
         {!! Html::script('//code.jquery.com/jquery-1.11.3.min.js')!!}
    	 {!! Html::script('assets/js/bootstrap.min.js') !!}
</html>