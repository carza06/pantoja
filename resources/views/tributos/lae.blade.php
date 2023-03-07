@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Tramites';
$submenu = 'Solicitud de Tramite';
$tramite = Session::get('TMT');
?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
    	
		<div class="page-header">
			<h1>
				{{$tramite->tramite}}
				<small>
					<i class="ace-icon fa fa-angle-double-right"> ACTIVIDAD</i>						
				</small>
			</h1>
		</div><!-- /.page-header -->
		<div class="row">
			<div class="col-xs-10">
				<div class="widget-box">
					<div class="widget-header widget-header-flat">
						<h4 class="widget-title smaller">Datos de la Actividad</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							
							<form role="form" action="{{route('reglae')}}" method="post">
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
							{!! csrf_field() !!} 
								<div class="form-group">
									<label for="idtipolicencia">Seleccione la Actividad</label>
									<select 
										class="form-control" 
										id="id" 
										name = "idtipolicencia" 
										required
									>
										<option value="0" disabled="true" selected="true">- Seleccione -</option>
										@foreach ($tipolae as $lae)
											<option value="{{$lae->id}}">{{$lae->tipolicencia }}</option>
										@endforeach
									</select>
								</div>
								<div>
									<label for="form-field-mask-2">
										Observacion
									</label>

									<div class="input-group">
										<textarea name = "observacion" rows="4" cols="45"></textarea>
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
		</div>
	</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','idtipolicencia',function(){
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