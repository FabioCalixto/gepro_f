$(document).ready(function () {
    var pagina = 1; //página inicial    
    listar_infractor(pagina);

});

function listar_infractor(pagina, varcomp = null) {
    var dados = {
        pagina: pagina
    };
    
    $.post('../carregar-infractores-js/listarInfractoresJs/' + pagina + '?tiporesult=1', dados, function (retorna) {
        $("#conteudo").html(retorna);
    });
}

$(function (){
    //Vefificando se o usuário digitou algum valor na procura
    
    $("#pesqInfractor").keyup(function (){
        var pesqInfractor = $(this).val();
        
        //verificar se há valor na variavel "pesqInfractor"
        
        if (pesqInfractor !== ''){
            
            var dados = {
                
                palavraPesq: pesqInfractor
                
            };
              $.post('../carregar-infractores-js/listarInfractoresJs/1?tiporesult=2', dados, function (retorna) {
        $("#conteudo").html(retorna);
    });
        }else{
            var pagina = 1;//pagina inicial
            listar_infractor(pagina);
            
            
        }
        
    });
    
});

