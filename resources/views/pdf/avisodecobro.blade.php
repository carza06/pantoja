
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
    <title>Aviso de Cobro</title>
    {!! Html::style('assets/css/bootstrap.mini.css') !!}
    {!! Html::style('assets/css/ace.min.css') !!}
  </head>
   @for($h=0;$h<2;$h++)
  <body>
    <div class="main-container" id="main-container">
      <div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            @include('pdf.headeravisocobro')
            <hr>
            @include('pdf.cabeceraac')
            <br>
            <hr>
            @include('pdf.contribuyentecp')
            <hr>
            @include('pdf.infopub')
            <hr>
            @include('pdf.infoedo')
            <hr>
            @include('pdf.infofoot')
          </div>
        </div>
      </div>
    </div>
   </body>
     @endfor
</html>