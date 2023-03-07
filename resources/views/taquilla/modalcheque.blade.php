<div class="modal fade" id="cheque" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5>PAGO EN CHEQUE</h5>
      </div>
      <div class="modal-body" style="padding:10px 20px;">
            <form role="form" action="{{route($route)}}" method="post">
              <!-- <div class="form-group">                
                <input type="checkbox"  id="vf" name="valorfiscal"> <b>VALOR FISCAL</b>
              </div> -->
              <div class="form-group">
                <label for="usrname">Número Talonario</label>
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
                
                <label for="nrocheque">Número de Cheque</label>
                <input type="text" class="form-control" name="nrocheque" placeholder="Número de Cheque" required>
                
                <label for="usrname">Numero de Cuenta</label>
                <input type="text" class="form-control" name="nrocuenta" placeholder="Número de Cuenta" required>
                
                <label for="usrname">Titular de la Cuenta</label>
                <input type="text" class="form-control" name="titular" placeholder="Titular" required>                                                   
                
                <label for="usrname">Monto</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="monto" 
                  name="monto" 
                  placeholder="Monto"
                  @if($route == 'resumen')
                    value ="{{$total}}"
                    disabled
                  @endif 
                  required>
                </div>
                @if(isset($tasas))
                  @foreach ($tasas as $tasa)
                    <input type="hidden" name="idtasa[]" value = "{{$tasa->id}}">
                    <input type="hidden" name="tasa[]" value = "{{$tasa->tasa}}">
                     <input type="hidden" name="monto[]" value = "{{$tasa->monto}}">
                  @endforeach
                @endif
                <input type="hidden" name="idformapago" value = "3">
                <input type="hidden" name="total" value = "{{$total}}">
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