<!-- <div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">Datos de la Propiedad Inmobiliaria</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
			
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
			Datos de la Propiedad Inmobiliaria
			</h6>
	</div>
	<div class="panel-body">
	<div class="row">
						<div class="col-sm-12">

							<div class="row">
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Uso del Inmueble
								</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select class="usoinm" id="idusoinm" name ='idusoinm' required style="width: 70%;">
								        <option value="0" disabled="true" selected="true">- Seleccione el Uso -</option>
								        @foreach(Session::get('USOINM') as $uso)
								            <option value="{{$uso->id}}">{{$uso->uso}}</option>
								        @endforeach

								    </select>
								</div>
							</div>							
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Tipo de Inmueble
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building-o"></i>
									</span>
								    <select class="tipoinm" id="tipoinm" name ="idtipoinm" required style="width: 70%;">

								        <option value="0" disabled="true" selected="true">- Seleccione el tipo -</option>

								    </select>

								</div>
							</div>
							</div><br>
							<div class="row">
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Uso del Suelo
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building-o"></i>
									</span>
								    <select  name ='idusosuelo' required style="width: 70%;">

								        <option value="0" disabled="true" selected="true">- Seleccione el Uso del Suelo -</option>
								        @foreach(Session::get('USOSUELO') as $uso)
								            <option value="{{$uso->id}}">{{$uso->descripcion}}</option>
								        @endforeach

								    </select>

								</div>
							</div>
							<div class="col-xs-6">
								<label for="form-field-mask-1">
									Inicio Cobro
									<small class="text-success">aaaa/mm/dd</small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
											<i class="ace-icon fa fa-calendar bigger-110"></i>
									</span>
									<input type='text' class="form-control" id='iniciocobro' name="iniciocobro" required style="width: 70%;">
								</div>
							</div>
							</div> <br>
							<div class="row">
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Seleccione la tarifa
								</label>		
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select  name ='idtarifa' required style="width: 70%;">

								        <option value="0" disabled="true" selected="true">- Seleccione la Tarifa -</option>
								        @foreach(Session::get('TARIFADS') as $tarifa)
								            <option value="{{$tarifa->id}}">{{$tarifa->codigo}} - {{$tarifa->tarifa}}</option>
								        @endforeach

								    </select>

								</div>
							</div>
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Frecuencia de Facturacion
								</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select  name ='idtipofrecuencia' required style="width: 70%;">

								        <option value="0" disabled="true" selected="true">- Seleccione la Frecuencia -</option>
								        @foreach(Session::get('TFF') as $frecuencia)
								            <option value="{{$frecuencia->id}}">{{$frecuencia->frecuencia}}</option>
								        @endforeach

								    </select>

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
		$("#iniciocobro").datepicker();
	});
</script>
@append