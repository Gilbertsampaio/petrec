<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Projeto Frontend">
  <meta name="author" content="Gilbert Sampaio">
  <title>Dashboard</title>
  <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
  <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
  <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://d3js.org/d3.v4.js"></script>

  <meta name="theme-color" content="#7952b3">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    #mapdiv {
      width: 100%;
      height: 500px;
      margin-bottom: 50px !important;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    @media screen and (max-width: 640px) {
      .dataTables_wrapper .dataTables_length {
        float: left;
        text-align: left;
      }

      .sidebar {
        top: 0;
      }
    }

    .table-responsive {
      margin-bottom: 50px;
    }

    .svg-container {
      display: inline-block;
      position: relative;
      width: 100%;
      padding-bottom: 75%;
      /* aspect ratio */
      vertical-align: top;
      overflow: hidden;
    }

    .svg-content-responsive {
      display: inline-block;
      position: absolute;
      top: 10px;
      left: 0;
    }
  </style>
  <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" target="_new" href="https://petrec.com.br/pt/">PETREC</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="w-100"></div>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#">Sair</a>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#graficoDIV">
                <i class="mdi mdi-align-vertical-bottom"></i>
                Gráfico
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tabelaOnibusDIV">
                <i class="mdi mdi-format-list-numbered"></i>
                Listagem
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#mapdivDIV">
                <i class="mdi mdi-map-marker-radius"></i>
                Mapa
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div id="graficoDIV" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Gráfico</h1>
        </div>
        <div id="grafico"></div>
        <div id="tabelaOnibusDIV" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Tabela de Ônibus</h2>
        </div>
        <div class="table-responsive">
          <table id="tabelaOnibus" class="display" style="width:100%">
            <thead>
              <tr>
                <th scope="col">Código</th>
                <th scope="col">Linha</th>
                <th scope="col">Trajeto</th>
              </tr>
            </thead>
            <tbody id="listagemTabela"></tbody>
          </table>
        </div>
        <div id="mapdivDIV" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Mapa de localização</h2>
        </div>
        <div id="mapdiv"></div>
      </main>
    </div>
  </div>


  <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
  <script src="script.js"></script>
</body>

</html>