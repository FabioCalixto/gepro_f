<?php
namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * Descricao de ModelsUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsEstatistica {

    private $Resultado;
    private $InfraId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;

    const Entity = 'tab_infratores';

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }


    public function estatisticaPorNatureza() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
                   COUNT(tab_infratores.id_crime_comum) AS quantidadeInfractores, adms_crime_comum.descricao_crimecomum As crime,
               ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage
                 FROM
                 tab_infratores
    
                 INNER JOIN adms_crime_comum ON tab_infratores.id_crime_comum = adms_crime_comum.id
                 GROUP BY tab_infratores.id_crime_comum");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }


     public function estatisticaPorPatente() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
                         tb_ramo.cod_ramo,
                         tab_infratores.cod_patente, 
                     COUNT(tab_infratores.cod_patente) AS militaresCrime, tb_patente.patente, tb_patente.patente_mga,
 
                     ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage

                   FROM
                   tab_infratores
                
                                        INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo 
                    INNER JOIN tb_patente ON tab_infratores.cod_patente = tb_patente.cod_patente 
                    GROUP BY tab_infratores.cod_patente");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

   public function estatisticaPorSexo() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
            
                     COUNT(tab_infratores.sexo) AS quantidadesexo, tb_sexo.sexo,
 
                ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage
                 FROM
                 tab_infratores
                     
                 INNER JOIN tb_sexo ON tb_sexo.id = tab_infratores.sexo 
                 GROUP BY tab_infratores.sexo");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }


    public function estatisticaPorRamo() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
               tab_infratores.cod_ramo,
                     COUNT(tab_infratores.cod_ramo) AS quantidaderamo, tb_ramo.descricao_ramo,
 
                ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage
                 FROM
                 tab_infratores
                     
                 INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo 
                                 WHERE tab_infratores.cod_ramo <> 5
                 GROUP BY tab_infratores.cod_ramo ORDER BY tab_infratores.cod_ramo ASC ");

        $estatistica1 = $Visualizar->getResultado();

        $Visualizar->fullRead("SELECT
               tb_u_e_o.cod_ramo,
                     COUNT(tab_infratores.cod_ramo) AS quantidaderamo, tb_ramo.descricao_ramo,
 
                ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage
                 FROM
                 tab_infratores
                    
                                 INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                                 INNER JOIN tb_ramo ON tb_u_e_o.cod_ramo = tb_ramo.cod_ramo
                 
                                 
                                 WHERE tab_infratores.cod_ramo = 5
                 GROUP BY tb_u_e_o.cod_ramo ORDER BY tb_u_e_o.cod_ramo ASC");
        $i=0;
        foreach ($Visualizar->getResultado() as $civis) {

            
            if ($civis['cod_ramo']==1) {

                $estatistica1[$i]['percentage'] += $civis['percentage'];
                
            }if ($civis['cod_ramo']==2) {

                $estatistica1[$i]['percentage'] += $civis['percentage'];
                
            }if ($civis['cod_ramo']==3) {

                $estatistica1[$i]['percentage'] += $civis['percentage'];
                
            }if ($civis['cod_ramo']==4) {

                $estatistica1[$i]['percentage'] += $civis['percentage'];
                
            }
            $i++;
        }
        //$this->RowCount = $Visualizar->getRowCount();

        $this->Resultado = $estatistica1;
        return $this->Resultado;

    }

     public function estatisticaCrimeMilitar() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
            
                     COUNT(tab_infratores.id_crime_militar) AS quantidadeInfractores, adms_crime_militar.descricao_crime_militar As militar,
 
              ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage
                 FROM
                 tab_infratores
    
                INNER JOIN adms_crime_militar ON tab_infratores.id_crime_militar = adms_crime_militar.id 
                GROUP BY tab_infratores.id_crime_militar");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

     public function estatisticaAnoInstrucao() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
                     tb_processo.anoinstrucao_id, 
                     COUNT(tb_processo.anoinstrucao_id) AS ano, tb_ano_instrucao.ano,
 
                     ((COUNT( * ) / ( SELECT COUNT( * ) FROM tb_processo)) * 100 ) AS percentage

                   FROM
                   tb_processo
                
                    INNER JOIN tb_ano_instrucao ON tb_processo.anoinstrucao_id = tb_ano_instrucao.id 
                   
                    GROUP BY tb_processo.anoinstrucao_id ");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

    public function estatisticaCondicaoInfractor() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
                   COUNT(tab_infratores.adms_condicao_id) AS crime, adms_condicao.descricao_codicao condicao,
               ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores)) * 100 ) AS percentage
                 FROM
                 tab_infratores
    
                 INNER JOIN adms_condicao ON tab_infratores.adms_condicao_id = adms_condicao.id
                 GROUP BY tab_infratores.adms_condicao_id ");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }
       
    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        $this->Dados = array_map('htmlspecialchars', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            //       $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

    
}
