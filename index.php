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
  <link href="assets/css/estilo.css" rel="stylesheet">
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
            <li class="nav-item sairDesktop">
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
        <!--DIV PARA EXIBIÇÃO DO GRÁFICO-->
        <div id="grafico">
          <!--DIV SPINNER QUE SOME AO CARREGAR O GRÁFICO-->
          <div class="spinner-border" role="status">
            <span class="visually-hidden"></span>
          </div>
        </div>
        <div id="tabelaOnibusDIV" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Tabela de Ônibus</h2>
        </div>
        <div class="table-responsive">
          <table id="tabelaOnibus" class="display" style="width:100%;margin-bottom:20px">
            <thead>
              <tr>
                <th style="border-top-left-radius: 5px;" scope="col">Código</th>
                <th scope="col">Linha</th>
                <th style="border-top-right-radius: 5px;" scope="col">Trajeto</th>
              </tr>
            </thead>
            <!--TBODY PARA LISTAGEM DA TABELA-->
            <tbody id="listagemTabela">
              <tr class="center">
                <td class="d-none"></td>
                <td class="d-none"></td>
                <td colspan="3" style="line-height: 50px !important;">
                  <!--DIV SPINNER QUE SOME AO CARREGAR A TABELA-->
                  <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                  </div> Aguarde o carregamento das informações
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="mapdivDIV" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Mapa de localização</h2>
        </div>
        <!--DIV PARA EXIBIÇÃO DO MAPA-->
        <div id="mapdiv">
          <!--DIV SPINNER QUE SOME AO CARREGAR O MAPA-->
          <div class="spinner-border" role="status">
            <span class="visually-hidden"></span>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>