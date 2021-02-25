<?php

namespace App\adms\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsPesquisaInfractorPatente
 *
 * @author Fábio Calixto - CodeMan
 */
class ModelsPesquisaInfractorPatente {

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

        if (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresPComp();
        elseif (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresProcesso();

        endif;

        return $this->Resultado;
    }

    private function pesquisarInfractoresPComp() {
        $Paginacao = new \App\adms\Models\helper\ModelsPaginacao(URLADM . 'consulta-patente/pesquisar-patente/', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT

                tab_infratores.nome_infractor,
                tb_patente.patente,
                tb_patente.patente_mga,
                tab_infratores.nip,
                tab_infratores.numero_bi,
                tb_processo.processo,
                tb_estado_processo.descricao_proc,
                tb_processo.instrutor,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
   
                
                FROM
                tab_infratores
                
                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                WHERE tb_patente.cod_patente =:name ", "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);

        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->fullRead('SELECT

                tab_infratores.nome_infractor,
                tb_patente.patente,
                tb_patente.patente_mga,
                tab_infratores.nip,
                tab_infratores.numero_bi,
                tb_processo.processo,
                tb_estado_processo.descricao_proc,
                tb_processo.instrutor,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
   
                
                FROM
                tab_infratores
                
                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                WHERE tb_patente.cod_patente =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

    private function pesquisarInfractoresProcesso() {
        $Paginacao = new \App\adms\Models\helper\ModelsPaginacao(URL . 'consulta-patente/pesquisar-patente/', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT

                tab_infratores.nome_infractor,
                tb_patente.patente,
                tb_patente.patente_mga,
                tab_infratores.nip,
                tab_infratores.numero_bi,
                tb_processo.processo,
                tb_estado_processo.descricao_proc,
                tb_processo.instrutor,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
   
                
                FROM
                tab_infratores
                
                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                WHERE tb_patente.cod_patente =:name ", "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);

        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->fullRead('SELECT

                tab_infratores.nome_infractor,
                tb_patente.patente,
                tb_patente.patente_mga,
                tab_infratores.nip,
                tab_infratores.numero_bi,
                tb_processo.processo,
                tb_estado_processo.descricao_proc,
                tb_processo.instrutor,
                tb_estado_processo.descricao_proc,
                tb_ramo.cod_ramo
   
                
                FROM
                tab_infratores
                
                INNER JOIN tb_ramo ON tb_ramo.cod_ramo = tab_infratores.cod_ramo
                INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
                INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
                INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
                WHERE tb_patente.cod_patente  =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

}
