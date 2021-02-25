$(document).ready(function(){




    $('#adms_condicao_id').change(function () {
        var valor = $(this).val();
   if ( valor == 1){
           $('#nip').show();
           $('#cod_patente').show();
           $('#cod_ramo').show();
             
        $('#nip').attr('required', true);
        $('#cod_patente').attr('required', true); 
        $('#cod_ramo').attr('required', true);            
   }
        if (valor == 2) {
//alert(valor);
            $('#nip').hide();
            $('#cod_patente').hide();
            $('#cod_ramo').hide();
            }    
    });

/*
    $('#id_ramo').change(function () {
        var valor = $(this).val();
   if ( valor == 1 ){
           $('#patente').show();
           $('#patente_mga').hide();
       }

if ( valor == 2 ){
           $('#patente').show();
           $('#patente_mga').hide();
       }

if ( valor == 3 ){
           $('#patente').show();
           $('#patente_mga').hide();
       }

        if (valor == 4) {
//alert(valor);
            $('#patente_mga').show();
            $('#patente').hide();
        } 
        
        
    });*/
 $.ajax({
            //di.emg.net
            //192.168.20.2
            url : 'http://localhost/Gepro/app/adms/Views/carregardadosdependentes.php',
            type:'POST',
            data:{parametro:1,accao:'Buscar Patente'},         
            success:function(dados){
                console.log(dados);
                $('#'+comboBox).html(dados);
            },
            dataType:'json'
        });

   



  
    function carregarDependecias(parametro,comboBox=null,accao=null){

         

        $.ajax({
            //di.emg.net
            //192.168.20.2
            url : 'http://localhost/Gepro/app/adms/Views/carregardadosdependentes.php',
            type:'POST',
            data:{parametro:parametro,accao:accao},         
            success:function(dados){
                console.log(dados);
                $('#'+comboBox).html(dados);
            },
            dataType:'json'
        });

    }


    $('#ramoPatente').on('change', function(){
    
    var ramoPatente = $(this).val();
   
     carregarDependecias(ramoPatente,'cod_patente','Buscar Patente');

    });



    $('#pais').on('change', function(){

    var pais = $(this).val();
     carregarDependecias(pais,'provincia','Buscar Provincias');

    });

    $('#provincia').on('change', function(){

    var provincia = $(this).val();
    
    carregarDependecias(provincia,'municipio','Buscar Municipios');

    });


$('#nivel_academico').on('change', function(){

    var nivel_academico = $(this).val();
    carregarDependecias(nivel_academico,'habilitacao_literaria','Buscar Habilitacao');

});




$('#nivelAcademicoF').on('change', function(){

    var nivel_academico = $(this).val();
   
    carregarDependecias(nivel_academico,'cod_curso_academico','Buscar Curso');

});



$('#curso_militar').on('change', function(){

    var curso_militar = $(this).val();
    carregarDependecias(curso_militar,'curso_especialidade','Buscar CursoEspecialidade');

});


$('#ramo').on('change', function(){

    var ramo = $(this).val();
    carregarDependecias(ramo,'regiao','Buscar Regiao');

});

$('#ramo').on('change', function(){

    var ramo = $(this).val();
    carregarDependecias(ramo,'unidade','Buscar Unidade');

});

$('#areaCertificacao').on('change', function(){

    var areaCertificacao = $(this).val();
    carregarDependecias(areaCertificacao,'certificado','Buscar Certificados');

});



  
$('#filtroEspecialista').on('change', function(){
    
    var dadosFiltro = $(this).val();            

    $('.divResultadoEspecialista').html('');

    if (dadosFiltro == 1) {

        $('#patenteEspecialista,#unidadeEspecialista,#divRamo').hide();

            $('#nipEstatistica').show();

            $("[name='nip']").attr("required", true);
            $("[name='ramo']").attr("required", false);
            $("[name='unidade']").attr("required", false);
            $("[name='patente']").attr("required", false);

    }
        else if (dadosFiltro == 2) {

        $('#patenteEspecialista,#nipEstatistica').hide();

            $('#unidadeEspecialista, #divRamo').show();
            $("[name='nip']").attr("required", false);
            $("[name='unidade']").attr("required", true);
            $("[name='patente']").attr("required", false);
            $("[name='ramo']").attr("required", true);

    }
        else if(dadosFiltro == 3){

            $('#patenteEspecialista').show();

            $('#unidadeEspecialista,#nipEstatistica,#divRamo').hide();

            $("[name='nip']").attr("required", false);

            $("[name='unidade']").attr("required", false);
            $("[name='ramo']").attr("required", false);
            $("[name='patente']").attr("required", true);

        } else{

            $('#unidadeEspecialista,#patenteEspecialista,#divRamo').show();
            $('#nipEstatistica').hide();
            $("[name='nip']").attr("required", false);
            $("[name='unidade']").attr("required", true);
            $("[name='patente']").attr("required", true);
            $("[name='ramo']").attr("required", true);
        }


});  


$('#filtroCompetencia').on('change', function(){
    
    var dadosFiltro = $(this).val();

    $('.divResultadoEspecialista').html('');

    if (dadosFiltro == 0) {

        $('#patenteEspecialista,#unidadeEspecialista,#divcursoMilitar,#divareaCertificacao,#divcertificado,#separador2,#separador1,#divRamo').hide();

            $('#divgrauAcademico,#divNivelAcademico').show();
            $("[name='nivel_academico']").attr("required", true);
            $("[name='habilitacao_literaria']").attr("required", true);
            $("[name='areaCertificacao']").attr("required", false);
            $("[name='certificado']").attr("required", false);
            $("[name='cursoMilitar']").attr("required", false);
            $("[name='ramo']").attr("required", false);

    }
        else if (dadosFiltro == 1) {

        $('#divNivelAcademico,#patenteEspecialista,#unidadeEspecialista,#divgrauAcademico,#divareaCertificacao,#divcertificado,#separador2,#separador1').hide();

            $('#divcursoMilitar').show();
            $("[name='nivel_academico']").attr("required", false);
            $("[name='habilitacao_literaria']").attr("required", false);
            $("[name='areaCertificacao']").attr("required", false);
            $("[name='certificado']").attr("required", false);
            $("[name='ramo']").attr("required", false);
            $("[name='cursoMilitar']").attr("required", true);

    }
        else if(dadosFiltro == 2){

            $('#divNivelAcademico,#patenteEspecialista,#unidadeEspecialista,#divgrauAcademico,#divcursoMilitar,#separador2,#separador1').hide();

            $('#divareaCertificacao,#divcertificado').show();
            $("[name='nivel_academico']").attr("required", false);
            $("[name='habilitacao_literaria']").attr("required", false);
            $("[name='areaCertificacao']").attr("required", true);
            $("[name='certificado']").attr("required", true);
            $("[name='cursoMilitar']").attr("required", false);
            $("[name='ramo']").attr("required", false);

        } else{

            $('#divNivelAcademico,#divRamo,#patenteEspecialista,#unidadeEspecialista,#divgrauAcademico,#divareaCertificacao,#divcertificado,#divcursoMilitar,#separador2,#separador1').show();
            $("[name='nivel_academico']").attr("required", true);
            $("[name='habilitacao_literaria']").attr("required", true);
            $("[name='areaCertificacao']").attr("required", true);
            $("[name='certificado']").attr("required", true);
            $("[name='cursoMilitar']").attr("required", true);
        }

}); 
                        

$('#filtroEstatistica').on('change', function(){
    
    var dadosFiltro = $(this).val();

    $('.divResultadoEstatistica').html('');

    if (dadosFiltro == 1) {

        $('#temposervicoEstatistica,#idadeEstatistica').hide();

            $('#unidadeEstatistica,#patenteEstatistica,#divRamo').show();
            $("[name='unidade']").attr("required", true);
            $("[name='idade']").attr("required", false);
            $("[name='temposervico']").attr("required", false);
            $("[name='ramo']").attr("required", true);



    }
        else if(dadosFiltro == 2){

            $('#unidadeEstatistica,#idadeEstatistica,#patenteEstatistica,#divRamo').show();

            $('#temposervicoEstatistica').hide();
            $("[name='unidade']").attr("required", true);
            $("[name='idade']").attr("required", true);
            $("[name='temposervico']").attr("required", false);
            $("[name='ramo']").attr("required", true);
            
            

        } else{
             

            $('#unidadeEstatistica,#temposervicoEstatistica,#patenteEstatistica,#divRamo').show();

            $('#idadeEstatistica').hide();
            $("[name='unidade']").attr("required", true);
            $("[name='idade']").attr("required", false);
            $("[name='temposervico']").attr("required", true);
            $("[name='ramo']").attr("required", true);
            
        }


});

/*var dadosJson = $("#dadosEstatisticos").html();
var obJson = JSON.parse(dadosJson);
    // Radialize the colors
Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
        radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7
        },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});

// Build the chart
Highcharts.chart('RepresentaGrafico', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Percentagem',
        data: [

            
                            
                { 
                    
                    name: "Posto: "+obJson[0]['Posto'], y: obJson[0]['Percentagem']
                  
                }         

       
        ]
    }]
});*/


/*--------------------pie------------------------------------
var dadosJson = $("#dadosEstatisticos").html();
var obJson = JSON.parse(dadosJson);

var percentagemPosto = new Array();
for (var i =0; i<obJson.length; i++) {
    percentagemPosto[i]=obJson[i].Percentagem;
}

console.log(percentagemPosto.join("',"));    

var dados = "jose"+","+"Resi";                    
                        
  //bar
  var ctxB = document.getElementById("pieChart1").getContext('2d');
  var myBarChart = new Chart(ctxB, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: [],
        data: [percentagemPosto.join()],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

------------------------fim pie----------------------------*/


const uploadButton = document.querySelector('.btnfoto');
//const fileInfo = document.querySelector('.file-info');
const realInput = document.getElementById('imagem_nova');

uploadButton.addEventListener('click', () => {
  realInput.click();
});

realInput.addEventListener('change', () => {
  const name = realInput.value.split(/\\|\//).pop();
  const truncated = name.length > 20 
    ? name.substr(name.length - 20) 
    : name;
  
 // fileInfo.innerHTML = truncated;
});

  
});