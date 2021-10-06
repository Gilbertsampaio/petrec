<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Projeto Frontend">
  <meta name="author" content="Gilbert Sampaio">
  <title>Dashboard - PETREC</title>
  <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
  <link rel="icon" href="https://petrec.com.br/pt/wp-content/uploads/2020/05/cropped-Vector-Smart-Object-1-32x32.png" sizes="32x32" />
  <link rel="icon" href="https://petrec.com.br/pt/wp-content/uploads/2020/05/cropped-Vector-Smart-Object-1-192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon" href="https://petrec.com.br/pt/wp-content/uploads/2020/05/cropped-Vector-Smart-Object-1-180x180.png" />
  <meta name="msapplication-TileImage" content="https://petrec.com.br/pt/wp-content/uploads/2020/05/cropped-Vector-Smart-Object-1-270x270.png" />
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://d3js.org/d3.v4.js"></script>

  <meta name="theme-color" content="#7952b3">
  <style>
    .bg-dark {
      background-color: #fff !important;
    }

    .logo {
      height: 50px;
      width: auto;
    }

    .active {
      color: rgb(12 90 108) !important;
    }

    .nav-link {
      font-size: 18px !important;
      color: rgb(12 90 108) !important;
    }

    .bg-light {
      background-color: #c6ddeb !important;
    }

    .dataTables_length {
      margin-bottom: 20px;
    }

    table {
      padding-top: 0px !important;
      border: 1px solid #c6ddeb;
      border-radius: 7px 7px 0 0;
    }

    table.dataTable.no-footer {
      border-bottom: 1px solid rgb(12 90 108) !important;
    }

    table th {
      background: #c6ddeb;
      border-bottom: none !important;
      color: #0c5a6c;
    }

    .filters th {
      border-radius: 0 !important;
    }

    select {
      padding: .375rem 2.25rem .375rem .75rem !important;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-repeat: no-repeat;
      background-position: right .75rem center;
      background-size: 16px 12px;
      appearance: auto;
      outline: 0;
    }

    input {
      display: block;
      width: 100%;
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: .25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      outline: 0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      color: #ffffff !important;
      border: none !important;
      background: #32857d !important;
      transition: all .3s ease !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      color: #ffffff !important;
      border: none !important;
      background: #32857d !important;
      transition: all .3s ease !important;
    }

    .dataTables_paginate .current {
      background: #32857d !important;
      color: #ffffff !important;
    }

    .dataTables_paginate .previous {
      border-radius: 3px 0 0 3px !important;
      border-left: none !important;
      height: 36px !important;
    }

    .dataTables_paginate .next {
      border-radius: 0 3px 3px 0 !important;
      border-right: none !important;
      height: 36px !important;
      margin-top: -1px !important;
    }

    .ellipsis {
      display: inline-block;
      padding: 0 12px;
      height: 35px !important;
      vertical-align: middle;
      line-height: 28px;
      margin-top: -4px;
      cursor: default;
      background: #1d474e;
      color: #32857d;
      text-decoration: none;
      cursor: pointer;
      font-weight: bold;
      box-sizing: border-box;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      box-sizing: border-box;
      display: inline;
      min-width: 1.5em;
      padding: .5em 1em;
      margin-left: 2px;
      text-align: center;
      text-decoration: none !important;
      cursor: pointer;
      color: #32857d !important;
      border-radius: 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
    .ellipsis:hover {
      color: #fff !important;
      background: #32857d !important;
      transition: all .3s ease !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
      cursor: default;
      color: #999 !important;
      background: transparent;
      box-shadow: none;
    }

    .paginate_button {
      padding: 8px 12px !important;
      background: #1d474e !important;
      text-decoration: none !important;
      cursor: pointer !important;
      font-weight: bold !important;
      color: #32857d !important;
      border: none !important;
      margin-left: 0px !important;
      border-radius: 0 !important;
    }

    div.dataTables_wrapper div.dataTables_paginate {
      margin: 10 0 0 0;
      white-space: nowrap;
      text-align: right;
    }

    .sidebar {
      padding: 74px 0 0 !important;
    }

    .navbar-dark .navbar-toggler {
      color: rgb(12, 90, 108) !important;
      border-color: rgb(12, 90, 108) !important;
      background: rgb(12, 90, 108) !important;
    }

    .navbar-dark .navbar-brand {
      text-align: center;
      box-shadow: none !important;
    }

    .navbar-brand {
      padding-top: .75rem;
      padding-bottom: .75rem;
      font-size: 1rem;
      background-color: transparent !important;
      box-shadow: none;
    }

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

    .sair {
      display: block;
    }

    @media (max-width: 991.98px) and (orientation: landscape) {
      .navbar .navbar-toggler {
        top: 1.25rem !important;
        right: 1rem;
      }

      .logo {
        height: 60px !important;
        width: auto;
      }

      main {
        margin-top: 20px !important;
      }

      .nav-link {
        font-size: 26px !important;
      }

      .sair {
        display: none;
      }

      .sidebar {
        top: 1rem !important;
        z-index: 1005 !important;
      }
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

      .logo {
        height: 90px !important;
        width: auto;
      }

      main {
        margin-top: 30px !important;
      }

      .sidebar {
        top: 0;
        z-index: 1005 !important;
      }

      .navbar .navbar-toggler {
        top: 1.25rem !important;
        right: 1rem;
      }

      .nav-link {
        font-size: 26px !important;
      }

      .sair {
        display: none;
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
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" target="_new" href="https://petrec.com.br/pt/"><img src="assets/images/logo.png" class="logo" /></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="w-100"></div>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3 sair" href="#">
          <svg style="width:24px;height:24px;" viewBox="0 0 24 24">
            <path fill="rgb(12 90 108)" ng-attr-d="{{icon.data}}" d="M14.08,15.59L16.67,13H7V11H16.67L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3A2,2 0 0,1 21,5V9.67L19,7.67V5H5V19H19V16.33L21,14.33V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19Z"></path>
          </svg>
        </a>
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
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="mdi mdi-logout-variant"></i>
                Sair
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
                <th style="border-top-left-radius: 5px;" scope="col">Código</th>
                <th scope="col">Linha</th>
                <th style="border-top-right-radius: 5px;" scope="col">Trajeto</th>
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
  <script src="assets/js/script.js"></script>
</body>

</html>