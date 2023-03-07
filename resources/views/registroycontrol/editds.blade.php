@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Registro y Control';
$submenu = 'RUC';
$tramite = Session::get('TMT');
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
		<div class="page-header">
			<h1>
				Editar Tributo
				<small>
					<i class="ace-icon fa fa-angle-double-right"> {{ $tributo->id }}</i>						
				</small>
			</h1>
		</div><!-- /.page-header -->
		<div class="row">
			@if (Session::has('transaccion'))
			    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>
			        {{ Session::get('transaccion') }}
			    </div>
			@endif
		</div>
		<form class="form-search" action="{{ route('updatetrb') }}" method="POST">
			<input type="hidden" name="id" value="{{ $tributo["id"] }}">
		<div class="row">
			<div class="col-xs-12">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">Datos de la Propiedad Inmobiliaria</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main">

							<div class="row">
								<div class="col-sm-6">
									<label for="form-field-mask-2">
											Estatus
											<small class="text-warning"></small>
										</label>
									<div class="input-group">
									<select id="idstatus" name ='idstatus' required>
							        	<option value="1" selected="true">Activo</option>
							        	<option value="2">Inactivar</option>						     
							    	</select>
							    </div>
							    </div>
							</div>
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
										        @foreach($usoinmueble as $uso)
										            @if($uso->id == $inmueble[0]['idusoinm'])
										            <option value="{{$uso->id}}" selected="true">{{$uso->uso}}</option>
										            @else
										            <option value="{{$uso->id}}">{{$uso->uso}}</option>
										            @endif
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
										    
										    <select class="tipoinm" id="tipoinm" name ='idtipoinm' required>
										        @foreach($tipoinm as $tipo)
										            @if($tipo->id == $inmueble[0]['idtipoinm'])
										            <option value="{{$tipo->id}}" selected="true">{{$tipo->tipo}}</option>
										            @else
										            <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
										            @endif
										        @endforeach
										    </select>
										        
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
										        @foreach($usosuelo as $usos)
										        	@if($usos->id == $inmueble[0]['iduso'])
										            <option value="{{$usos->id}}" selected="true">{{$usos->descripcion}}</option>
										            @else
										            <option value="{{$usos->id}}">{{$usos->descripcion}}</option>
										            @endif
										        @endforeach

										    </select>

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
											<input type='text' class="form-control" id='iniciocobro' name="iniciocobro" value ="{{ $ds[0]['iniciocobro'] }}" required>
										</div>
									</div>
									<div>
										<label for="form-field-mask-2">
											Seleccione la Categorizacion
										</label>
										<div class="input-group">
											<label class="radio-inline"><input type="radio" name="categoria" value="A" @if($ds[0]['categoria']=='A') checked @endif>A</label>
											<label class="radio-inline"><input type="radio" name="categoria" value="B" @if($ds[0]['categoria']=='B') checked @endif>B</label>
											<label class="radio-inline"><input type="radio" name="categoria" value="C" @if($ds[0]['categoria']=='C') checked @endif>C</label>
											<label class="radio-inline"><input type="radio" name="categoria" value="D" @if($ds[0]['categoria']=='D') checked @endif>D</label>
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
										    <select  id="idtarifa" name ='idtarifa' required>

										        @foreach($tarifas as $tarifa)
										        	@if($tarifa->id == $ds[0]['idtarifa'])
										            <option value="{{$tarifa->id}}" selected="true">{{$tarifa->codigo}} - {{$tarifa->tarifa}}</option>
										            @else
										            <option value="{{$tarifa->id}}">{{$tarifa->codigo}} - {{$tarifa->tarifa}}</option>
										            @endif
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
		</div>
		<div class="row">
			<div class="col-xs-8">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">Ubicacion Geografica</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<div class="row">
							<form action="{{ route('tributo')}}" method="post">
								<div class="col-sm-6">
									<div>
										<label for="form-field-mask-2">
											Seleccione el Sector
										</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-puzzle-piece"></i>
											</span>
										    <select class="sectores" id="idsector" name ='idsector' required>
										        @foreach($sectores as $sector)
										            @if($sector->id == $tributo->ubg->idsector)
										            <option value="{{$sector->id}}" selected="true">{{$sector->sector}}</option>
										            @else
										            <option value="{{$sector->id}}">{{$sector->sector}}</option>
										            @endif
										        @endforeach
										    </select>
										</div>
									</div>
									<div>
										<label for="form-field-mask-2">
											Seleccione el Barrio
										</label>

										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-road"></i>
											</span>
										    <select class ="barrios" id="barrios" name='idbarrio' required>
										     	@foreach($barrios as $barrio)
										            @if($barrio->id == $tributo->ubg->idbarrio)
										            <option value="{{$barrio->id}}" selected="true">{{$barrio->barrio}}</option>
										            @else
										            <option value="{{$barrio->id}}">{{$barrio->barrio}}</option>
										            @endif
										        @endforeach   
										    </select>
										</div>
									</div>
									
									<div>
										<label for="form-field-mask-2">
											Detalle de direccion
										</label>

										<div class="input-group">
											<textarea name = "direccion" rows="4" cols="45" required>{{$tributo->ubg->direccion }}</textarea>
										</div>
									</div>								
								</div>
								
							
							</div>
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

		</div>
