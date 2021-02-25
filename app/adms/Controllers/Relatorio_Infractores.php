<?php

namespace App\adms\Controllers;
if (!defined('URL')) {
    header("Location: /");
    exit();
}
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('Africa/Luanda');
/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class Relatorio_Infractores {
    //put your code here
    
    

    private $Dados;

    public function gerarPdf() {



        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendReportParam'])) {
            unset($this->Dados['SendReportParam']);

            $vis = new \App\adms\Models\helper\AdmsRead();
            $pais = $this->Dados['pais'];
            if (!empty($this->Dados['rad_geral']) and $this->Dados['tipo_lista'] == '2'){
                         $vis->fullRead("SELECT
                adms_bolseiros.id,
                adms_bolseiros.nome_bolseiro,
                adms_bolseiros.apelido_bolseiro,
                adms_bolseiros.data_nascimento,
                adms_condicao.descricao_codicao,
                adms_pais.descricao_pais,
                adms_postos.descricao_posto,
                adms_bolseiros.data_iniciobolsa,
                adms_bolseiros.data_fimbolsa,
                adms_bolseiros.adms_curso_id
                FROM
                adms_bolseiros
                INNER JOIN adms_condicao ON adms_condicao.id = adms_bolseiros.adms_condicao_id
                INNER JOIN adms_pais ON adms_pais.id = adms_bolseiros.adms_pais_id
                INNER JOIN adms_postos ON adms_postos.id = adms_bolseiros.adms_posto_id
                WHERE
                adms_bolseiros.adms_pais_id = '$pais' ");
                
            }else{
                
                $vis->fullRead('SELECT
                adms_bolseiros.id,
                adms_bolseiros.nome_bolseiro,
                adms_bolseiros.apelido_bolseiro,
                adms_bolseiros.data_nascimento,
                adms_condicao.descricao_codicao,
                adms_pais.descricao_pais,
                adms_postos.descricao_posto,
                adms_bolseiros.data_iniciobolsa,
                adms_bolseiros.data_fimbolsa,
                adms_bolseiros.adms_curso_id
                FROM
                adms_bolseiros
                INNER JOIN adms_condicao ON adms_condicao.id = adms_bolseiros.adms_condicao_id
                INNER JOIN adms_pais ON adms_pais.id = adms_bolseiros.adms_pais_id
                INNER JOIN adms_postos ON adms_postos.id = adms_bolseiros.adms_posto_id');
                
            }
            
   


            $pagina = "";

            $pagina .= "<html>
                     
                     
        <style type='text/css'>           
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg .tg-j5ry{font-weight:bold;font-family:Georgia, serif !important;;background-color:#656565;color:#ffffff;border-color:inherit;text-align:left;vertical-align:top}
        .tg .tg-zc3b{font-weight:bold;font-family:Georgia, serif !important;;background-color:#656565;color:#ffffff;border-color:inherit;text-align:left}
        .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
        .tg .tg-xldj{border-color:inherit;text-align:left}
        .tg .tg-y698{background-color:#efefef;border-color:inherit;text-align:left;vertical-align:top}
        </style>

            <body>
            
             
           <div class='container' >
              <div class='row' align='center' >
              <img  id='logo' src='./assets/imagens/logo_login/logofaa.png'  class='img-responsive' style='width: 50px; height:50px; '>
            </div>
            <div class='row' align='center'>
                <span style=''>FORÇAS ARMADAS ANGOLANAS</span><br>
                <span style='font-size: 14px;'>ESTADO MAIOR GENERAL</span><br>
                <span style=''><b>DIRECÇÃO PRINCIPAL DE PREPRARAÇÃO DE TROPAS E ENSINO</b></span><br><br><br><br>
                <span style=''><b></b></span><br><br>


            </div>
        </div>
               
        
            <table class='tg' style='undefined;table-layout: fixed; width: 937px'>
            <colgroup>
            <col style='width: 33px'>
            <col style='width: 289px'>
            <col style='width: 145px'>
            <col style='width: 153px'>
            <col style='width: 120px'>
            <col style='width: 113px'>
            <col style='width: 84px'>
            </colgroup>
              <tr>
                <th class='tg-zc3b'>ID</th>
                <th class='tg-zc3b'>Nome</th>
                <th class='tg-j5ry'>Curso</th>
                <th class='tg-j5ry'>Data de Inicio</th>
                <th class='tg-j5ry'>Data Fim</th>
                <th class='tg-j5ry'>Codição</th>
                <th class='tg-zc3b'>Pais</th>
              </tr>";

            foreach ($vis->getResultado() as $bolseiro):
                extract($bolseiro);

                $pagina .= "<tr>
                <td class='tg-s268'>" . $bolseiro['id'] . "</td>
                <td class='tg-s268'>" . utf8_decode($bolseiro['nome_bolseiro']) . "</td>
                <td class='tg-0lax'>" . utf8_encode($bolseiro['adms_curso_id']) . "</td>
                <td class='tg-0lax'>" . $bolseiro['data_iniciobolsa'] . "</td>
                <td class='tg-0lax'>" . $bolseiro['data_fimbolsa'] . "</td>
                <td class='tg-0lax'>" . $bolseiro['descricao_codicao'] . "</td>
               <td class='tg-s268'>" . utf8_decode($bolseiro['descricao_pais']) . "</td>
              </tr>";
            endforeach;
            $pagina .= " 
               <tr>
            <td class='tg-y698' colspan='7'></td>
          </tr>
          <tr>
            <td class='tg-0pky' colspan='5'><b> Quantidade Total de Estudantes: </b></td>
            <td class='tg-0pky' colspan='2'></td>
          </tr>
              </table> <br><br>                   
              <span >Luanda aos  " . strftime('%d de %B de %Y', strtotime('today'))."  </span><br><br>

            <div class='row' align='center' ><br><br>

            
            <span ><b>O CHEFE DA DPPTE/EMGFAA</b></span><br><br>
            <span ><b>_________________________________</b></span><br>
            <span ><b>SAMUEL ZINGA EMÍLIA</b></span><br>
            <span ><b>**TENENTE-GENERAL**</b></span><br>
        </div>
			
			</body>
		</html>
		";

            $arquivo = "Relatorio de Bolseiros.pdf";

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($pagina);
            $mpdf->Output($arquivo, 'I');

            // I - Abre no navegador
            // F - Salva o arquivo no servido
            // D - Salva o arquivo no computador do usuário
        } else {
            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/bolseiro/fichaRelatorios", $this->Dados);
            $carregarView->renderizar();
        }
    }

}


