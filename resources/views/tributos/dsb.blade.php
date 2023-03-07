<div>
	<label for="form-field-mask-2">
		Frecuencia de Facturacion
	</label>

	<div class="input-group">
		<span class="input-group-addon">
			<i class="fa fa-envelope-open"></i>
		</span>
	    <select class="frecuencia" id="idfrecuencia" name ="idfrecuencia" required>

	        
	        @foreach(Session::get('TFF') as $frecuencia)
	            <option value="{{$frecuencia->id}}">{{$frecuencia->frecuencia}}</option>
	        @endforeach

	    </select>
	</div>	
</div>						
