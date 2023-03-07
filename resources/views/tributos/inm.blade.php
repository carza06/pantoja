<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">Datos de la Propiedad Inmobiliaria</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-sm-7">

							<div>
								<label for="form-field-mask-2">
									Uso del Inmueble
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select class="usoinm" id="idusoinm" name ='idusoinm' required>

								        <option value="0" disabled="true" selected="true">- Seleccione el Uso -</option>
								        @foreach(Session::get('USOINM') as $uso)
								            <option value="{{$uso->id}}">{{$uso->uso}}</option>
								        @endforeach

								    </select>

								</div>
							</div>							
							<div>
								<label for="form-field-mask-2">
									Tipo de Inmueble
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building-o"></i>
									</span>
								    <select class="tipoinm" id="tipoinm" name ="idtipoinm" required>

								        <option value="0" disabled="true" selected="true">- Seleccione el tipo -</option>

								    </select>

								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Uso del Suelo
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building-o"></i>
									</span>
								    <select  name ='idusosuelo' required>

								        <option value="0" disabled="true" selected="true">- Seleccione el Uso del Suelo -</option>
								        @foreach(Session::get('USOSUELO') as $uso)
								            <option value="{{$uso->id}}">{{$uso->descripcion}}</option>
								        @endforeach

								    </select>

								</div>
							</div>
							<div>
								<label for="form-field-mask-1">
									Fecha de Adquisicion
									<small class="text-success">aaaa/mm/dd</small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
											<i class="ace-icon fa fa-calendar bigger-110"></i>
									</span>
									<input type='text' class="form-control" id='datepicker' name="fechadeadquisicion">
								</div>
							</div>
							<div>
								<label for="form-field-mask-1">
									Inicio Cobro
									<small class="text-success">aaaa/mm/dd</small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
											<i class="ace-icon fa fa-calendar bigger-110"></i>
									</span>
									<input type='text' class="form-control" id='iniciocobro' name="iniciocobro" required>
								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Seleccione la Categorizacion
								</label>
								<div class="input-group">
									<label class="radio-inline"><input type="radio" name="categoria" value="A">A</label>
									<label class="radio-inline"><input type="radio" name="categoria" value="B">B</label>
									<label class="radio-inline"><input type="radio" name="categoria" value="C">C</label>
									<label class="radio-inline"><input type="radio" name="categoria" value="D">D</label>
								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Seleccione la tarifa
								</label>		
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select  name ='idtarifa' required>

								        <option value="0" disabled="true" selected="true">- Seleccione la Tarifa -</option>
								        @foreach(Session::get('TARIFADS') as $tarifa)
								            <option value="{{$tarifa->id}}">{{$tarifa->codigo}} - {{$tarifa->tarifa}}</option>
								        @endforeach

								    </select>

								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Frecuencia de Facturacion
								</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select  name ='idtipofrecuencia' required>

								        <option value="0" disabled="true" selected="true">- Seleccione la Frecuencia -</option>
								        @foreach(Session::get('TFF') as $frecuencia)
								            <option value="{{$frecuencia->id}}">{{$frecuencia->frecuencia}}</option>
								        @endforeach

								    </select>

								</div>
							</div>													
						</div>
						<div class="col-sm-5">
							<div>
								<label for="form-field-mask-2">
									Numero de Catastro
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control input-mask-text" type="text" name = "catastro" id="form-field-mask-2">
								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Metros 2 de Terreno
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" name = "areaterreno" id="form-field-mask-2">
								</div>
							</div>							
							<div>
								<label for="form-field-mask-2">
									Metros 2 de Construccion
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control input-mask-text" type="text" name = "areacontruccion" id="form-field-mask-2">
								</div>
							</div>	



							<div>
								<label for="form-field-mask-2">
									Numero de Habitantes 
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-usd"></i>
									</span>

									<input class="form-control input-mask-phone" name ="numerohabitantes" type="text" id="form-field-mask-2">
								</div>
							</div>
							<div>
								<label for="form-field-mask-2">
									Valor del Inmueble
									
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-usd"></i>
									</span>

									<input class="form-control input-mask-phone" name ="valorinmueble" type="text" id="form-field-mask-2">
								</div>
							</div>

							<div>
								<label for="form-field-mask-2">
									Lindero Norte
									
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-arrow-up"></i>
									</span>

									<input class="form-control input-mask-phone" name = "linderonorte" type="text" id="form-field-mask-2">
								</div>
							</div>

							<div>
								<label for="form-field-mask-2">
									Lindero Sur
									
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-arrow-down"></i>
									</span>

									<input class="form-control input-mask-phone" name = "linderosur" type="text" id="form-field-mask-2">
								</div>
							</div>

							<div>
								<label for="form-field-mask-2">
									Lindero Este
									
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-arrow-right"></i>
									</span>

									<input class="form-control input-mask-phone" name = "linderoeste" type="text" id="form-field-mask-2">
								</div>
							</div>

							<div>
								<label for="form-field-mask-2">
									Lindero Oeste
									
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-arrow-left"></i>
									</span>

									<input class="form-control input-mask-phone" name = "linderooeste" type="text" id="form-field-mask-2">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.usoinm',function(){
            //console.log("hmm its change");
            var iduso=$(this).val();
            //console.log(idsector);
			//var mySelect = $('#vias');
            //var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('main/buscartipoinm')!!}',
                data:{'id':iduso},
                success:function(data){
                    //console.log('success');
                    console.log(data);
                    //console.log(data.length);
                   var options = "";
                   $.each(data,function(key,val){
					   options += '<option value="'+val.id+'">'+val.tipo+'</option>';
					})
					$("#tipoinm").html(options);
                },
                error:function(){

                }
            });
        });        
	});
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'yy-mm-dd',
		 changeYear: true,
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
	 };
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$(function () {
		$("#datepicker").datepicker();
	});
	$(function () {
		$("#iniciocobro").datepicker();
	});	
</script>
@stop