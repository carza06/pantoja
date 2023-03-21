
<!DOCTYPE html>
@foreach($data as $factura) 
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
    <title>Facturas</title>
    <style type="text/css">
        #watermark { position: fixed; bottom: 650px; right: 330px; width: 180px; height: 180px; opacity: .1; }
    </style>
  </head>
  <body>
        <div id="watermark">
            <img src="{{ public_path()}}/img/app/logo.jpg" height="150%" width="150%" />
        </div>
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
                    <img align="right" src="{{ public_path()}}/img/app/logo.jpg" width="100" height="90">
                    </p><br><br><br><br><br><br>
                  </td>
                </tr>
                <tr>
                  <table width="100%"  border="0.1" style="border-spacing: 0;">
                    <tr>
                      <td align="center" style="background-color: blue;">
                        FACTURACIÓN
                      </td>
                    </tr>
                    <tr>
                      <td >
                        Nro Factura: {{  str_pad($factura->id, 6, "0", STR_PAD_LEFT) }}
                      </td>
                    </tr>
                    <tr>
                      <td >
                        Fecha: {{ date("d-m-Y", strtotime($factura->created_at)) }}
                      </td>
                    </tr>
                  </table>
                </tr>
              </table>
            </td>
          </tr>
        </table>
     <table width="100%">
      <tr>
        <td width="35%">&nbsp;</td>
        <td align="center">
          <h3>
            FACTURA
          </h3>
        </td>
        @if(!is_null($factura->valorfiscal))
          <td width="35%" align="right">
            Valor Fiscal: {{$factura->valorfiscal->valorfiscal}}
          </td>
        @else
        <td>&nbsp;</td>
        @endif
      </tr>  
    </table>
        <table width="100%">
          <tr>
            <td width="20%">NOMBRE/RAZON SOCIAL:</td>
            <td width="45%">
              @if(strlen($factura->sujetopasivo) < 22)
              {{ $factura->sujetopasivo }}
              @else
               <font size="2"> {{ $factura->sujetopasivo }}</font>
              @endif
            </td>
          </tr>
          <tr>
            <td width="20%">CEDULA/RNC:</td>
            <td width="35%">{{ $factura->rnc }}</td>
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
            <td>{{ $factura->direccion }}</td>
          </tr>

        </table>  
        <BR></BR>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr style="background-color:#FAEBD7">
          <td width="5%" style="border: solid 1px #C0C0C0;">#</td>
          <td width="60%" align="center" style="border: solid 1px #C0C0C0;">DESCRIPCIÓN/CONCEPTO</td>
          <!-- <td width="15%" align="center">DEUDA</td>
          <td width="15%" align="center">MES</td> -->
          <td width="35%" align="center" style="border: solid 1px #C0C0C0;">TOTAL</td>
        </tr>
        @php 
         //dd($factura->detalle()->get()); 
          $detalle = $factura->detalle()->get();
          $x = 0;
          $total = 0;
        @endphp
        @foreach($detalle as $valor) 
          @php ($x++) 
          <tr>
            <td scope="row" style="border: solid 1px #C0C0C0;">{{ $x }}</td>            
            <td style="border: solid 1px #C0C0C0;">{{$valor->concepto}}</td>            
            <!-- <td align="right">{{ number_format($valor->saldo,2) }}</td> -->
            @php ($subtotal = $valor->saldo + $valor->monto)
            <!-- <td align="right">{{ number_format($valor->monto,2) }}</td> -->
            <td align="right" style="border: solid 1px #C0C0C0;">{{ number_format($subtotal,2) }}</td>
          </tr>
          @php ($total += $subtotal)
        @endforeach
        <tr style="background-color:#FAEBD7; ">
          <td colspan="2" align="right">TOTAL A PAGAR</td>
          <td align="right">{{ number_format($total,2) }}</td>
        </tr>
        <tr style="background-color:#FAEBD7">
          <td colspan="2" align="right">TOTAL ATRASO</td>
          <td align="right">{{ number_format($valor->saldo,2) }}</td>
        </tr> 
        <tr style="background-color:#FAEBD7">
          <td colspan="2" align="right">TOTAL PENDIENTE A PAGAR</td>
          <td align="right">{{ number_format($valor->monto,2) }}</td>
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
              <img src="{{ public_path()}}/img/app/Logotipo.jpg" width="100" height="90" alt="">
            </td>
          </tr>
        </table><br><br><br>
        <div align="center">
          <font size="1">"FORMATO PARA USO EXCLUSIVO DE LA EMPRESA D&D 2311 SERVICE AND SOLUTIONS"</font>
        </div>
            <div style="page-break-after:always;"></div>
         
   
  </body>
</html>
 @endforeach