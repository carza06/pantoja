<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
  <title>Factura</title>
  </head>
  <body>
  
        <table width="100%">
          <tr>

            <td width="70%" align="left"><B>JUNTA MUNICIPAL DE PANTOJA</B>
            <br>CARRETERA LA ISABELA, PLAZA ESPEDITO, PANTOJA, SANTO DOMINGO, RD 
            <br>WHATSAPP: (829) 961-65-92 / (809) 655-06-89
            <br>RNC: 430-04474-1
            <br>recaudacion.pantoja@gmail.com
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td>
                    <p>
                    <img align="right" src="{{ url('/')}}/img/app/logo.jpg" width="100" height="90">
                    </p><br><br><br><br><br><br>
                  </td>
                </tr>
                <tr>
                  <table width="100%"  border="0.1" style="border-spacing: 0;">
                    <tr>
                      <td align="center">
                        FACTURACIÓN
                      </td>
                    </tr>
                    <tr>
                      <td >
                        Nro Factura: {{  str_pad($data->id, 6, "0", STR_PAD_LEFT) }}
                      </td>
                    </tr>
                    <tr>
                      <td >
                        Fecha: {{ date("d-m-Y", strtotime($data->created_at)) }}
                      </td>
                    </tr>
                    @if(!is_null($data->valorfiscal))
                    <tr>
                      <td >
                        Valor Fiscal: {{$data->valorfiscal->valorfiscal}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Fecha Vencimiento: 2023-12-31
                      </td>
                    </tr>
                    @endif
                  </table>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="100%">
      <tr>
       
        <td align="center">
          <h3>
            FACTURA
          </h3>
        </td>
      </tr>  
    </table>
    <table width="100%">
          <tr>
            <td width="20%">NOMBRE/RAZON SOCIAL:</td>
            <td width="45%">
              @if(strlen($data->sujetopasivo) < 22)
              {{ $data->sujetopasivo }}
              @else
               <font size="2"> {{ $data->sujetopasivo }}</font>
              @endif
            </td>
          </tr>
          <tr>
            <td width="20%">CEDULA/RNC:</td>
            <td width="35%">{{ $data->rnc }}</td>
          </tr>
          <tr>
            <td>TELEFONOS:</td>
            <td></td>
          </tr>
          <tr>
            <td>CORREO:</td>
            <td></td>
          </tr>
          <tr>
            <td>DIRECCIÓN:</td>
            <td>{{ $data->direccion }}</td>
          </tr>
        </table><br>
  <table width="100%" border="1" style="border-spacing: 0; border: 1px solid #FAEBD7; ">
    <tr >
      <td width="5%">#</td>
      <td width="55%" >DESCRIPCIÓN/CONCEPTO</td>
      <td width="15%" align="center">ANUALIDAD</td>
      <td width="25%" align="center">TOTAL</td>
    </tr>
    @php 
     //dd($factura->detalle()->get()); 
      $detalle = $data->detalle()->get();
      $x = 0;
      $total = 0;
    @endphp
    @foreach($detalle as $valor) 
      @php ($x++) 
      <tr>
        <td scope="row">{{ $x }}</td>        
        <td>{{ $valor->concepto }}</td>     
        
        @php ($subtotal = $valor->saldo + $valor->monto)
        <td align="right">{{ number_format($valor->monto,2) }}</td>
        <td align="right">{{ number_format($subtotal,2) }}</td>
      </tr>
      @php ($total += $subtotal)
    @endforeach
    <tr style="background-color: rgba(241, 229, 226,0.8); ">
      <td colspan="3" align="right">TOTAL A PAGAR</td>
      <td align="right">{{ number_format($total,2) }}</td>
    </tr>
    </table>
    <font size="1"> (*) ESTA FACTURA ESTA SUJETA A REVISION POR PARTE DE LA JUNTA MUNICIPAL DE PANTOJA</font>
        <br><br><br><br><br>
        <table width="100%">
          <tr>

            <td width="100%" align="left"><B>FORMA DE PAGO</B>
            <br><b>FAVOR EMITIR SU PAGO A NOMBRE DE:</b> 
            <br><b>JUNTA MUNICIPAL DE PANTOJA </b>
            <br><b>RNC: 430-04474-1 / CTA CTE BANRESERVAS # 2440015606</b>
            <br><b>Favor enviar acuse de pago a la siguiente direccion: </b>
            <br><b>recaudacion.pantoja@gmail.com</b>
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td>
                    <p>
                    <img align="right" src="{{ url('/')}}/img/app/Logotipo.jpg" width="100" height="90">
                    </p><br><br><br><br><br><br>
                  </td>
                </tr>
                
              </table>
            </td>
          </tr>
        </table><br><br><br>
        <div align="center">
          <font size="1">"FORMATO PARA USO EXCLUSIVO DE LA EMPRESA D&D 2311 SERVICE AND SOLUTIONS"</font>
        </div>
            <div style="page-break-after:always;"></div>
  </body>
</html>