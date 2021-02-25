<?php

namespace App\adms\Models;

/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class AdmsPesquisarporCrimeMilitar {
    //put your code here
    
    
      
    //Codigo da Class
      private $Resultado;
    private $Dados;
    private $Msg;
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

        if (!empty($this->Dados['name']) ):
            $this->pesquisarInfractoresPComp();
        elseif (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresProcesso();
  
        endif;
        
        return $this->Resultado;
    }
    
    private function pesquisarInfractoresPComp() {
        $Paginacao = new \App\adms\Models\helper\ModelsPaginacao(URLADM . 'consula-processo/pesquisar-processo/', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tb_patente.patente,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        tb_estado_processo.descricao_proc,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
        FROM
        tab_infratores
        INNER JOIN tb_patente ON tb_patente.id = tab_infratores.cod_patente
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        WHERE tb_processo.id  =:name ", 
        "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);
        
        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->fullRead('SELECT
    tab_infratores.id,
    tab_infratores.nome_infractor,
    tb_patente.patente,
    tb_processo.processo,
    tb_estado_processo.descricao_proc,
    tb_processo.instrutor,
    tb_estado_processo.descricao_proc,
    adms_crime_militar.descricao_crime_militar,
    adms_crime_comum.descricao_crimecomum
    FROM
    tab_infratores
    INNER JOIN tb_patente ON tb_patente.id = tab_infratores.cod_patente
    INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
    INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
    INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
    INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
    INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum  WHERE tb_processo.id  =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif; 
    }
    
    private function pesquisarInfractoresProcesso() {
        $Paginacao = new ModelsPaginacao(URLADM . 'consulta-processo/pesquisar-processo/', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tb_patente.patente,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        tb_estado_processo.descricao_proc,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
        FROM
        tab_infratores
        INNER JOIN tb_patente ON tb_patente.id = tab_infratores.cod_patente
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        WHERE tb_processo.id  =:name ", 
        "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);
        
        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->fullRead('SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tb_patente.patente,
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tb_processo.instrutor,
        tb_estado_processo.descricao_proc,
        adms_crime_militar.descricao_crime_militar,
        adms_crime_comum.descricao_crimecomum
        FROM
        tab_infratores
        INNER JOIN tb_patente ON tb_patente.id = tab_infratores.cod_patente
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum  WHERE tb_processo.id  =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif; 
    }
    
//    
    
}
