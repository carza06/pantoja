<div class="modal fade" id="deposito" role="dialog">
  <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5><span class="glyphicon glyphicon-lock"></span> Pago en Deposito</h5>
        </div>
        <div class="modal-body" style="padding:10px 20px;">
          <form role="form" action="{{route($route)}}" method="post">
            <input type="hidden" name="idformapago" value = "5">
            <input type="hidden" name="idtributo" value = "{{Session::get('IdTributo')}}">
            <div class="tipodeposito" id ="tipodeposito">
                <label for="form-field-mask-22">
                  Tipo de Deposito
                  <small class="text-warning"></small>
                </label>
                <div class="input-group">
                  <input type="radio" name="td" id="tefectivo" value= "1" checked=""> Efectivo
                  <input type="radio" name="td" id="tcheque" value= "2"> Cheque
                </div>
            </div>
            <div class="form-group">
            <label for="banco">Banco Receptor</label>
                <select class="form-control" id= "bancoreceptor" name="idbancoreceptor">
                  
                  @foreach($bancos as $banco)
                  <option value="{{$banco->id}}">{{$banco->banco}}</option>
                  @endforeach
                </select>
            </div>            
            <div class="form-group">
              <label for="usrname">Nro de Deposito</label>
              <input type="text" class="form-control" id="ndeposito" name="ndeposito" placeholder="Numero de Deposito">
            </div>                     
            <div class="form-group">
              <label for="usrname">Monto</label>
              <input type="text" class="form-control" id="monto" name="monto" placeholder="Monto">
            </div>
           
            <div class="hidden" id="infocheque">
                <label for="banco">Banco del Cheque</label>
                <select class="form-control" id= "banco" name="idbanco">
                  @foreach($bancos as $banco)
                  <option value="{{$banco->id}}">{{$banco->banco}}</option>
                  @endforeach
                </select>                
              <label for="nrocheque">Numero de Cheque</label>
              <input type="text" class="form-control" name="nrocheque" id="nrocheque" placeholder="Numero de Cheque" disabled>
              <label for="usrname">Numero de Cuenta</label>
              <input type="text" class="form-control" name="nrocuenta"  id="nrocuenta" placeholder="Numero de Cuenta" disabled>
              <label for="usrname">Titular de la Cuenta</label>
              <input type="text" class="form-control" name="titular" id="titular" placeholder="Titular" disabled>              
            </div>


          	
          	<div class="pull-rigth">
              <button type="submit" class="btn btn-danger btn-sm pull-rigth" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
              <button type="submit" id="submitefectivo" class="btn btn-success btn-sm pull-rigth"><span class="glyphicon glyphicon-save"></span> Pagar</button>
              </div>
          </form>
        </div>
    </div>
  </div> 
</div>