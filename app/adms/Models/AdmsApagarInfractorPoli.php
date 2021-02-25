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
class AdmsApagarInfractorPoli {
    //put your code here
    private $DadosId;
    private $Resultado;
    private $DadosInfractor;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function apagarInfractorPoli($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        $this->verInfractorPoli();
        if ($this->DadosInfractor) {
            $apagarInfractor = new \App\adms\Models\helper\AdmsDelete();
            $apagarInfractor->exeDelete("tab_infratores_policia", "WHERE id =:id", "id={$this->DadosId}");
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

    public function verInfractorPoli()
    {
        $verInfractor = new \App\adms\Models\helper\AdmsRead();
        $verInfractor->fullRead("SELECT
        tab_infratores_policia.imagem

        FROM
        tab_infratores_policia

        INNER JOIN adms_postos_policia ON adms_postos_policia.id = tab_infratores_policia.cod_posto_policia
        INNER JOIN adms_unidade_policial ON adms_unidade_policial.id = tab_infratores_policia.cod_unidade_policial
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tab_infratores_policia.n_processo
        INNER JOIN tb_ano_instrucao ON tb_ano_instrucao.id = tb_processo.anoinstrucao_id
        WHERE tab_infratores_policia.id =:id LIMIT :limit", "id=" . $this->DadosId .  "&limit=1");
        $this->DadosInfractor = $verInfractor->getResultado();
    }
}
