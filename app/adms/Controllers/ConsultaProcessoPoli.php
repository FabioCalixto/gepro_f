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
class ConsultaProcessoPoli {

    //Codigo da Class


    private $Dados;
    private $UserId;
    private $PageId;
    private $InfraId;

    public function pesquisarProcessoPoli($PageId = null) {
   
   
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (!empty($this->Dados['SendPesquisaInfractorProcessoPoli'])):
            unset($this->Dados['SendPesquisaInfractorProcessoPoli']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new \App\adms\Models\helper\ModelsPesquisaInfractorProcessoPoli();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados);

    
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adms/Views/processo/pesquisarInfractorProcessoPoli", $this->Dados);
        $carregarView->renderizar();
    }

}
