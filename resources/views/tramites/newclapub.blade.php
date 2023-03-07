

<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Distancia
			</h6>
	</div>
	<div class="panel-body">
		<form role="form" action="{{route('addclapub')}}" method="post">
			{!! csrf_field() !!} 
			<input type="hidden" name="id" value="{{$new['id']}}">
			<input type="hidden" name="monto" value="{{$new['monto']}}">
			<input type="hidden" name="minimo" value="{{$new['minimo']}}">
			<input type="hidden" name="fraccion" value="{{$new['fraccion']}}">
			<div>
				<label for="form-field-mask-2">
					Clasificador
				</label>

				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-envelope-o"></i>
					</span>

					<input class="form-control input-mask-phone" value = "{{$new['descripcion']}}" name="descripcion" type="text" id="form-field-mask-2" readonly>
				</div>
			</div>
			<div><br>
				
				@if($new['area'] == 1)
				<div class="row">
					<div class="col-sm-8">
						<label class="radio-inline"><input type="radio" name="medida" value="1" checked>Metros</label>
						<label class="radio-inline"><input type="radio" name="medida" value="2">Pies</label>
					</div>
				</div>
				@endif
				<label for="form-field-mask-2">
					@if($new['caras'] == 1)
						Numero de caras
					@endif
					@if($new['unidad'] == 1)
						Numero de unidades
					@endif	
				</label>

				<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-envelope-o"></i>
					</span>

					<input class="form-control input-mask-phone" name = "basecal" type="text" id="form-field-mask-2" required>
				</div>
			</div>			<br>
			<div class="form-actio center">
				<button type="sumit" class="btn btn-sm btn-success">
					Agregar
					<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
				</button>
			</div>
		</form>	
	</div></div>

