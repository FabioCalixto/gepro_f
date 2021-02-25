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
class AdmsVerInfractorPoli {
    //put your code here
    
      private $Resultado;
    private $DadosId;
    
    public function verInfractorPoli($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adms\Models\helper\AdmsRead();
        $verPerfil->fullRead("SELECT
        tab_infratores_policia.nome_infractor,
        tab_infratores_policia.id,
        tab_infratores_policia.nome_pai,
        tab_infratores_policia.nome_mae,
        tab_infratores_policia.numero_bi,
        tab_infratores_policia.data_nascimento,
        tb_sexo.sexo,
        tab_infratores_policia.nip,
        adms_postos_policia.patente_policia,        
        adms_crime_comum.descricao_crimecomum,
        adms_crime_militar.descricao_crime_militar,  
        adms_unidade_policial.unidade_policial,
        tb_processo.processo,
        tb_processo.situacaoprocesso_id,
        tb_estado_processo.descricao_proc,
        tb_ano_instrucao.ano,
        tab_infratores_policia.imagem,
        tab_infratores_policia.created
                
        FROM
        tab_infratores_policia
                 
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores_policia.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores_policia.id_crime_militar
        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_sexo ON tb_sexo.id = tab_infratores_policia.sexo
        INNER JOIN tb_ano_instrucao ON tb_ano_instrucao.id = tb_processo.anoinstrucao_id
        WHERE tab_infratores_policia.id =:id  LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado= $verPerfil->getResultado();
        return $this->Resultado;
    }
}
