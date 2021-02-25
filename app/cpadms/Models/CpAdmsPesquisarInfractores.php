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
class CpAdmsPesquisarInfractores {

    private $Resultado;
    private $PageId;
    private $LimiteResultado = 40;
    private $ResultadoPg;
    private $PesqInfractor;

    function getResultadoPg() {
        return $this->ResultadoPg;
    }

    public function pesqInfractor($PesqInfractor = null) {
        $this->PesqInfractor = (string) $PesqInfractor; 

        $this->ResultadoPg = null;

        $listarUsuario = new \App\adms\Models\helper\AdmsRead();
        $listarUsuario->fullRead("SELECT
        tab_infratores.id,
        tab_infratores.numero_bi,
        tab_infratores.nome_infractor,
        tb_patente.patente,
        tb_patente.patente_mga,
        adms_crime_comum.descricao_crimecomum,
        adms_crime_militar.descricao_crime_militar,      
        tb_processo.processo,
        tb_estado_processo.descricao_proc,
        tab_infratores.nip

        FROM
        tab_infratores
        
        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN adms_crime_comum ON adms_crime_comum.id = tab_infratores.id_crime_comum
        INNER JOIN adms_crime_militar ON adms_crime_militar.id = tab_infratores.id_crime_militar
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade WHERE
        (tab_infratores.nome_infractor LIKE '%' :nome '%' OR tab_infratores.nip LIKE '%' :nip '%' OR tb_processo.processo LIKE '%' :processo '%') LIMIT :limit ", "nome=" . $this->PesqInfractor . "&nip={$this->PesqInfractor}" . "&processo={$this->PesqInfractor}". "&limit={$this->LimiteResultado}");
        $this->Resultado = $listarUsuario->getResultado();

        return $this->Resultado;
    }

   
}
