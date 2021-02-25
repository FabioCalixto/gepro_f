<?php

namespace App\adms\Controllers;
if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class ApagarInfractorPoli {
    //put your code here
    
    private $DadosId;

    public function apagarInfractorPoli($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarInfractor = new \App\adms\Models\AdmsApagarInfractorPoli();
           $apagarInfractor->apagarInfractorPoli($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um Infractor!</div>";
        }
        $UrlDestino = URLADM . 'infra-policia/listar';
        header("Location: $UrlDestino");
    }
}
