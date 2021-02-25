<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ConsultaPatente
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class ConsultaPatente {
    //Codigo da Class
    
    public function pesquisarPatente($PageId = null) {
        
 
        if (!empty($this->Dados['SendPesquisaInfractorPatente'])):
            unset($this->Dados['SendPesquisaInfractorPatente']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new \App\adms\Models\helper\ModelsPesquisaInfractorPatente();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados);

    
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adms/Views/processo/pesquisarInfractorPatente", $this->Dados);
        $carregarView->renderizar();
    }
          
}
