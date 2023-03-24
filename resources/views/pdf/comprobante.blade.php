
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
    <title>Comprobante de Pago</title>
    {!! Html::style('assets/css/bootstrap.mini.css') !!}
    {!! Html::style('assets/css/ace.min.css') !!}
  </head>
   @for($h=0;$h<2;$h++)
  <body>
    
    <div class="main-container" id="main-container">
      <div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
          @include('pdf.headerreportes')
         
          @include('pdf.cabeceracp')

     
            <br>
          @include('pdf.detallecp')
        </div>
      </div>
    </div>
 
  </body>
     @endfor
</html>