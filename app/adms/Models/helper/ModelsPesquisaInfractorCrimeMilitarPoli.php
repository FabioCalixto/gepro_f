<?php

namespace App\adms\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ModelsPesquisaInfractorProcesso
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class ModelsPesquisaInfractorCrimeMilitarPoli {

    //Codigo da Class
    private $Resultado;
    private $Dados;
    private $Msg;
    private $LimiteResultado = 40;
    private $RowCount;
    private $ResultadoPaginacao;
    private $PageId;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function pesquisarInfractoresP($PageId = null, $Dados = null) {

        $this->PageId = $PageId;
        $this->Dados = $Dados;

        $this->PageId = strip_tags($this->PageId);
        $this->PageId = trim($this->PageId);

        $this->Dados['name'] = strip_tags($this->Dados['name']);
        $this->Dados['name'] = trim($this->Dados['name']);

        if (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresPComp();
        elseif (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresCrimeMilitarPoli();

        endif;

        return $this->Resultado;
    }

    private function pesquisarInfractoresPComp() {
        $Paginacao = new \App\adms\Models\helper\ModelsPaginacao(URLADM . 'consultapor-crime-militar-poli/pesquisar-crime-militar-poli/', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT
       
        tab_infratores_policia.nome_infractor,
        tab_infratores_policia.nip,
        tab_infratores_policia.numero_bi,
        adms_postos_policia.patente_policia,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        adms_unidade_policial.unidade_policial,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
                
        FROM
        tab_infratores_policia
                
        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores_policia.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores_policia.id_crime_comum
        WHERE adms_crime_militar.id =:name ", "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);

        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->fullRead('SELECT
       
        tab_infratores_policia.nome_infractor,
        tab_infratores_policia.nip,
        tab_infratores_policia.numero_bi,
        adms_postos_policia.patente_policia,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        adms_unidade_policial.unidade_policial,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
                
        FROM
        tab_infratores_policia
                
        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores_policia.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores_policia.id_crime_comum
        WHERE adms_crime_militar.id  =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

    private function pesquisarInfractoresCrimeMilitar() {
        $Paginacao = new ModelsPaginacao(URLADM . 'consultapor-crime-militar-poli/pesquisar-crime-militar-poli', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT
       
        tab_infratores_policia.nome_infractor,
        tab_infratores_policia.nip,
        tab_infratores_policia.numero_bi,
        adms_postos_policia.patente_policia,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        adms_unidade_policial.unidade_policial,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
                
        FROM
        tab_infratores_policia
                
        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores_policia.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores_policia.id_crime_comum
        WHERE adms_crime_militar.id  =:name ", "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);

        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->fullRead('SELECT
       
        tab_infratores_policia.nome_infractor,
        tab_infratores_policia.nip,
        tab_infratores_policia.numero_bi,
        adms_postos_policia.patente_policia,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        adms_unidade_policial.unidade_policial,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
                
        FROM
        tab_infratores_policia
                
        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores_policia.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores_policia.id_crime_comum
        WHERE adms_crime_militar.id  =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

}
