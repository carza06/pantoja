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
                  <table width="100%"  border="1" style="border-spacing: 0;">
                    <tr>
                      <td align="center" style="background-color: blue;">
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
        </table>  
        <br>
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="5%">#</td>
          <td width="30%" >Concepto</td>
          <td width="10%" align="center">Tonelada</td>
          <td width="15%" align="center">RD$ Deuda</td>
          <td width="15%" align="center">RD$ Monto</td>
          <td width="25%" align="center">RD$ Total</td>
        </tr>
        @php 

            $detalle = $data->detalleespecial()->get(); 

          
          $x = 0;
          $total = 0;
        @endphp
        @foreach($detalle as $valor) 
          @php ($x++) 
          <tr>
            <td scope="row">{{ $x }}</td>
            <td>Recoleccion Especial de Desecho Solido</td>
            <td align="center">{{ $valor->tonelada }}</td>
            <td align="right">{{ number_format($valor->saldoanterior,2) }}</td>
            @php ($subtotal = $valor->saldoanterior + $valor->monto)
            <td align="right">{{ number_format($valor->monto,2) }}</td>
            <td align="right">{{ number_format($subtotal,2) }}</td>
          </tr>
          @php ($total += $subtotal)
        @endforeach

        <tr>
          <td colspan="5" align="right">RD$ Total</td>
          <td align="right">{{ number_format($total,2) }}</td>
        </tr>
        </table>
         <font size="1"> Esta Factura esta sujeta a revisión por parte de la Junta Municipal de Pantoja. Dirección de Rentas.</font>
  </body>
</html>