<meta charset="utf-8">
<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
//$temo = new \App\adms\Controllers\Tempo_sessao();
//$temo->inicializa_sessao('10', 10);
?>
<div class="content p-1" >
    <div class="list-group-item" >
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo"></h2>
                <hr>
            </div>
        </div>
        <div class="row mb-3">
            <html>
                <head>
                    
                    <script src="<?php echo URLADM . 'assets/js/loader.js'; ?>"></script>
                   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
                    <script type="text/javascript">
                        google.charts.load('current', {'packages': ['gauge']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                                ['Label', 'Value'],
                                ['Memoria', 80],
                                ['CPU', 55],
                                ['Internet', 68]
                            ]);

                            var options = {
                                width: 600, height: 220,
                                redFrom: 90, redTo: 100,
                                yellowFrom: 75, yellowTo: 90,
                                minorTicks: 5
                            };

                            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                            chart.draw(data, options);

                            setInterval(function () {
                                data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
                                chart.draw(data, options);
                            }, 13000);
                            setInterval(function () {
                                data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
                                chart.draw(data, options);
                            }, 5000);
                            setInterval(function () {
                                data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
                                chart.draw(data, options);
                            }, 26000);
                        }
                    </script>
                </head>
                <body>
                   <!-- <div id="chart_div" style="width: 500px; height: 180px;"></div>!-->
                   <div align='center'>
                       <img src="../assets/imagens/icone/gepro.png" class="img-fluid" style="width: 75%; height: 100%">
                   </div>
                
                </body>
            </html>
        </div>
    </div>