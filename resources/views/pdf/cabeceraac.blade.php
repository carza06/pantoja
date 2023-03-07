<table width="100%">
  <tr>
      <td width="20%"></td>
      <td width="50%" style="vertical-align:top;"><p align="center"> <font size="5"> Aviso de Cobro</font></p></td>
      <td width="30%">
          <table width="100%">
            <tr>
              <td >Número:</td>
              <td align="right">{{ $numero }}</td>
            </tr>
              <tr>
              <td >Fecha:</td>
              <td align="right">{{ date('Y-m-d')  }}</td>
            </tr>
            <tr>
              <td >Usuario:</td>
              <td align="right">{{ \Auth::user()->nombre }}</td>
            </tr>
          </table>
      </td>
  </tr>
</table>