<div class="modal fade" id="tarjetas" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5> PAGO CON TARJETAS</h5>
      </div>
      <div class="modal-body" style="padding:10px 20px;">
            <form role="form" action="{{route($route)}}" method="post">
              @if(Session::get('descuento'))
              <input type="hidden" name="descuento" value = "{{Session::get('descuento')}}">
              <input type="hidden" name="descuento20" value = "{{Session::get('descuento20')}}">
              <input type="hidden" name="descuento50" value = "{{Session::get('descuento50')}}">
              @endif 
              <br>
              <div class="form-group">
                <label class="radio-inline"><input type="radio" name="idtipotarjeta" value="1" checked>Debito</label>
                <label class="radio-inline"><input type="radio" name="idtipotarjeta" value="2">Credito</label><br>
                <label for="banco">Banco</label>
                <select class="form-control" id= "banco" name="idbanco">
                  @foreach($bancos as $banco)                    
                  <option value="{{$banco->id}}">{{$banco->banco}}</option>                   
                  @endforeach
                </select>
                <label for="usrname">Nombre(Titular)</label>
                <input type="text" class="form-control" name="titular" placeholder="Titular" required>
                <label for="usrname">Numero de Tarjeta</label>
                <input type="number" class="form-control" name="nrotarjeta" placeholder="nrotarjeta" required>
                <label for="banco">Punto de Venta</label>
                <select class="form-control" id= "pto" name="idpunto">
              
                </select>
                <label for="nrocheque">Numero de Voucher</label>
                <input type="text" class="form-control" name="voucher" placeholder="Numero de Vocher" >
                <label for="usrname">Monto</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="monto" 
                  name="monto" 
                  placeholder="Monto"
                  @if($route == 'resumen')
                    value ="{{($tasa->tasavigencia()->first()->valor*500)}}"
                    disabled
                  @endif 
                  required>
                </div>
                @if(isset($tasas))
                  @foreach ($tasas as $tasa)
                    <input type="hidden" name="idtasa[]" value = "{{$tasa->id}}">
                    <input type="hidden" name="tasa[]" value = "{{$tasa->tasa}}">
                     <input type="hidden" name="monto[]" value = "{{($tasa->tasavigencia()->first()->valor*500)}}">
                  @endforeach
                @endif
                <input type="hidden" name="idformapago" value = "2">
                @if(isset($tasas))
                <input type="hidden" name="total" value = "{{($tasa->tasavigencia()->first()->valor*500)}}">
                @endif
                <input type="hidden" name="idtributo" value = "{{Session::get('IdTributo')}}">
                
              </div>
              <center>
              <div>
                <button type="submit" class="btn btn-danger btn-sm pull-rigth" data-dismiss="modal"> Cancelar</button>
                <button type="submit" class="btn btn-success btn-sm pull-rigth"> Pagar</button>
              </div><br>
              </center>
            </form>
      </div>
    </div>
  </div> 
</div>