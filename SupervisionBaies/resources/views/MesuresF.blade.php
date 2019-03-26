@extends('Layouts.Layout')

@section('content')
<div class="container-fluid">
    <hr style="color: #222222">
    <h1 class="mt-4">Mesures / Bâtiment F</h1>
    <hr style="color: #222222">
</div>

<br><br>

<div id="container" style="height: 400px; min-width: 310px"></div>

<script>
    $.getJSON('./dataGraph', function (data) {
        // Create the chart
        console.log(data);
        
/*Contenu du graphique*/
        Highcharts.stockChart('container', {

            rangeSelector: {
                selected: 1,
                inputEnabled: true,
                buttons: [
                    {count: 1, type: 'day', text: 'Jour'},
                    {count: 1, type: 'week', text: 'Sem'},
                    {count: 1, type: 'month', text: 'Mois'},
                    {count: 1, type: 'year', text: 'Ann'},
                    {type: 'all', text: 'Tout'}
                ]
            },

            title: {
                text: 'Température baie (Bâtiment F)'
            },

            series: [{
                    name: 'Température (°C)',
                    data: data,
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
        });
    });

/*Options du graphique pour le mettre en français*/
    Highcharts.setOptions({
        lang: {
            months: ["Janvier ", "Février ", "Mars ", "Avril ", "Mai ", "Juin ", "Juillet ", "Août ", "Septembre ", "Octobre ", "Novembre ", "Décembre "],
            weekdays: ["Dimanche ", "Lundi ", "Mardi ", "Mercredi ", "Jeudi ", "Vendredi ", "Samedi "],
            shortMonths: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
            decimalPoint: ',',
            resetZoom: 'Reset zoom',
            resetZoomTitle: 'Reset zoom Ã  1:1',
            downloadPNG: "Télécharger au format PNG image",
            downloadJPEG: "Télécharger au format JPEG image",
            downloadPDF: "Télécharger au format PDF document",
            downloadSVG: "Télécharger au format SVG vector image",
            exportButtonTitle: "Exporter image ou document",
            printChart: "Imprimer le graphique",
            noData: "Aucune donnée à  afficher",
            loading: "Chargement..."
        },

    });
</script>

@endsection

@include('INC.Footer')