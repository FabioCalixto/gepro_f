<html>

    <script src="<?php echo URLADM . 'assets/js/slim.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/popper.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/dashboard.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/jquery-3.2.1.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/highcharts.js'; ?>"></script> 
    <script src="<?php echo URLADM . 'assets/js/exporting.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/export-data.js'; ?>"></script>


    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Estatística de Infractores </h2>
                </div>

                <a href="<?php echo URLADM; ?>controle-home/index">
                    <div class="p-2">
                        <button class="btn btn-outline-danger btn-sm">
                            Fechar
                        </button>
                    </div>
                </a>


            </div>
            <?php

               // var_dump($this->Dados['estatisticaPatente']);
            ?>
            <hr>

        
            <div class="form-row">
                <div class="form-group col-md-3.1">
                    <select  name="tipo_lista" id="grafico">
                        <option value="">Selecione a Estatística</option>
                        <option value="1">Por Crimes Militar</option>
                        <option value="2">Por Crimes Comum</option>
                        <option value="3">Por Posto</option>
                        <option value="4">Por Sexo</option>
                        <option value="5">Por Ano de Instrução</option>
                    </select> 
                </div>
            </div>

<div id="militar" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; display: none;"></div>

<script type="text/javascript">

                            // Create the chart
Highcharts.chart('militar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Infratores Por Crimes Militar'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>total de <b>{point.y:.1f}%</b> Existente<br/>'
    },

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [
                <?php
                    $i=1;
                    foreach ($this->Dados['estatisticaCrime'] as $estatisticaCrime) {
                                                           
                           if ($i==count($this->Dados['estatisticaCrime'])) {
                                                        
                                echo '{
                                    name: "'.$estatisticaCrime['militar'].'",
                                    y:'.$estatisticaCrime['percentage'].',
                                    drilldown: "'.$estatisticaCrime['militar'].'"
                                                                    
                                      }';
                            }else{
                                echo '{
                                    name: "'.$estatisticaCrime['militar'].'",
                                    y:'.$estatisticaCrime['percentage'].',
                                    drilldown: "'.$estatisticaCrime['militar'].'"
                                                                      
                                        },';
                                }
                                                        
                         $i++;
                    }
                                              
                ?>
               
            ]
        }
    ],

});
                  
</script>                      
           
<div id="crime" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; display: none;"></div>

<script type="text/javascript">

                            // Create the chart
Highcharts.chart('crime', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Infratores Por Crimes Comuns'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>total de <b>{point.y:.1f}%</b> Existente<br/>'
    },

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [
                <?php
                    $i=1;
                    foreach ($this->Dados['estatisticaNatureza'] as $estatisticaNatureza) {
                                                           
                           if ($i==count($this->Dados['estatisticaNatureza'])) {
                                                        
                                echo '{
                                    name: "'.$estatisticaNatureza['crime'].'",
                                    y:'.$estatisticaNatureza['percentage'].',
                                    drilldown: "'.$estatisticaNatureza['crime'].'"
                                                                    
                                      }';
                            }else{
                                echo '{
                                    name: "'.$estatisticaNatureza['crime'].'",
                                    y:'.$estatisticaNatureza['percentage'].',
                                    drilldown: "'.$estatisticaNatureza['crime'].'"
                                                                      
                                        },';
                                }
                                                        
                         $i++;
                    }
                                              
                ?>
               
            ]
        }
    ],

});
                  
</script>


<div id="posto" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto;display: none;"></div>

<script type="text/javascript">

                            // Create the chart
Highcharts.chart('posto', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Infractores por Posto '
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: total de <b>{point.y:.1f}%</b> Existente<br/>'
    },

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [
                <?php
                    $i=1;
                    foreach ($this->Dados['estatisticaPatente'] as $estatisticaPatente) {

                                                        
                            if ($i==count($this->Dados['estatisticaPatente'])) {
                                                        
                                echo '{
                                    name: "'.$estatisticaPatente['patente_policia'].'",
                                    y:'.$estatisticaPatente['percentage'].',
                                    drilldown: "'.$estatisticaPatente['patente_policia'].'"
                                                                    
                                      }';
                            }else{
                                echo '{
                                     name: "'.$estatisticaPatente['patente_policia'].'",
                                    y:'.$estatisticaPatente['percentage'].',
                                    drilldown: "'.$estatisticaPatente['patente_policia'].'"
                                                                      
                                        },';
                                }
                                                        
                         $i++;
                    }
                                              
                ?>
               
            ]
        }
    ],

});
                  
</script>

<div id="sexo" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto;display: none;"></div>

<script type="text/javascript">

                            // Create the chart
Highcharts.chart('sexo', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Infractores por Sexo  '
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: total de <b>{point.y:.1f}%</b> Existente<br/>'
    },

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [
                <?php
                    $i=1;
                    foreach ($this->Dados['estatisticaPorSexo'] as $estatisticaPorSexo) {

                                                        
                            if ($i==count($this->Dados['estatisticaPorSexo'])) {
                                                        
                                echo '{
                                    name: "'.$estatisticaPorSexo['perSe'].'",
                                    y:'.$estatisticaPorSexo['percentage'].',
                                    drilldown: "'.$estatisticaPorSexo['perSe'].'"
                                                                    
                                      }';
                            }else{
                                echo '{
                                     name: "'.$estatisticaPorSexo['perSe'].'",
                                    y:'.$estatisticaPorSexo['percentage'].',
                                    drilldown: "'.$estatisticaPorSexo['perSe'].'"
                                                                      
                                        },';
                                }
                                                        
                         $i++;
                    }
                                              
                ?>
               
            ]
        }
    ],

});
              

</script>

<div id="ano" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; display: none;"></div>

<script type="text/javascript">

                            // Create the chart
Highcharts.chart('ano', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Processos Por ano de Instrução'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>total de <b>{point.y:.1f}%</b> Existente<br/>'
    },

    series: [
        {
            name: "",
            colorByPoint: true,
            data: [
                <?php
                    $i=1;
                    foreach ($this->Dados['estatisticaano'] as $estatisticaano) {
                         
                                
                            if ($i==count($this->Dados['estatisticaano'])) {
                                                        
                                echo '{
                                    name: "'.$estatisticaano['ano'].'",
                                    y:'.$estatisticaano['percentage'].',
                                    drilldown: "'.$estatisticaano['ano'].'"
                                                                    
                                      }';
                            }else{
                                echo '{
                                     name: "'.$estatisticaano['ano'].'",
                                    y:'.$estatisticaano['percentage'].',
                                    drilldown: "'.$estatisticaano['ano'].'"

                                        },';
                                }
                                                        
                         $i++;
                    }
                                              
                ?>
               
            ]
        }
    ],

});
                  
</script>


<script type="text/javascript">

        $('#grafico').change(function () {
            var valor = $(this).val();

            if (valor == '') {
                $('#militar #crime #posto #sexo #ano').hide();
            }

            if (valor == 1) {
//alert(valor);
                $('#militar').show();
            } else {
                $('#militar').hide();   
            }

             if (valor == 2) {
//alert(valor);
                $('#crime').show();
            } else {
                $('#crime').hide();   
            }


            if (valor == 3) {
//alert(valor);
                $('#posto').show();
            } else {
                $('#posto').hide();
            }


            if (valor == 4) {
//alert(valor);
                $('#sexo').show();
            } else {
                $('#sexo').hide();
            }

             if (valor == 5) {
//alert(valor);
                $('#ano').show();
            } else {
                $('#ano').hide();
            }

        });

    </script>

</html>
