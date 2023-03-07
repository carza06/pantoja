<div class="row">
	<div class="col-xs-8">
	<!-- BUSQUEDA DEL SUJETO PASIVO-->
		<form role="form" action="{{route('addclalae')}}" method="post">
		{!! csrf_field() !!} 
		<input type="hidden" name="id" value="{{Session::get('NEWCLA.id')}}">
			<div>
				<label for="form-field-mask-2">
					Actividad
				</label>

				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-envelope-o"></i>
					</span>

					<input class="form-control input-mask-phone" value = "{{$new['actividad']}}" name="actividad" type="text" id="form-field-mask-2" readonly>
				</div>
			</div>
			@if(in_array(Session::get('NEWCLA.id'), array(1, 2, 3,4,5,6,7,8,9)))
			<div class="form-group">
				<label for="idzonamercado">Zona</label>
				<select 
					class="form-control" 
					id="id" 
					name = "idzonamercado" 
					required
				>
					<option value="0" disabled="true" selected="true">- Seleccione -</option>
					<option value="1" >Zona A</option>
					<option value="2" >Zona B</option>
					<option value="3" >Zona C</option>
				</select>
			</div>			
			<div>
				<label for="form-field-mask-2">
					Número de días	
				</label>

				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-envelope-o"></i>
					</span>

					<input class="form-control input-mask-phone" name = "basecal" type="text" id="form-field-mask-2" required>
				</div>
			</div>
			<div>
				<label for="form-field-mask-2">
					Metros	
				</label>

				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-envelope-o"></i>
					</span>

					<input class="form-control input-mask-phone" name = "metros" type="text" id="form-field-mask-2" required>
				</div>
			</div>
			@endif			
			<div class="form-actions center">
				<button type="sumit" class="btn btn-sm btn-success">
					Agregar
					<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
				</button>
			</div>
		</form>			
	</div>
</div>