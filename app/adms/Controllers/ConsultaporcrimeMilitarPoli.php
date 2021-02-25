<?php

namespace App\adms\Controllers;

/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class ConsultaporcrimeMilitarPoli {
    //put your code here
    
       
    
     private $Dados;
    private $UserId;
    private $PageId;
    private $InfraId;

    public function pesquisarcrimeMilitarPoli($PageId = null) {
   
   
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (!empty($this->Dados['SendPesquisaInfractorCrimeMilitarPoli'])):
            unset($this->Dados['SendPesquisaInfractorCrimeMilitarPoli']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new \App\adms\Models\helper\ModelsPesquisaInfractorCrimeMilitarPoli();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados);

    
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $carregarView = new \Core\ConfigView("adms/Views/processo/pesquisarInfractorCrimeMilitarPoli", $this->Dados);
        $carregarView->renderizar();
    }

    
    
}
