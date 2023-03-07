@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
?>
@stop
@section('contenido')
  @parent
    <!-- <div class="page-content"> -->
    		
		<!-- PAGE CONTENT BEGINS -->

			<!-- <div class="col-xs-8">
				<div class="widget-box">
					<div class="widget-header">
						<h6 class="widget-title">
							<i class="fa fa-check-square-o"></i>
							 Introduzca los datos del solicitante
						</h6>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
						
						</div>
					</div>

				</div>
			</div>
		
		

    </div> --> 
	<div class="col-md-6" style="margin-top:15px; margin-left:30px" >
	<div class="panel panel-primary">
  		<div class="panel-heading">
			<h6>
			<i class="fa fa-check-square-o"></i>
			Introduzca los datos del solicitante
			</h6>
		</div>
		<div class="panel-body">
		<form action="{{ route('tramiterequisitos')}}" method="post">
							<div >
								<label for="form-field-mask-2">
									Cedula:
								</label>

								<div class="input-group ">
									<span class="input-group-addon">
									<i class="ace-icon fa fa-id-card"></i>
									</span>
									<input  name = "cedula1" 
											id ="cedula1" 
											type="text" 
											maxlength= "3" 
											size="3" 
											placeholder="003"
											pattern="[0-9]+" 
											required 
											onKeyPress="pasaSiguiente(this, document.getElementById('cedula2'), 3)">
									<input  name = "cedula2" 
											id ="cedula2" 
											type="text" 
											maxlength= "7" 
											size="7" 
											placeholder="0084648"
											pattern="[0-9]+" 
											required
											onKeyPress="pasaSiguiente(this, document.getElementById('cedula3'), 7)">
									<input  name = "cedula3" 
											id ="cedula3" 
											type="text" 
											maxlength= "1" 
											size="1" 
											placeholder="2"
											pattern="[0-9]+" 
											required
											onKeyPress="pasaSiguiente(this, document.getElementById('nombre'), 1)">
								</div>
							
							</div>		<br>		
							<div class="">
								<label for="form-field-mask-2">
									Nombre:
								</label>
								<div class="input-group col-xs-6">
									<span class="input-group-addon">
									<i class="ace-icon fa fa-id-card"></i>
									</span>
									<input class="form-control" name = 'nombre' type="text" id="nombre" pattern="[a-zA-Z ]*" required>
								</div>
							</div> <br>
							<div >
								<label for="form-field-mask-2">
									Telefono:
								</label>

								<div class="input-group col-xs-6" >
									<span class="input-group-addon">
									<i class="fa fa-phone"></i>
									</span>
									<input class="form-control" placeholder="999 9999999" name ='telefono' type="text" maxlength= "10" pattern="[0-9 ]+" required>
								</div>
							</div>	
							
							{{ Form::hidden('id', $tipotramite['id']) }}
							<div class="form-actions center">
								<button type="sumit" class="btn btn-sm btn-success">
										Continuar
										<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
							</div>
							</form>
		</div>
	</div>
	</div>
@endsection
@section('scripts')
<script language="javascript">

  function pasaSiguiente(actual, siguiente, longitud)
  {
         if((actual.value.length +1) == longitud)
                siguiente.focus();
  }

</script>
@endsection
