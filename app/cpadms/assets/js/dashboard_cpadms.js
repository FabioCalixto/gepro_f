$(document).ready(function () {
    var pagina = 1; //página inicial    
    listar_usuario(pagina);

});

function listar_usuario(pagina, varcomp = null) {
    var dados = {
        pagina: pagina
    };
    
    $.post('../carregar-usuarios-js/listar/' + pagina + '?tiporesult=1', dados, function (retorna) {
        $("#conteudo").html(retorna);
    });
}

