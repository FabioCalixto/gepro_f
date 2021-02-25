<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CosultaProcesso
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class ConsultaProcesso {

    //Codigo da Class


    private $Dados;
    private $UserId;
    private $PageId;
    private $InfraId;

    public function pesquisarProcesso($PageId = null) {
   
   
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (!empty($this->Dados['SendPesquisaInfractorProcesso'])):
            unset($this->Dados['SendPesquisaInfractorProcesso']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new \App\adms\Models\helper\ModelsPesquisaInfractorProcesso();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados);

    
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adms/Views/processo/pesquisarInfractorProcesso", $this->Dados);
        $carregarView->renderizar();
    }

}
