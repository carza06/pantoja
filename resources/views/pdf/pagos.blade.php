
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
    <title>Cierre Diario</title>
    {!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('assets/css/ace.min.css') !!}

  </head>
  <body>
    <div class="main-container" id="main-container">
      <div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
          @include('pdf.headerreportes')
          <div align="center"><h3>Cierre Diario<h3></div>
          <hr>
          @include('reportes.totalpagoscierre')
          </div>
        </div>
      </div>
    </div>
  </body>
</html>