<style>
  td{
    font-size: 10px;
  }
</style>
<div style="margin-bottom: 150px;">
                  <table width="50%"  border="1" style="border-spacing: 0;" align="right">
                  <td align="center" style="background-color: blue; color: #ffffff">COMPROBANTE DE PAGO</td>
                  <td style="background-color: blue; color: #ffffff"></td>  
                  <tr>
                      <td >
                        Nro. DE CONTROL:
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td >
                        FECHA: 
                      </td>
                      <td align="center">{{ $pago['fechapago'] }}</td>
                    </tr>
                    <tr>
                      <td >
                        USUARIO: 
                      </td>
                      <td align="center">{{ $pago->sesion->usuario->nombre }}</td>
                    </tr>
                    <tr>
                      <td >
                        FORMA DE PAGO: 
                      </td>
                      <td align="center">{{ $pago->formapago->formapago }}</td>
                    </tr>
                    <tr>
                      <td >
                        NUMERO: 
                      </td>
                      <td align="center">{{ $comprobante }}</td>
                    </tr>
                  </table>
                  </div>
