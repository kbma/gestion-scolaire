@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron">
        <h2>Bienvenue!</h2>
        <script type="text/javascript">
            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer",
                        {
                            zoomEnabled: true,
                            panEnabled: true,
                            title:{
                                text: "Nbre des étudiants par mois"
                            },
                            animationEnabled: true,
                            axisY: {
                                title: "Nbre d'inscrit"
                            },
                            legend: {
                                verticalAlign: "bottom",
                                horizontalAlign: "center"
                            },
                            theme: "theme4",
                            data: [

                                {
                                    type: "column",
                                    showInLegend: true,
                                    legendMarkerColor: "grey",
                                    legendText: "Mois",
                                    dataPoints: [
                                        {y: 14, label: "janvier"},
                                        {y: 5,  label: "février" },
                                        {y: 10,  label: "mars"},
                                        {y: 3,  label: "avril"},
                                        {y: 20,  label: "mai"},
                                        {y: 1, label: "juin"},
                                        {y: 23,  label: "juillet"},
                                        {y: 4,  label: "aout"},
                                        {y: 10,  label: "septembre"},
                                        {y: 9,  label: "octobre"},
                                        {y: 11,  label: "novembre"},
                                        {y: 3,  label: "décembre"}

                                    ]
                                }
                            ]
                        });

                chart.render();
            }
        </script>
        <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <div id="chartContainer" style="height: 300px; width: 100%;">
        </div>


    </div>


</div>
@endsection
