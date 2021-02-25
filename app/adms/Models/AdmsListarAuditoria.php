<?php

namespace App\adms\Models;
if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class AdmsListarAuditoria {
    //put your code here
    
    private $Resultado;
    private $PageId;
    private $LimiteResultado = 9;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    
    public function listarAuditoria($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adms\Models\helper\AdmsPaginacao(URLADM . 'auditoria/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT
        COUNT(aud_nome_infractor) AS num_result
        FROM
        tab_infratores_aud
        INNER JOIN adms_acao ON adms_acao.id = tab_infratores_aud.acao
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_aud.aud_n_processo
        INNER JOIN adms_cors ON adms_cors.id = adms_acao.id_cor
");
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarAuditoria = new \App\adms\Models\helper\AdmsRead();
        $listarAuditoria->fullRead("SELECT
        adms_acao.nome,
        tab_infratores_aud.aud_nome_infractor,
        tb_processo.processo,
        tab_infratores_aud.aud_nome_pai,
        tab_infratores_aud.aud_nome_mae,
        tab_infratores_aud.aud_numero_bi,
        tab_infratores_aud.aud_data_nascimento,
        tab_infratores_aud.aud_sexo,
        tab_infratores_aud.aud_usuario,
        tab_infratores_aud.created,
        tab_infratores_aud.aud_nip,
        adms_cors.cor
        FROM
        tab_infratores_aud
        INNER JOIN adms_acao ON adms_acao.id = tab_infratores_aud.acao
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_aud.aud_n_processo
        INNER JOIN adms_cors ON adms_cors.id = adms_acao.id_cor
        LIMIT :limit OFFSET :offset", "limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listarAuditoria->getResultado();
        return $this->Resultado;
    }
    
}
