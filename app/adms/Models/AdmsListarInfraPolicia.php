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
class AdmsListarInfraPolicia {
    //put your code here
    
      private $Resultado;
    private $PageId;
    private $LimiteResultado = 20;
    private $ResultadoPg;
    
    function getResultadoPg()
    {
        return $this->ResultadoPg;
    }
    
    
        
    public function listarEstudantes($PageId = null)
    {
        $this->PageId = (int) $PageId;
        $paginacao = new \App\adms\Models\helper\AdmsPaginacao(URLADM . 'nivel-acesso/listar');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(nivac.id) AS num_result 
                FROM adms_niveis_acessos nivac
                WHERE nivac.ordem >=:ordem", "ordem=".$_SESSION['ordem_nivac']);
        $this->ResultadoPg = $paginacao->getResultado();
               
        $listarNivAc = new \App\adms\Models\helper\AdmsRead();
        $listarNivAc->fullRead("SELECT
        tab_infratores_policia.nome_infractor,
        adms_postos_policia.patente_policia,
        adms_unidade_policial.unidade_policial,
        adms_crime_comum.descricao_crimecomum,
        adms_crime_militar.descricao_crime_militar,
        tb_processo.processo,
        tab_infratores_policia.id,
        tab_infratores_policia.n_processo,
        tab_infratores_policia.nome_pai,
        tab_infratores_policia.nome_mae,
        tab_infratores_policia.numero_bi,
        tab_infratores_policia.data_nascimento,
        tab_infratores_policia.sexo,
        tab_infratores_policia.nip,
        tab_infratores_policia.cod_posto_policia,
        tab_infratores_policia.cod_unidade_policial,
        tab_infratores_policia.id_crime_comum,
        tab_infratores_policia.id_crime_militar,
        tab_infratores_policia.nome_denuciante,
        tab_infratores_policia.esta_preso,
        tab_infratores_policia.imagem,
        tab_infratores_policia.created,
        tab_infratores_policia.modified,
        tb_estado_processo.descricao_proc

        FROM
        tab_infratores_policia
        
        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores_policia.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores_policia.id_crime_militar
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        ");
        $this->Resultado = $listarNivAc->getResultado();
        return $this->Resultado;
    }
}
