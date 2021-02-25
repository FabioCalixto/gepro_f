<?php

namespace App\adms\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * Descricao de ModelsPesquisaInfractor
 *
 * @copyright (c) year, FabioCalixto - DI
 */
class ModelsPesquisaInfractorPoli {

    //codigo da class
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

    public function pesquisarInfractoresPoliP($PageId = null, $Dados = null) {

        $this->PageId = $PageId;
        $this->Dados = $Dados;

        $this->PageId = strip_tags($this->PageId);
        $this->PageId = trim($this->PageId);

        $this->Dados['name'] = strip_tags($this->Dados['name']);
        $this->Dados['name'] = trim($this->Dados['name']);

        if (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresPComp();
        elseif (!empty($this->Dados['name'])):
            $this->pesquisarInfractoresUnidade();

        endif;

        return $this->Resultado;
    }

            private function pesquisarInfractoresPComp() {
                $Paginacao = new \App\adms\Models\helper\ModelsPaginacao(URLADM . 'consulta-unidade-poli/pesquisar-unidade-poli/', 'name=' . $this->Dados['name']);
                $Paginacao->condicao($this->PageId, 1);
                $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT
                    tab_infratores_policia.nome_infractor,
                    tb_estado_processo.descricao_proc,
                    tb_processo.processo,
                    tab_infratores_policia.nip,
                    tab_infratores_policia.numero_bi,
                    adms_postos_policia.patente_policia,
                    adms_unidade_policial.unidade_policial

                    FROM
                    tb_processo

                    INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                    INNER JOIN tab_infratores_policia ON tb_processo.id = tab_infratores_policia.n_processo
                    INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
                    INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia                   WHERE adms_unidade_policial.id =:name ", "name={$this->Dados['name']}");
                //var_dump($this->ResultadoPaginacao);

                $Listar = new \App\adms\Models\helper\AdmsRead();
                $Listar->fullRead('SELECT
                    tab_infratores_policia.nome_infractor,
                    tb_estado_processo.descricao_proc,
                    tb_processo.processo,
                    tab_infratores_policia.nip,
                    tab_infratores_policia.numero_bi,
                    adms_postos_policia.patente_policia,
                    adms_unidade_policial.unidade_policial

                    FROM
                    tb_processo

                    INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                    INNER JOIN tab_infratores_policia ON tb_processo.id = tab_infratores_policia.n_processo
                    INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
                    INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia                   WHERE adms_unidade_policial.id =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
                if ($Listar->getResultado()):
                    $this->Resultado = $Listar->getResultado();
                    //var_dump($this->Resultado);
                    $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
                else:
                    $Paginacao->paginaInvalida();
                endif;
            }

            private function pesquisarInfractores() {
                $Paginacao = new \App\adms\Models\helper\ModelsPaginacao(URLADM . 'consulta-unidade-poli/pesquisar-unidade-poli/', 'name=' . $this->Dados['name']);
                $Paginacao->condicao($this->PageId, 1);
                $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT
                    tab_infratores_policia.nome_infractor,
                    tb_estado_processo.descricao_proc,
                    tb_processo.processo,
                    tab_infratores_policia.nip,
                    tab_infratores_policia.numero_bi,
                    adms_postos_policia.patente_policia,
                    adms_unidade_policial.unidade_policial

                    FROM
                    tb_processo

                    INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                    INNER JOIN tab_infratores_policia ON tb_processo.id = tab_infratores_policia.n_processo
                    INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
                    INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia                   WHERE adms_unidade_policial.id =:name ", "name={$this->Dados['name']}");
                //var_dump($this->ResultadoPaginacao);

                $Listar = new \App\adms\Models\helper\AdmsRead();
                $Listar->fullRead('SELECT
                    tab_infratores_policia.nome_infractor,
                    tb_estado_processo.descricao_proc,
                    tb_processo.processo,
                    tab_infratores_policia.nip,
                    tab_infratores_policia.numero_bi,
                    adms_postos_policia.patente_policia,
                    adms_unidade_policial.unidade_policial

                    FROM
                    tb_processo

                    INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
                    INNER JOIN tab_infratores_policia ON tb_processo.id = tab_infratores_policia.n_processo
                    INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
                    INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia                   WHERE adms_unidade_policial.id =:name LIMIT :limit OFFSET :offset', "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
                if ($Listar->getResultado()):
                    $this->Resultado = $Listar->getResultado();
                    var_dump($this->Resultado);
                    $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
                else:
                    $Paginacao->paginaInvalida();
                endif;
            }

        }
