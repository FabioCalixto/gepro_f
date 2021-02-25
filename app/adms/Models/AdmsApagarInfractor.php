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
class AdmsApagarInfractor {
    //put your code here
    private $DadosId;
    private $Resultado;
    private $DadosInfractor;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarInfractor($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verInfractor();
        if ($this->DadosInfractor) {
            $apagarInfractor = new \App\adms\Models\helper\AdmsDelete();
            $apagarInfractor->exeDelete("tab_infratores", "WHERE id =:id", "id={$this->DadosId}");
            if ($apagarInfractor->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('assets/imagens/infractor/' . $this->DadosId . '/' . $this->DadosInfractor[0]['imagem'], 'assets/imagens/infractor/' . $this->DadosId);
                $_SESSION['msg'] = "<div class='alert alert-success'>Registro do Infractor apagado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Registro do Infractor não foi apagado!</div>";
                $this->Resultado = false;
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Registro do Infractor não foi apagado!</div>";
            $this->Resultado = false;
        }
    }

    public function verInfractor()
    {
        $verInfractor = new \App\adms\Models\helper\AdmsRead();
        $verInfractor->fullRead("SELECT
        tab_infratores.imagem

        FROM
        tab_infratores

        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tab_infratores.n_processo
        INNER JOIN tb_ano_instrucao ON tb_ano_instrucao.id = tb_processo.anoinstrucao_id
        WHERE tab_infratores.id =:id LIMIT :limit", "id=" . $this->DadosId .  "&limit=1");
        $this->DadosInfractor = $verInfractor->getResultado();
    }
}
