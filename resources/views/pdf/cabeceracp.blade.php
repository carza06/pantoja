<div>
                  <table width="50%"  border="1" style="border-spacing: 0;" align="right">
                  <tr>
                  <td align="center" style="background-color: blue; color: #ffffff">Comprobante de pago</td>
                  <td style="background-color: blue; color: #ffffff"></td>  </tr>
                  <tr>
                      <td >
                        Nro. DE CONTROL:
                      </td>
                      <td>{{ $comprobante }}</td>
                    </tr>
                    <tr>
                      <td >
                        FECHA: 
                      </td>
                      <td align="center">{{ $pago['fechapago'] }}</td>
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
