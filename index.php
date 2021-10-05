<!doctype html>
<html lang="en">

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

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .table-responsive {
      margin-bottom: 50px;
    }
  </style>
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" target="_new" href="https://petrec.com.br/pt/">PETREC</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
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
              <a class="nav-link active" aria-current="page" href="#">
                <i class="mdi mdi-align-vertical-bottom"></i>
                Gráfico
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-list-numbered"></i>
                Listagem
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="mdi mdi-map-marker-radius"></i>
                Mapa
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Gráfico</h1>
        </div>

        <div id="grafico"></div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
      </main>
    </div>
  </div>


  <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      carregarListagem();
    });

    function setDataTable(tableId) {

      $('#' + tableId).DataTable({

        order: [1, 'esc'],
        ordering: false,
        language: {
          'search': 'Filtrar',
          "thousands": ".",
          'emptyTable': 'Nenhum registro encontrado',
          "zeroRecords": 'Nenhum registro encontrado',
          'lengthMenu': '_MENU_ por página',
          "infoEmpty": "Exibindo 0 a 0 de 0 registros",
          "info": "Exibindo _START_ a _END_ de _TOTAL_ registros",
          "infoFiltered": "",
          "paginate": {
            "first": "Primeiro",
            "last": "Último",
            "next": "<i class='mdi mdi-chevron-double-right'></i>",
            "previous": "<i class='mdi mdi-chevron-double-left'></i>"
          }
        },
        lengthMenu: [
          [10, 25, 50, 100, -1],
          [10, 25, 50, 100, "TODOS"]
        ],
        destroy: false,
        searching: true,
        retrieve: true,
        paging: true,

      });
    }

    function carregarListagem() {

      let settings = {
        url: "dados-brt.json",
        method: "POST"
      }

      $.ajax(settings).done(function(response) {


        let listaOnibus = '';

        $.each(response, function(index, val) {

          $.each(val, function(index2, val2) {

            if(val2.velocidade > 0) {
              console.log(val2.velocidade)
            }

            listaOnibus += `<tr>
                  <td>${val2.codigo}</td>
                  <td>${val2.linha}</td>
                  <td>${val2.trajeto}</td>
                </tr>`;

          })


        })

        $('#listagemTabela').html(listaOnibus);

        setDataTable('tabelaOnibus');

      }).fail(function(status) {

        $('#listagemTabela').html(`<tr>
                                    <td colspan="3">Não foi possível listar os ônibus</td>
                                  </tr>`);

      });
    }
  </script>
  <script>
    // definir as dimensões e margens do gráfico
    var margin = {
        top: 10,
        right: 30,
        bottom: 30,
        left: 40
      },
      width = 460 - margin.left - margin.right,
      height = 400 - margin.top - margin.bottom;

    // anexar o objeto svg ao corpo da página
    var svg = d3.select("#grafico")
      .append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
      .append("g")
      .attr("transform",
        "translate(" + margin.left + "," + margin.top + ")");
    
        
    // pegue os dados
    d3.csv("https://raw.githubusercontent.com/holtzy/data_to_viz/master/Example_dataset/1_OneNum.csv", function(data) {
      
      //Eixo X: dimensionar e desenhar:
      var x = d3.scaleLinear()
        .domain([0, 1000]) // pode usar isso em vez de 1000 para ter o máximo de dados: d3.max(data, function(d) { return +d.price })
        .range([0, width]);
      svg.append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x));

      // defina os parâmetros para o histograma
      var histogram = d3.histogram()
        .value(function(d) {
          return d.price;
        }) // Eu preciso dar o vetor de valor
        .domain(x.domain()) // então o domínio do gráfico
        .thresholds(x.ticks(70)); // então o número de caixas

      // E aplique esta função aos dados para obter as caixas
      var bins = histogram(data);

      // Eixo Y: dimensionar e desenhar:
      var y = d3.scaleLinear()
        .range([height, 0]);
      y.domain([0, d3.max(bins, function(d) {
        return d.length;
      })]); // d3.hist deve ser chamado antes do eixo Y, obviamente
      svg.append("g")
        .call(d3.axisLeft(y));

      // acrescente os retângulos da barra ao elemento svg
      svg.selectAll("rect")
        .data(bins)
        .enter()
        .append("rect")
        .attr("x", 1)
        .attr("transform", function(d) {
          return "translate(" + x(d.x0) + "," + y(d.length) + ")";
        })
        .attr("width", function(d) {
          return x(d.x1) - x(d.x0) - 1;
        })
        .attr("height", function(d) {
          return height - y(d.length);
        })
        .style("fill", "#69b3a2")

    });
  </script>
</body>

</html>