<?php

namespace App\adms\relatorios;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('Africa/Luanda');
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "ginfra";
//Criar a conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);




$resultado = mysqli_query($conn,"SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tb_patente.patente,
        tab_infraccoes.designacao_infraccao,
        tb_processo.processo,
        tb_u_e_o.designacao_Unidade,
        tb_estado_processo.descricao_proc
        FROM
        tab_infratores
        INNER JOIN tb_patente ON tb_patente.id = tab_infratores.cod_patente
        INNER JOIN tab_infraccoes ON tab_infraccoes.id = tab_infratores.id_infraccoes
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade ");
$linhas_cont = mysqli_num_rows($resultado);




//  $total_p = mysql_num_rows($total_pessoas);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Informação Integrado do Instituto Superior Técnico Militar</title>


        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-v2hy{font-weight:bold;background-color:#34696d;color:#ffffff;text-align:left}
            .tg .tg-fuer{font-weight:bold;background-color:#34696d;color:#ffffff;text-align:left;vertical-align:top}
            .tg .tg-s268{text-align:left}
            .tg .tg-0lax{text-align:left;vertical-align:top}
        </style>
    </head>
    <body >

        <div class="container" >
            <div class="row" align="center" >
 
            </div>
            <div class="row" align="center" >
                <span style="">FORÇAS ARMADAS ANGOLANAS</span><br>
                <span style="font-size: 14px;">ESTADO MAIOR GENERAL</span><br>
                <span style=""><b>CONSELHO SUPERIOR DE DISCIPLINA MILITAR</b></span><br><br><br><br>
                <span style=""><b>MAPA GERAL DOS INFRACTORES</b></span><br><br>


            </div>
        </div>


        <table class="tg" align="center" style="width: 800px;">
            <tr>
                <th class="tg-v2hy">id</th>
                <th class="tg-v2hy" style="width: 50px">N-Proc</th>
                <th class="tg-v2hy" style="width: 200px">Nome do Infractor</th>
                <th class="tg-fuer" style="width: 130px">Patente</th>
                <th class="tg-fuer" style="width: 130px">Unidade</th>
                <th class="tg-fuer" style="width:70px">Estado do Processo</th>
            </tr>

            <?php
            
            while ($linhas_cont = mysqli_fetch_array($resultado)) {
                ?>

                <tr>
                    <td class="tg-s268"><?php echo $linhas_cont['id']; ?></td>
                    <td class="tg-s268" style="width: 50px"><?php echo $linhas_cont['processo']; ?></td>
                    <td class="tg-s268" style="width: 200px"><?php echo $linhas_cont['nome_infractor']; ?></td>
                    <td class="tg-0lax" style="width: 130px"><?php echo $linhas_cont['patente']; ?></td>
                    <td class="tg-0lax" style="width: 130px"><?php echo $linhas_cont['designacao_Unidade']; ?></td>
                    <td class="tg-0lax" style="width:70px"><?php echo $linhas_cont['descricao_proc']; ?></td>
                </tr>
                
                <?php }
            ?>

        </table>




        <div class="row" align="center" ><br><br>
                  <span >LUANDA AOS <?php echo strtoupper(strftime('%d de %B de %Y', strtotime('today'))); ?> </span><br><br>

            <span ><b>O Responsável</b></span><br><br>
            <span ><b>_________________________________</b></span><br>
        </div>
    </body>
</html>



