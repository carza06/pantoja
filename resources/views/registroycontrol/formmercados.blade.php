

<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Tarifa del Mercado
			</h6>
	</div>
	<div class="panel-body">
	<div class="row">
						<div class="col-sm-12">

							<div class="row">
								<div class="col-xs-6">
								<label for="form-field-mask-2">
									Mercado
								</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building"></i>
									</span>
								    <select class="mercado" id="idmercado" name ='idmercado' required>

								        <option value="" disabled="true" selected="true">Especifique El Mercado</option>
								        @foreach($mercados as $mercado)
								            <option value="{{$mercado->id}}">{{$mercado->mercado}}</option>
								        @endforeach

								    </select>

								</div>
							</div>							
							<div class="col-xs-6">
								<label for="form-field-mask-2">
									Seleccione la Tarifa
								</label>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-building-o"></i>
									</span>
								    <select class="mercadotarifa" id="mercadotarifa" name ="idtarifamercado" required>

								        <option value="" disabled="true" selected="true">Seleccione la Tarifa</option>

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
        $(document).on('change','.mercado',function(){
            //console.log("hmm its change");
            var iduso=$(this).val();
            //console.log(idsector);
			//var mySelect = $('#vias');
            //var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('main/buscarmercadostarifa')!!}',
                data:{'id':iduso},
                success:function(data){
                    //console.log('success');
                    console.log(data);
                    //console.log(data.length);
                   var options = "";
                   $.each(data,function(key,val){
					   options += '<option value="'+val.tarifa+'">'+val.tarifa+'</option>';
					})
					$("#mercadotarifa").html(options);
                },
                error:function(){

                }
            });
        });        
	});

</script>
@append