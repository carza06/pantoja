<div class="col-xs-12" style="float:none !important; margin: 0 auto">
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h6>
			Documentos Consignados
			</h6>
	</div>
	<div class="panel-body">
		<fieldset>
			@for ($i = 0; $i < count($req['requisito']); $i++)
			<span class="lbl">{{ $req['requisito'][$i]}}</span>
			@endfor
		</fieldset>
	</div>
</div>
</div> 


