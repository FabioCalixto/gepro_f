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
class AdmsVerInfractor {
    //put your code here
    
      private $Resultado;
    private $DadosId;
    
    public function verInfractor($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adms\Models\helper\AdmsRead();
        $verPerfil->fullRead("SELECT
        tab_infratores.nome_infractor,
        tab_infratores.id,
        tab_infratores.nome_pai,
        tab_infratores.nome_mae,
        tab_infratores.numero_bi,
        tab_infratores.data_nascimento,
        tb_sexo.sexo,
        tab_infratores.nip,
        tb_patente.patente,
        tb_patente.patente_mga,
        adms_crime_comum.descricao_crimecomum,
        adms_crime_militar.descricao_crime_militar,  
        tb_u_e_o.designacao_Unidade,
        tb_processo.processo,
        tb_processo.situacaoprocesso_id,
        tb_estado_processo.descricao_proc,
        tb_ano_instrucao.ano,
        tab_infratores.imagem,
        tab_infratores.created
                
        FROM
        tab_infratores
          
        INNER JOIN tb_sexo ON tb_sexo.id = tab_infratores.sexo        
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tab_infratores.n_processo
        INNER JOIN tb_ano_instrucao ON tb_ano_instrucao.id = tb_processo.anoinstrucao_id
        WHERE tab_infratores.id =:id  LIMIT :limit", "id=".$this->DadosId."&limit=1");
        $this->Resultado= $verPerfil->getResultado();
        return $this->Resultado;
    }
}