<!-- Modal -->
  <div class="modal fade" id="alerta-tarifa" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-exclamation-triangle"></span> Notificación de Cambio de tarifa</h4>
        </div>
        <div class="modal-body">
        <p>Ha decidido cambiar la tarifa, este proceso impacta en el estado de cuenta, en la factura actual y en las siguientes facturaciones, los cargos realizados por concepto de servicio de recoleccion de desechos solidos en el estado de cuenta seran modificados solo en aquellos casos que dichos cargos no hayan sido pagados. </p>
        </div>      
    </div>
  </div> 
</div>
<!-- Modal -->
  <div class="modal fade" id="alerta-status" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-exclamation-triangle"></span> Notificación de Cambio de Estatus</h4>
        </div>
        <div class="modal-body">
        <p>Ha decidido inactivar el tributo, este proceso es irreversible, verifique antes de continuar, El tributo sera inactivado siempre y cuando no tenga pagos asociados </p>
        </div>      
    </div>
  </div> 
</div>
@endsection
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
                $(document).on('change','.sectores',function(){
            //console.log("hmm its change");
            var idsector=$(this).val();
            //console.log(idsector);
			//var mySelect = $('#barrios');
            //var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('main/buscarbarrios')!!}',
                data:{'id':idsector},
                success:function(data){
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length);
                   var options = "<option></option>";
                   var options2 = "<option></option>";
                   var y = 0;
                   $.each(data,function(key,val){
						options += '<option value="'+val.id+'">'+val.barrio+'</option>';
					})
					$("#barrios").html(options);
					$("#vias").html(options2);
                },
                error:function(){

                }
            });
        });
        $(document).on('change','.barrios',function(){
            //console.log("hmm its change");
            var idbarrio=$(this).val();
            console.log(idbarrio);
			//var mySelect = $('#barrios');
            //var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('main/buscarvia')!!}',
                data:{'id':idbarrio},
                success:function(data){
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length);
                   var options = " ";
                   $.each(data,function(key,val){
                   		options += '<option value="'+val.id+'">'+val.nombre+'</option>';
					})
					$("#vias").html(options);
                },
                error:function(){

                }
            });
        });

	    $('#idtarifa').change(function () {
	        if ($(this).val() != {{ $ds[0]['idtarifa'] }}) {

	            $('#alerta-tarifa').modal({
	            	show: true
	        	});
	        }
	    });

	   	$('#idstatus').change(function () {
	        if ($(this).val() == 2) {

	            $('#alerta-status').modal({
	            	show: true
	        	});
	        }
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