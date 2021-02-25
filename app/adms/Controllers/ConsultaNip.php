<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * Description of ConsultaNip
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class ConsultaNip {
    
    private $Dados;
    private $UserId;
    private $PageId;
    private $InfraId;

    //Codigo da Class


    public function pesquisarNip($PageId = null) {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);
        if (!empty($this->Dados['SendPesquisaInfractorNip'])):
            unset($this->Dados['SendPesquisaInfractorNip']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new \App\adms\Models\helper\ModelsPesquisaInfractorNip();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados); 
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adms/Views/processo/pesquisarInfractorNip", $this->Dados);
        $carregarView->renderizar();
    }

}
