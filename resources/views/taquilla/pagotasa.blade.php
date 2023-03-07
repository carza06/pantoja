@extends('core.main')
@section('submenu')
@parent
<?php 
$inicio = '';
$mod = 'Taquilla';
$submenu = 'Pagos Diversos';

?>
@stop
@section('contenido')
  @parent
    <div class="page-content">
		<div class="page-header">
			<h1> 
				Pagos Diversos
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i> {{ $tasas->tasa }}						
				</small>
			</h1>
		</div><!-- /.page-header -->
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
			<div class="col-xs-10">
				<div class="widget-box">
					<div class="widget-header">
						<h5 class="widget-title">
							<i class="fa fa-check-square-o"></i>
							Cancele las siguientes tasas
						</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="profile-user-info profile-user-info-striped">
							
								<div class="profile-info-row">
									<div class="profile-info-value">{{$tasas->tasa}}</div>

									<div class="profile-info-value">
										@if($tasas->monto == 0)
										<span>Seleccione la forma de pago he indique el monto</span>
										@else
										<span>$RD {{$tasas->monto}}</span>
										@endif
									</div>
								</div>
							
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-10">
				<div class="btn-group btn-corner pull-right">
					<button class="btn btn-info">Metodos de pagos</button>
					<button class="btn btn-success" data-toggle="modal" data-target="#efectivo"><i class="fa fa-money"></i></button>
					<button class="btn btn-success"><i class="fa fa-credit-card"></i></button>
					<button class="btn btn-success" data-toggle="modal" data-target="#cheque"><i class="fa fa-sticky-note-o"></i></button>
					<button class="btn btn-success" data-toggle="modal" data-target="#transferencia"><i class="fa fa-exchange"></i></button>
				</div>
		</div>
    </div>

<div class="modal fade" id="efectivo" role="dialog">
  <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5><span class="glyphicon glyphicon-lock"></span> Pago en Efectivo</h5>
        </div>
        <div class="modal-body" style="padding:10px 20px;">
          <form role="form" action="{{route('guardartasas')}}" method="post">
              <div class="form-group">                
                <input type="checkbox"  id="vf" name="valorfiscal"> <b>VALOR FISCAL</b>
              </div>
              <div class="form-group">
                <label for="usrname">Numero Talonario</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="talonario" 
                  name="talonario" 
                  >
              </div>
            <div class="form-group">
              <label for="usrname">Monto</label>
              @if($tasas->monto == 0)
              <input 
                type="text" 
                class="form-control" 
                id="monto" 
                name="monto" 
                placeholder="Monto"
                required>
                @else
              <input 
                type="text" 
                class="form-control" 
                id="monto" 
                name="monto" 
                placeholder="Monto"
                value ="{{$tasas->monto}}"
                readonly 
                required>
               @endif
            </div>
                <input type="hidden" name="idtasa" value = "{{$tasas->id}}">
                <input type="hidden" name="tasa" value = "{{$tasas->tasa}}">
                
          	<input type="hidden" name="idformapago" value = "1">
          	<div class="pull-rigth">
              <button type="submit" class="btn btn-danger btn-sm pull-rigth" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              <button type="submit" class="btn btn-success btn-sm pull-rigth"><span class="glyphicon glyphicon-save"></span> Pagar</button>
              </div>
          </form>
        </div>
    </div>
  </div> 
</div>
<div class="modal fade" id="cheque" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5><span class="glyphicon glyphicon-lock"></span> Pago en Cheque</h5>
      </div>
      <div class="modal-body" style="padding:10px 20px;">
            <form role="form" action="{{route('guardartasas')}}" method="post">
              <div class="form-group">                
                <input type="checkbox"  id="vf" name="valorfiscal"> <b>VALOR FISCAL</b>
              </div>
              <div class="form-group">
                <label for="usrname">Numero Talonario</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="talonario" 
                  name="talonario" 
                  >
              </div>
              <div class="form-group">
                <label for="banco">Banco</label>
                <select class="form-control" id= "banco" name="idbanco">
                  @foreach($bancos as $banco)
                  <option value="{{$banco->id}}">{{$banco->banco}}</option>
                  @endforeach
                </select>
                
                <label for="nrocheque">Numero de Cheque</label>
                <input type="text" class="form-control" name="nrocheque" placeholder="Numero de Cheque" required>
                <label for="usrname">Numero de Cuenta</label>
                <input type="text" class="form-control" name="nrocuenta" placeholder="Numero de Cuenta" required>
                <label for="usrname">Titular de la Cuenta</label>
                <input type="text" class="form-control" name="titular" placeholder="Titular" required>                                                   
                <label for="usrname">Monto</label>
	              @if($tasas->monto == 0)
	              <input 
	                type="text" 
	                class="form-control" 
	                id="monto" 
	                name="monto" 
	                placeholder="Monto"
	                required>
	                @else
	              <input 
	                type="text" 
	                class="form-control" 
	                id="monto" 
	                name="monto" 
	                placeholder="Monto"
	                value ="{{$tasas->monto}}"
	                readonly 
	                required>
	               @endif
            
                    <input type="hidden" name="idtasa" value = "{{$tasas->id}}">
                    <input type="hidden" name="tasa" value = "{{$tasas->tasa}}">
                    

                <input type="hidden" name="idformapago" value = "3">
                           
              </div>
              <div class="pull-rigth">
                <button type="submit" class="btn btn-danger btn-sm pull-rigth" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-success btn-sm pull-rigth"><span class="glyphicon glyphicon-save"></span> Pagar</button>
              </div>
            </form>
      </div>
    </div>
  </div> 
</div>
<div class="modal fade" id="transferencia" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5><span class="glyphicon glyphicon-lock"></span> Pago por Transferencia</h5>
      </div>
      <div class="modal-body" style="padding:10px 20px;">
            <form role="form" action="{{route('guardartasas')}}" method="post">
              <div class="form-group">                
                <input type="checkbox"  id="vf" name="valorfiscal"> <b>VALOR FISCAL</b>
              </div>
              <div class="form-group">
                <label for="usrname">Numero Talonario</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="talonario" 
                  name="talonario" 
                  >
              </div>
              <div class="form-group">
                <label for="nrocheque">Numero de Transferencia</label>
                <input type="text" class="form-control" name="nrotransferencia" placeholder="Numero de Transferencia" >
                <label for="usrname">Monto</label>
                @if($tasas->monto == 0)
                <input 
                  type="text" 
                  class="form-control" 
                  id="monto" 
                  name="monto" 
                  placeholder="Monto"
                  required>
                  @else
                <input 
                  type="text" 
                  class="form-control" 
                  id="monto" 
                  name="monto" 
                  placeholder="Monto"
                  value ="{{$tasas->monto}}"
                  readonly 
                  required>
                 @endif
                <input type="hidden" name="idtasa" value = "{{$tasas->id}}">
                <input type="hidden" name="tasa" value = "{{$tasas->tasa}}">
                <input type="hidden" name="idformapago" value = "4">
              </div>
              <div class="pull-rigth">
                <button type="submit" class="btn btn-danger btn-sm pull-rigth" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-success btn-sm pull-rigth"><span class="glyphicon glyphicon-save"></span> Pagar</button>
              </div>
            </form>
      </div>
    </div>
  </div> 
</div>
@endsection

