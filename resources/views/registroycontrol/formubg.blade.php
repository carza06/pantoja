
<div class="col-xs-8" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			<i class="fa fa-check-square-o"></i>
				Ubicacion Geografica
			</h6>
	</div>
	<div class="panel-body">
				<div class="row">
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

								        <option value="0" disabled="true" selected="true">- Seleccione el Sector -</option>
								        @foreach($sectores as $sector)
								            <option value="{{$sector->id}}">{{$sector->sector}}</option>
								        @endforeach
								    </select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<label for="form-field-mask-2">
								Seleccione el Barrio
							</label>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-road"></i>
								</span>
							    <select class ="barrios" id="barrios" name='idbarrio' required>
							        <option value="0" disabled="true" selected="true">- Seleccione el Barrio -</option>
							    </select>
							</div>
						</div>
					</div><br>
				
					<div class="row" class="col-xs-6">
						<div class="col-sm-6">
							<label for="form-field-mask-2">
								Detalle de direccion
							</label>
							<div class="input-group">
								<textarea style="resize: none;"" name = "direccion" rows="3" cols="60"  required></textarea>
							</div>
						</div>								
					</div>
		</div>
	</div>
</div>


@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
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
                   var options = '<option value="0">Seleccione el Barrio</option>';
                   var y = 0;
                   $.each(data,function(key,val){
						options += '<option value="'+val.id+'">'+val.barrio+'</option>';
					})
					$("#barrios").html(options);
                },
                error:function(){

                }
            });
        });
        
	});
</script>
@append