<?php

namespace App\adms\Controllers;
if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class DetalhePdf {
    //put your code here
    private $Dados;

    public function detalhesPdf($DadosId = null) {

     $this->DadosId = (int) $DadosId;


       
     

            $vis = new \App\adms\Models\helper\AdmsRead();
            $id = $this->DadosId;
          
          $vis->fullRead("SELECT
        tab_infratores.nome_infractor,
        tab_infratores.id,
        tab_infratores.nome_pai,
        tab_infratores.nome_mae,
        tab_infratores.numero_bi,
        tab_infratores.data_nascimento,
        tb_sexo.sexo,
        tab_infratores.nip,
        tb_patente.patente,
        tb_patente.patente_mga,
        adms_crime_comum.descricao_crimecomum,
        adms_crime_militar.descricao_crime_militar,  
        tb_u_e_o.designacao_Unidade,
        tb_processo.processo,
        tb_processo.situacaoprocesso_id,
        tb_estado_processo.descricao_proc,
        tb_ano_instrucao.ano,
        tab_infratores.nome_denuciante,
        tb_processo.instrutor,
        tab_infratores.imagem,
        tab_infratores.created
                
        FROM
        tab_infratores
          
        INNER JOIN tb_sexo ON tb_sexo.id = tab_infratores.sexo        
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tab_infratores.n_processo
        INNER JOIN tb_ano_instrucao ON tb_ano_instrucao.id = tb_processo.anoinstrucao_id
        WHERE tab_infratores.id = '$id'  ");
                
            
            
   


            $pagina = "";

            $pagina .= "<html>
                     
                     
            <style type='text/css'>
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
            .tg .tg-ltev{font-weight:bold;background-color:#d3d3d3;color:#000;border-color:inherit;text-align:center;vertical-align:top}
            .tg .tg-0lax{text-align:left; font-weight:bold; vertical-align:top}
            .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
            .tg .tg-ltef{font-weight:bold;background-color:#ffffff;color:#ffffff;border-color:inherit;text-align:left;vertical-align:top}
            </style>

            <body>
            
            <div class='container' >
            <div class='row' align='center' >
                <img  id='logo' src='./assets/imagens/logo_login/logofaa.png'  class='img-responsive' style='width: 50px; height:50px; '>
            </div>
            <div class='row' align='center' >
                <span ></span><br>
                <span style='font-size: 14px;'>ESTADO MAIOR GENERAL</span><br>
                <span ><b>POLICIA JUDICIARIA MILITAR DAS FORÇAS ARMADAS ANGOLANAS</b></span><br>
                <span ><b></b></span><br><br>

                <span ><b>Ficha Individual de Infractor</span><br>
            </div>

            <div class='row' align='right' >";
                foreach ($vis->getResultado() as $linhas_cont):
                         extract($linhas_cont);
                    if (!empty($imagem)) {
                         $pagina .= "<img src='" . URLADM . "assets/imagens/infractor/" . $linhas_cont['id'] . "/" . $linhas_cont['imagem'] . "' witdh='110' height='110'>";
                    } else {
                         $pagina .="<img src='" . URLADM . "assets/imagens/infractor/icone_usuario.png' witdh='110' height='110'>";
                    }
                    
            $pagina .= "</div>

            </div>";
                     

        
        
           

         $pagina .= " 
            <table class='' align='center' style='width: 550px; border: none;' >

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Nip:</b></td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['nip'] ."</td>
                </tr>
                
                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Nome do Infractor:</b></td>
                    <td c style='width: 200px'>" .$linhas_cont['nome_infractor'] ."</td>

                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Nome do Pai:</b></td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['nome_pai'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Nome da Mãe:</b></td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['nome_mae']."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Número do Bilhete:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['numero_bi'] ."</td>
                </tr>


                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Data de Nascimento:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['data_nascimento']."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Sexo:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" . $linhas_cont['sexo'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Patente:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" . $linhas_cont['patente'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Unidade:</b> </td>
                    <td class='tg-0pky' style='width: 250px'>" . $linhas_cont['designacao_Unidade'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Número do Processo:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['processo'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Crime Militar:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['descricao_crime_militar'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Crime Comum:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['descricao_crimecomum'] ."</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Nome do Instrutor:</b> </td>
                    <td class='tg-0pky' style='width: 200px'>" .$linhas_cont['instrutor'] . "</td>
                </tr>

                <tr >
                    <td class='tg-0lax' style='width: 100px'><b></b> </td>
                </tr>

                <tr style='border: none'>
                    <td class='tg-0lax' style='width: 100px'><b>Data e Hora do Registo:</b></td>
                    <td class='tg-0pky' style='width: 200px'>" . $linhas_cont['created'] . "</td>
                </tr>";
             endforeach;
            $pagina .= " 
            </table>   <br><br> <br><br>
              
       <div class='row' align='center' ><br>               
              <span >Luanda, aos  " . strftime('%d de %B de %Y', strtotime('today'))."  </span><br><br>
        </div>

            <div class='row' align='center' ><br>
            <span ><b>O CHEFE DA RIIC/PJMFAA</b></span><br>
            <span ><b>_________________________________</b></span><br>
            <span ><b>---------------</b></span><br>
            <span ><b>Coronel</b></span><br>
        </div>

    </body>
		</html>
		";

            $arquivo = "Ficha do Infractor.pdf";

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($pagina);
            $mpdf->Output($arquivo, 'I');

            // I - Abre no navegador
            // F - Salva o arquivo no servido
            // D - Salva o arquivo no computador do usuário
        
    }
}
