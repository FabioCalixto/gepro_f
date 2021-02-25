<?php

namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsDetalhesInfra
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class AdmsDetalhesInfra {

    //Codigo da Class
    private $Resultado;
    private $DadosId;

    public function verInfractor($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adms\Models\helper\ModelsRead();
        $verPerfil->fullRead("SELECT
         tab_infratores.id,
        tab_infratores.nome_infractor,
        tab_infraccoes.designacao_infraccao,
        tb_processo.processo,
        tb_patente.patente,
        tb_u_e_o.designacao_Unidade,
        tb_estado_processo.descricao_proc,
        tab_infratores.nome_pai,
        tab_infratores.nome_mae,
        tab_infratores.numero_bi,
        tab_infratores.data_nascimento,
        tab_infratores.nip,
        tb_sexo.sexo,
        tab_infratores.nome_ofendido,
        tab_infratores.data_infracao,
        tab_infratores.nome_instrutor,
        tab_infratores.created,
        tab_infratores.modified
        FROM
        tab_infratores
        INNER JOIN tab_infraccoes ON tab_infratores.id_infraccoes = tab_infraccoes.id
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_patente ON tab_infratores.cod_patente = tb_patente.id
        INNER JOIN tb_u_e_o ON tab_infratores.cod_Unidade = tb_u_e_o.id
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_sexo ON tab_infratores.sexo = tb_sexo.id WHERE tab_infratores.id =:id ", "id={$this->DadosId}");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

}
