
			<form target="_blank" class="form-search" action="{{ route( 'asignarvalorfiscal') }}" method="post">
				<div class="row">
					<div class="col-xs-4 col-sm-12">
						<center>
						<div class="form-group">
			              <label for="usrname">Tipo de Valor Fiscal</label><br>
			              <select name="idtipolote" required>
								@foreach ($tipolote as $tl)
			              		<option value="{{$tl->id}}">{{$tl->tipolote}}</option>
								@endforeach
			              </select>
			            </div>
						</center>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							<input type="text" 
									class="form-control"
									name="factura" 
									placeholder="Numero de Factura" 
									required 
									pattern="[0-9]{1,10}"      							
									title="campo solo números. Tamaño mínimo: 1. Tamaño máximo: 8"
							/>
							<span class="input-group-btn">
								<button type="sumit" class="btn btn-success btn-sm">
									<span class="fa fa-search icon-on-right bigger-90"></span>
									Asignar
								</button>
							</span>
						</div>
					</div>
				</div>
			</form>
		