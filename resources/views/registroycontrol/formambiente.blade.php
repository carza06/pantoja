
<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
		<div class="panel-heading">
		<h5>
				<i class="fa fa-check-square-o"></i>
					Datos del Arbitrio
				</h5>
		</div>
		<div class="panel-body">
			<div class="row">
						<div class="col-sm-12">
							<div>
								<label for="form-field-mask-1">
									Inicio de Cobro
									<small class="text-success">aaaa/mm/dd</small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
											<i class="ace-icon fa fa-calendar bigger-110"></i>
									</span>
									<input type='text' class="form-control" id='iniciocobro' name="iniciocobro" style="width:50%">
								
								</div>
							</div><br>
							<div class="row">
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Seleccione el Tipo de Tributo
								</label>		
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select  class="tipoambiente" id="tipoambiente" name ='idtipoambiente' required>

								        <option value="0" disabled="true" selected="true">Seleccione el tipo de Tributo</option>
								        @foreach($tipoambiente as $tp)
								            <option value="{{$tp->id}}">{{$tp->tipoambiente}}</option>
								        @endforeach

								    </select>

								</div>
							</div>
							<div class="col-xs-6">
								
									<label for="form-field-mask-3">
										Seleccione la Categoria
									</label>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-road"></i>
										</span>
									    <select class ="ambientecategoria" id="ambientecategoria" name='idambientecategoria' required>
									        <option value="0" disabled="true" selected="true">Seleccione la Categoria</option>
									    </select>
									</div>
								
							</div>
							</div><br>
							<div class="tipocarwash" id ="tipocarwash" style="display: none;">
								<label for="form-field-mask-22">
									Tipo de Carwash
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<input type="radio" name="bedStatus" id="tpuesto"  value="espacio"><label id="lpuesto"> </label>
									<input type="radio" name="bedStatus" id="tautomatico" value="automatico"> Automaticos
								</div>
							</div>

							<div class="tipofacturacion" id ="tipofacturacion" style="display: none;">
								<label for="form-field-mask-22">
									Tipo de Facturacion
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<input type="radio" name="tf" id="tmensual"  value="mensual"><label id="lpuesto">Mensual </label>
									<input type="radio" name="tf" id="tanual"    value="anual"> Anual
								</div>
							</div><br>
							<div class="espacios" id ="espacios" style="display: none;">
								<label for="form-field-mask-22">
									Numero de Espacios
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" id="nespacios" name ="nespacios">
								</div>
							</div>

							<div class="galones" id ="galones" style="display: none;">
								<label for="form-field-mask-23">
									Cantidad de Galones
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" id="ngalones" name ="ngalones">
								</div>
							</div>

							<div class="puestos" id ="puestos" style="display: none;">
								<label for="form-field-mask-23">
									Numero de Puestos
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" id="npuestos" name ="npuestos">
								</div>
							</div>
							<div class="objecion" id ="objecion" style="display: none;">
								<label for="form-field-mask-23">
									Monto por No Objecion
									<small class="text-warning"></small>
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-id-card"></i>
									</span>

									<input class="form-control" type="text" id="mobjecion" name ="mobjecion">
								</div>
							</div>
						</div>
					</div>		
		</div>
	</div>
</div>



