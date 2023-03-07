<div class="modal fade" id="transferencia" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5> PAGO POR TRANSFERENCIA</h5>
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
                <label for="nrocheque">Número de Transferencia</label>
                <input type="text" class="form-control" name="nrotransferencia" placeholder="Numero de Transferencia" >
                <br>
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
                <input type="hidden" name="idformapago" value = "4">
                <input type="hidden" name="total" value = "{{$total}}">
                <input type="hidden" name="idtributo" value = "{{Session::get('IdTributo')}}">
                
              </div>
              <center>
                <div>
                  <button type="submit" class="btn btn-danger btn-sm pull-rigth" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success btn-sm pull-rigth"> Pagar</button>
                </div>
              </center><br>
            </form>
      </div>
    </div>
  </div> 
</div>