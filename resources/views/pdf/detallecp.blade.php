<table width="100%"  border="1" style="border-spacing: 0; border: 1px solid #FAEBD7;">

  @if($pago['idtipopago'] == 1)
   <tr style="background-color: rgba(241, 229, 226,0.8); height: 40px;">
    <td width="40%">DESCRIPCIÓN</td>
    <td width="20%" align="center">SALDO RD$</td>
    <td width="20%" align="center">PAGADO RD$</td>
    <td width="20%" align="center">BALANCE RD$</td>
  </tr> 
  @for($i =0;$i < count($detalle);$i++)
  <tr>
    <td width="50%">{{ $detalle[$i][0] }}</td>
    <td width="16%" align="right">{{ number_format($detalle[$i][1],2) }}</td>
    <td width="16%" align="right">{{ number_format($detalle[$i][2],2) }}</td>
    <td width="16%" align="right">{{ number_format($detalle[$i][3],2) }}</td>
  </tr>
  @endfor
  @endif
  @if($pago['idtipopago']==2)
  <tr>
    <td width="80%">Descripcion</td>
    <td width="20%" align="center">Monto RD$</td>
  </tr> 
  @for($i =0;$i < count($detalle);$i++)
  <tr>
    <td width="80%">{{ $detalle[$i][0] }}</td>
    <td width="20%" align="right">{{ number_format($detalle[$i][1],2) }}</td>
  </tr>
  @endfor
  @endif
</table>
<br>
<table width="100%"  border="1" style="border-spacing: 0; border: 1px solid #FAEBD7; background-color: rgba(241, 229, 226,0.8); height: 40px;">
  <tr>
    <td width="80%" align="right">Monto del Pago RD$</td>
    <td width="20%" align="right">{{ number_format($pago['monto'],2) }}</td>
  </tr>
</table>
<br><br><br><br>
<hr align="center" width="50%">
<table width="100%">
  <tr>
    <td><p style="text-align: center"><b >SELLO Y FIRMA DEL AGENTE</b></p></td>
  </tr>
  <tr>
    <td><p style="text-align: center;"><font size="2"><b> NOTA: NO ES VALIDO SIN SELLO Y FIRMA</b></font></p></td>
  </tr>
</table>
<div align="right">
<img align="right" src="{{url('/')}}/img/app/Logotipo.jpg" style="width: 10%; margin-top: 2%;">
</div><br><br><br><br><br><br><br>
  <div align="center">
          <font size="1">"FORMATO PARA USO EXCLUSIVO DE LA EMPRESA D&D 2311 SERVICE AND SOLUTIONS"</font>
  </div>
  <div style="page-break-after:always;"></div>