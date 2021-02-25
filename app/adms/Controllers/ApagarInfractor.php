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
class ApagarInfractor {
    //put your code here
    
    private $DadosId;

    public function apagarInfractor($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarInfractor = new \App\adms\Models\AdmsApagarInfractor();
           $apagarInfractor->apagarInfractor($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um Infractor!</div>";
        }
        $UrlDestino = URLADM . 'carregar-infractores-js/listarInfractoresJs';
        header("Location: $UrlDestino");
    }
}
