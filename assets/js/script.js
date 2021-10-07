$(document).ready(function() {
    carregarListagem();
});

function setDataTable(tableId) {

    $('#' + tableId + ' thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#' + tableId + '  thead');

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
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function() {
            var api = this.api();
            api.columns().eq(0).each(function(colIdx) {
                var cell = $('.filters th').eq(
                    $(api.column(colIdx).header()).index()
                );
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                $('input', $('.filters th').eq($(api.column(colIdx).header()).index())).off('keyup change').on('keyup change', function(e) {
                    e.stopPropagation();
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})';
                    var cursorPosition = this.selectionStart;
                    api.column(colIdx).search(
                        this.value != '' ?
                        regexr.replace('{search}', '(((' + this.value + ')))') : '',
                        this.value != '',
                        this.value == ''
                    ).draw();

                    $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                });
            });
        },

    });
}

function carregarListagem() {

    let settings = {
        url: "dados-brt.json",
        method: "POST"
    }

    $.ajax(settings).done(function(response) {

        let listaOnibus = '';
        let data = [];
        let markers = [];

        $.each(response, function(index, val) {

            $.each(val, function(index2, val2) {

                if (val2.velocidade > 0) {
                    data.push(val2.velocidade);
                }

                markers.push({
                    'latitude': val2.latitude,
                    'longitude': val2.longitude,
                    'trajeto': val2.trajeto,
                    'sentido': val2.sentido,
                    'placa': val2.placa,
                    'velocidade': val2.velocidade
                });

                listaOnibus += `<tr>
                                  <td>${val2.codigo}</td>
                                  <td>${val2.linha}</td>
                                  <td>${val2.trajeto == '' ? '<b style="color:#ccc">Indisponível</b>' : val2.trajeto}</td>
                                </tr>`;

            })
        })

        /* INÍCIO DA LISTAGEM DOS ÔNIBUS NA TABELA*/
        $('#listagemTabela').html(listaOnibus);
        setDataTable('tabelaOnibus');
        /* FINAL DA LISTAGEM DOS ÔNIBUS NA TABELA*/

        /* INÍCIO DO GRÁFICO*/
        min = d3.min(data);
        max = d3.max(data);
        domain = [min, max];

        var margin = { top: 30, right: 30, bottom: 40, left: 60 },
            width = 600 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;

        Nbin = 10;

        var x = d3.scaleLinear().domain(domain).range([0, width]);

        var histogram = d3.histogram().domain(x.domain()).thresholds(x.ticks(Nbin));

        var bins = histogram(data);

        var svg = d3.select("#grafico").html("").classed("svg-container", true).append("svg").attr("preserveAspectRatio", "xMinYMin meet").attr("viewBox", "0 0 600 400").classed("svg-content-responsive", true).append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        d3.select("div#chartId").append("div").classed("svg-container", true).append("svg").attr("preserveAspectRatio", "xMinYMin meet").attr("viewBox", "0 0 600 400").classed("svg-content-responsive", true);

        svg.append("g").attr("transform", "translate(0," + height + ")").call(d3.axisBottom(x));

        svg.append("g").attr("class", "x axis").attr("transform", "translate(0," + height + ")");

        svg.append("text").attr("transform", "translate(" + (width / 2) + " ," + (height + margin.bottom) + ")").style("text-anchor", "middle").text("Velocidade km/h").attr("fill", "#5D6971")

        var y = d3.scaleLinear().range([height, 0]).domain([
            0,
            d3.max(bins, function(d) {
                return d.length;
            })
        ]);

        svg.append("g").call(d3.axisLeft(y));

        svg.append("text").attr("transform", "rotate(-90)").attr("y", 0 - margin.left).attr("x", 0 - (height / 2)).attr("dy", "1em").style("text-anchor", "middle").attr("fill", "#5D6971").text("Quantidade de Ônibus");

        svg.selectAll("rect").data(bins).enter().append("rect").attr("x", 1).attr("transform", function(d) {
            return "translate(" + x(d.x0) + "," + y(d.length) + ")";
        }).attr("width", function(d) {
            return x(d.x1) - x(d.x0) - 1;
        }).attr("height", function(d) {
            return height - y(d.length);
        }).style("fill", "#69b3a2");
        /* FINAL DO GRÁFICO*/

        /* INÍCIO DO MAPA*/
        map = new OpenLayers.Map("mapdiv");
        map.addLayer(new OpenLayers.Layer.OSM());

        epsg4326 = new OpenLayers.Projection("EPSG:4326");
        projectTo = map.getProjectionObject();

        var lonLat = new OpenLayers.LonLat(-43.607968333333332, -22.920806666666667).transform(epsg4326, projectTo);

        var zoom = 16;
        map.setCenter(lonLat, zoom);

        var vectorLayer = new OpenLayers.Layer.Vector("Overlay");

        for (var i = 0; i < markers.length; i++) {

            var lat = markers[i].latitude;
            var lon = markers[i].longitude;
            var nome = markers[i].trajeto;
            var placa = markers[i].placa;
            var sentido = markers[i].sentido;
            var velocidade = markers[i].velocidade;

            var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(lon, lat).transform(epsg4326, projectTo), {
                    description: `<b>Trajeto:</b> ${nome}<br>
                                  <b>Placa:</b> ${placa ? placa : 'Indisponível'}<br>
                                  <b>Sentido:</b> ${sentido ? sentido : 'Indisponível'}<br>
                                  <b>Velocidade:</b> ${velocidade ? velocidade + 'km/h' : 'Indisponível'}`
                }, {
                    externalGraphic: 'https://harrywood.co.uk/maps/examples/openlayers/img/marker.png',
                    graphicHeight: 25,
                    graphicWidth: 21,
                    graphicXOffset: -12,
                    graphicYOffset: -25
                }
            );
            vectorLayer.addFeatures(feature);
            $('#mapdiv').addClass('show');
        }

        map.addLayer(vectorLayer);

        var controls = {
            selector: new OpenLayers.Control.SelectFeature(vectorLayer, {
                onSelect: createPopup,
                onUnselect: destroyPopup
            })
        };

        function createPopup(feature) {
            feature.popup = new OpenLayers.Popup.FramedCloud("pop",
                feature.geometry.getBounds().getCenterLonLat(),
                null,
                '<div class="markerContent">' + feature.attributes.description + '</div>',
                null,
                true,
                function() {
                    controls['selector'].unselectAll();
                }
            );
            map.addPopup(feature.popup);
        }

        function destroyPopup(feature) {
            feature.popup.destroy();
            feature.popup = null;
        }

        map.addControl(controls['selector']);
        controls['selector'].activate();
        /* FINAL DO MAPA*/


    }).fail(function(status) {

        $('#listagemTabela').html(`<tr>
                                <td colspan="3">Não foi possível listar os ônibus</td>
                              </tr>`);

    });
}