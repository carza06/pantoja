<!-- Modal Avatar-->
<div class="modal fade" id="passwordModal" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
   <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;
		</button>
		<h4> Cambiar Contraseña</h4>
	</div>
	
	<form class="no-margin" role="form" action="{{route('actualizarpassword')}}" method="post">
	 {!! csrf_field() !!}
	 <input type="hidden" name="id" value="{{ $id }}">
	 <div class="modal-body">
			<div class="space-4"></div>
			<label> Nueva Contraseña </label><br>
			<input style="width: 50%;" id="password" name='password' placeholder="Nueva Contraseña"  type="password" min="8" required><br>
			<font><b>*la clave debe contener minimo 8 caracteres*</b></font><br><br>
	
	</div>
	<div align="center">
		<button style="border-radius: 3px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		<button style="border-radius: 3px;" type="submit" class="btn btn-primary">Cambiar</button>
	</div><br>
	</form>
  </div>
 </div>
</div>			