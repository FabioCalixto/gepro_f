<?php

namespace App\cpadms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CpAdmsListarUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class CpAdmsListarInfractor
{

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 40;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
   public function listarInfractoresGeral($PageId = null) {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\cpadms\Models\helper\CpAdmsInfractoresPaginacao(URLADM . 'carregar-infractores-js/listarInfractoresJs');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT
         COUNT(tab_infratores.id) as num_result
        FROM
        tab_infratores
        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar");
        $this->ResultadoPg = $paginacao->getResultado();

        $listarInfractor = new \App\adms\Models\helper\AdmsRead();
        $listarInfractor->fullRead("SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tab_infratores.numero_bi,
        tb_patente.patente,
        tb_patente.patente_mga,
        adms_crime_comum.descricao_crimecomum,
        adms_crime_militar.descricao_crime_militar,      
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tab_infratores.nip,
        tb_ramo.cod_ramo

        FROM
        tab_infratores

        INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade LIMIT :limit OFFSET :offset",  "&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarInfractor->getResultado();

        return $this->Resultado;
    }
}
