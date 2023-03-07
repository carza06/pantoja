<table width="100%">
  <tr>
    <td width="15%">Forma de Pago:</td>
    <td>{{ $pago->formapago->formapago }}</td>
@if($pago['idformapago'] == 4)
    <td width="30%">Numero de Transferencia:</td>
    <td>{{ $pago->transferencia->nrotransferencia }}</td>
@endif  
  </tr>
  @if($pago['idformapago'] == 3)
  <tr>
    <td width="20%">Banco:</td>
    <td width="35%">{{ $pago->cheque->banco->banco }}</td>
    <td width="20%">Numero de Cheque:</td>
    <td width="20%">{{ $pago->cheque->nrodecheque }}</td>
  </tr>
  <tr>
    <td width="20%">Numero de Cuenta:</td>
    <td width="35%">{{$pago->cheque->nrodecuenta}}</td>
    <td width="20%">Titular:</td>
    <td width="20%">{{$pago->cheque->titular}}</td>
  </tr>
  @endif

</table>