@section('scripts')
<script>
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
	$(document).ready(function(){
        $(document).on('change','.tipoambiente',function(){
        	document.getElementById('tipocarwash').style.display='none';
        	document.getElementById('tipofacturacion').style.display='none';
            document.getElementById('espacios').style.display='none';
            document.getElementById('puestos').style.display='none';
            document.getElementById('galones').style.display='none';
            document.getElementById('objecion').style.display='none';
            //console.log("hmm its change");
            var idtipoambiente=$(this).val();
            //console.log(idsector);
			//var mySelect = $('#barrios');
            //var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('main/buscarcategoriaambiente')!!}',
                data:{'id':idtipoambiente},
                success:function(data){
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length);
                   var options = '<option value="0"  disabled="true"  selected="true">Seleccione la Cateoria</option>';
                   var y = 0;
                   $.each(data,function(key,val){
						options += '<option value="'+val.id+'">'+val.tipoambientecategoria+'</option>';
					})
					$("#ambientecategoria").html(options);
                },
                error:function(){

                }
            });
        });

        $(document).on('change','.ambientecategoria',function(){
        	$("#nespacios").removeAttr("required");
        	$("#ngalones").removeAttr("required");
            //console.log("hmm its change");
            var idtipo=document.getElementById('tipoambiente').value;
            var idcategoria=$(this).val();
            //console.log(idtipo);
            //console.log(idcategoria);
			//var mySelect = $('#vias');
            //var op=" ";
            if(idcategoria == 1 && idtipo == 1){
            	document.getElementById('lpuesto').innerHTML = ' Por Espacio ';
            	$("#tpuesto").removeAttr("checked");
            	$("#tautomatico").removeAttr("checked");
            	document.getElementById('tipocarwash').style.display='block';
            	document.getElementById('espacios').style.display='none';
            	document.getElementById('galones').style.display='none';
            	document.getElementById('puestos').style.display='none';
            }


            if( (idcategoria == 2 || idcategoria == 3 ) && idtipo == 1){
            	document.getElementById('tipocarwash').style.display='none';
            	document.getElementById('espacios').style.display='none';
            	document.getElementById('puestos').style.display='none';
            	document.getElementById('tipofacturacion').style.display='block';
            	document.getElementById('galones').style.display='block';
            }

            if( (idcategoria >= 6 && idcategoria <= 11 ) && idtipo == 1){
            	document.getElementById('tipocarwash').style.display='none';
            	document.getElementById('espacios').style.display='none';
            	document.getElementById('puestos').style.display='none';
            	document.getElementById('tipofacturacion').style.display='block';
            	document.getElementById('galones').style.display='none';
            }

            if( (idcategoria == 12 ) && idtipo == 1){
            	document.getElementById('tipocarwash').style.display='none';
            	document.getElementById('espacios').style.display='none';
            	document.getElementById('puestos').style.display='none';
            	document.getElementById('galones').style.display='none';
            	document.getElementById('tipofacturacion').style.display='block';
            	document.getElementById('objecion').style.display='block';
            }

            if(idcategoria == 4 && idtipo == 2){
            	document.getElementById('lpuesto').innerHTML = ' Por Puesto ';
            	$("#tpuesto").removeAttr("checked");
            	$("#tautomatico").removeAttr("checked");
            	document.getElementById('tipocarwash').style.display='block';
            	document.getElementById('espacios').style.display='none';
            	document.getElementById('galones').style.display='none';
            	document.getElementById('puestos').style.display='none';
            }

            if(idcategoria == 5 && idtipo == 2){
            	document.getElementById('lpuesto').innerHTML = ' Por Puesto ';
            	$("#tpuesto").removeAttr("checked");
            	$("#tautomatico").removeAttr("checked");
            	document.getElementById('tipocarwash').style.display='none';
            	document.getElementById('espacios').style.display='none';
            	document.getElementById('galones').style.display='block';
            	document.getElementById('puestos').style.display='none';
            }
            
        });

        $(document).on('click','input[name="bedStatus"]',function(){
            //console.log("hmm its change");
            var tipo=$(this).val();
            console.log(tipo);
            //console.log(tipo);
			//var mySelect = $('#vias');
            //var op=" ";
            if(tipo == 'espacio'){
            	document.getElementById('tipocarwash').style.display='block';
            	document.getElementById('espacios').style.display='block';
            	document.getElementById('galones').style.display='none';
            	$("#ngalones").removeAttr("required");
            	$("#nespacios")[0].setAttribute("required","true");
            }

            if(tipo == 'automatico'){
            	document.getElementById('tipocarwash').style.display='block';
            	document.getElementById('espacios').style.display='none';
            	$("#nespacios").removeAttr("required");
            	document.getElementById('galones').style.display='none';
            	$("#ngalones").removeAttr("required");
            }
            
        });
    });
</script>
@append