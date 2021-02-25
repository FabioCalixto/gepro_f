<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('Africa/Luanda');
/**
 * Description of Mapageral
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class Mapageral {

    //Codigo da Class
    private $Dados;

    public function fichaReportGeral() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendRepFicha'])) {
            unset($this->Dados['SendRepFicha']);


           /* $data1 = $this->Dados['data1'];
            $data2 = $this->Dados['data2'];
            $processo = $this->Dados['n_processo'];
            $crimes_militares = $this->Dados['id_crime_militar'];*/

            $vis = new \App\adms\Models\helper\AdmsRead();
            $cabecalho = new \App\adms\Models\helper\AdmsRead();
            $num_proc = $this->Dados['n_processo'];
            $id_unid = $this->Dados['cod_Unidade'];
            $id_posto = $this->Dados['cod_patente'];
            $id_crime_mil = $this->Dados['id_crime_militar'];
            $id_crime_com = $this->Dados['id_crime_comum'];
            $id_sexo = $this->Dados['n_sexo'];
            $id_ram = $this->Dados['cod_ramo'];


            if ($this->Dados['tipo_lista'] == '1') {
                $vis->fullRead("SELECT
                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
               
                                
                FROM
                tab_infratores
                                
                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                ORDER BY tb_u_e_o.designacao_Unidade ASC ,tab_infratores.nome_infractor ASC");
            }

            elseif ($this->Dados['tipo_lista'] == '2') {
                $cabecalho->fullRead("SELECT

                tb_processo.processo

                FROM

                tb_processo

                WHERE tb_processo.id = :id               
                ", "id={$num_proc}");
                           
                $vis->fullRead("SELECT
                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
                                
                FROM
                tab_infratores

                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                WHERE tab_infratores.n_processo = '$num_proc'
                ORDER BY tb_u_e_o.designacao_Unidade ASC ,tab_infratores.nome_infractor ASC");
             }

             elseif ($this->Dados['tipo_lista'] == '3') {
                
               $cabecalho->fullRead("SELECT

                  adms_crime_militar.descricao_crime_militar

                FROM

                adms_crime_militar

                WHERE adms_crime_militar.id = :id               
                ", "id={$id_crime_mil}");

                $vis->fullRead("SELECT
                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                adms_crime_militar.descricao_crime_militar,
                tb_ramo.cod_ramo
                                             
                FROM
                tab_infratores

                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
                
                WHERE adms_crime_militar.id = '$id_crime_mil'
                ");

            }

              elseif ($this->Dados['tipo_lista'] == '4') {
                
               $cabecalho->fullRead("SELECT

                  adms_crime_comum.descricao_crimecomum

                FROM

                adms_crime_comum

                WHERE adms_crime_comum.id = :id               
                ", "id={$id_crime_com}");

                $vis->fullRead("SELECT
                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                adms_crime_comum.descricao_crimecomum,
                tb_ramo.cod_ramo
                                             
                FROM
                tab_infratores

                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
                
                WHERE adms_crime_comum.id = '$id_crime_com'
                ");

            }

            elseif ($this->Dados['tipo_lista'] == '5') {
                
               $cabecalho->fullRead("SELECT

                  tb_sexo.sexo

                FROM

                tb_sexo

                WHERE tb_sexo.id = :id               
                ", "id={$id_sexo}");

                $vis->fullRead("SELECT
                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                tb_sexo.sexo,
                tb_ramo.cod_ramo
                                                
                FROM
                tab_infratores

                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN tb_sexo ON tb_sexo.id = tab_infratores.sexo
                
                WHERE tb_sexo.id = '$id_sexo'
                ");

            }
            elseif ($this->Dados['tipo_lista'] == '6') 
                
            {
                
               $cabecalho->fullRead("SELECT

                tb_patente.patente,
                tb_patente.patente_mga


                FROM

                tb_patente

                WHERE tb_patente.cod_patente = :cod_patente               
                ", "cod_patente={$id_posto}");
                $vis->fullRead("SELECT
                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc
                tb_ramo.cod_ramo
                                               
                FROM
                tab_infratores

                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                WHERE tb_patente.cod_patente= '$id_posto'
        ");    
                
         }elseif ($this->Dados['tipo_lista'] == '7') {
                
               $cabecalho->fullRead("SELECT

                tb_u_e_o.designacao_Unidade

                FROM

                tb_u_e_o

                WHERE tb_u_e_o.id = :id               
                ", "id={$id_unid}");

                $vis->fullRead("SELECT

                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
                                             
                FROM
                tab_infratores

                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                
                WHERE tb_u_e_o.id = '$id_unid'
                ");
            }

            elseif ($this->Dados['tipo_lista'] == '8') {
                
               $cabecalho->fullRead("SELECT

                tb_ramo.descricao_ramo

                FROM

                tb_ramo

                WHERE tb_ramo.cod_ramo = :cod_ramo               
                ", "cod_ramo={$id_ram}");

                $vis->fullRead("SELECT

                tb_processo.processo,
                tab_infratores.nome_infractor,
                tab_infratores.numero_bi,
                 tb_u_e_o.designacao_Unidade,
                tb_patente.patente,
                tb_patente.patente_mga,
                tb_estado_processo.descricao_proc,
                tb_ramo.descricao_ramo,
                tb_ramo.cod_ramo
                             
                FROM
                tab_infratores

                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente 
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                
                WHERE tb_ramo.cod_ramo = '$id_ram'
                ");
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
              <img  id='logo' src='./assets/imagens/icone/logo.png'  class='img-responsive' style='width: 50px; height:50px; '>
            </div>
            <div class='row' align='center'>
                <span style=''></span><br>
                <span style='font-size: 14px;'>ESTADO MAIOR GENERAL</span><br>
                <span style=''><b>POLICIA JUDICIARIA MILITAR DAS FORÇAS ARMADAS ANGOLANAS </b></span><br><br><br><br>"; /*
              if ($this->Dados['tipo_lista'] == '1') {
              if (empty($data2)) {
              $pagina .= "<span>Morando  de Estudantes Inseridos Em " . date('d/m/Y', strtotime($data1)) . "   </span>";
              } elseif (!empty($data2)) {
              $pagina .= "<span>Memorando de Estudantes Inseridos Entre " . date('d/m/Y', strtotime($data1)) . " E " . date('d/m/Y', strtotime($data2)) . "  </span>";
              }
              } elseif ($this->Dados['tipo_lista'] == '2') {
              if (empty($data2)) {
              $pagina .= "<span>Memorando das Baixas Efectuadas Em " . date('d/m/Y', strtotime($data1)) . "   </span>";
              } elseif (!empty($data2)) {
              $pagina .= "<span>Memorando das Baixas Efectuadas Entre " . date('d/m/Y', strtotime($data1)) . " E " . date('d/m/Y', strtotime($data2)) . "  </span>";
              }
              } */

              if ($this->Dados['tipo_lista'] == '1')  {
                $pagina .= "<span style=''><b>Mapa Geral de Infratores</b>";
            } else if ($this->Dados['tipo_lista'] == '2')  {
                $pagina .= "<span style=''><b>Mapa de Infratores do Processo nº ".$cabecalho->getResultado()[0]['processo']."</b>";
            } else if ($this->Dados['tipo_lista'] == '3')  {
                $pagina .= "<span style=''><b>Mapa de Infratores por Crime Militar (".$cabecalho->getResultado()[0]['descricao_crime_militar'].")</b>";
            } else if ($this->Dados['tipo_lista'] == '4')  {
                $pagina .= "<span style=''><b>Mapade Infratores por Crime Comum (".$cabecalho->getResultado()[0]['descricao_crimecomum'].")</b>";
            } else if ($this->Dados['tipo_lista'] == '5')  {
                $pagina .= "<span style=''><b>Mapa de Infratores do Sexo (".$cabecalho->getResultado()[0]['sexo'].")</b>";
            } else if ($this->Dados['tipo_lista'] == '6')  {
                $pagina .= "<span style=''><b>Mapa de Infratores do Posto(".$cabecalho->getResultado()[0]['patente'].")</b>";
            } else if ($this->Dados['tipo_lista'] == '7')  {
                $pagina .= "<span style=''><b>Mapa de Infratores da Unidade (".$cabecalho->getResultado()[0]['designacao_Unidade'].")</b>";
            } else if ($this->Dados['tipo_lista'] == '8')  {
                $pagina .= "<span style=''><b>Mapa de Infratores do Ramo (".$cabecalho->getResultado()[0]['descricao_ramo'].")</b>";
            } 


            $pagina .= "</b></span><br>
                <span style=''><b></b></span><br>
            </div>
        </div>
               
            <table class='tg' style='undefined;table-layout: fixed; width: 937px'>

            <colgroup>  
                <col style='width: 289px'>
                <col style='width: 145px'>
                <col style='width: 153px'>
                <col style='width: 120px'>
                <col style='width: 113px'>
                <col style='width: 84px'>
            </colgroup>

            <tr>  
                <th class='tg-zc3b'>Nº Processo</th>
                <th class='tg-j5ry'>Nome do Infrator </th>
                <th class='tg-j5ry'>Nº do BI</th>
                <th class='tg-j5ry'>Unidade Militar</th>
                <th class='tg-j5ry'>Patente</th>
                <th class='tg-j5ry'>Estado do Processo</th>
            </tr>";

          

            $contador = 0;
            foreach ($vis->getResultado() as $infrator):
                extract($infrator);
if($cod_ramo <= 3 || $cod_ramo == 5)
{ 
 $patente = $infrator['patente']; 
}                                
 else{ 
        $patente = $infrator['patente_mga'];
    } 
                $pagina .=
                "<tr>
                <td class='tg-s268'>" . $infrator['processo'] . "</td>
                <td class='tg-0lax'>" . $infrator['nome_infractor'] . "</td>
                <td class='tg-0lax'>" . $infrator['numero_bi'] . "</td>
                <td class='tg-0lax'>" . $infrator['designacao_Unidade'] . "</td>
                <td class='tg-0lax'>" .$patente. "</td>
                <td class='tg-0lax'>" . $infrator['descricao_proc'] . "</td> 
            </tr>";

              $contador++;
            endforeach;
            $pagina .= "
               <tr>
            <td class='tg-y698' colspan='6'></td>
            </tr>
            <tr>
                  <td class='tg-0pky' colspan='5'> <b>Quantidade Total de Infratores</td>
                  <td class='tg-0pky' colspan='1'>".$contador."</td>
            </tr>
          
         
            </table> <br><br>                       
             <div class='row' align='center' ><br>               
              <span >Luanda aos  " . strftime('%d de %B de %Y', strtotime('today'))."  </span><br><br>
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

            $arquivo = "Relatorio de Infratores.pdf";
            $footer = "<table width=\"1000\">
                   <tr>
                     <td style='font-size: 18px; padding-bottom: 20px;' align=\"right\">{PAGENO}</td>
                   </tr>
                 </table>";

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($pagina);
            $mpdf->SetHTMLFooter($footer);
            $mpdf->Output($arquivo, 'I');

            // I - Abre no navegador
            // F - Salva o arquivo no servido
            // D - Salva o arquivo no computador do usuário
        } else {
            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/relatorios/fichaRelatorios", $this->Dados);
            $carregarView->renderizar();
        }
    }

}
