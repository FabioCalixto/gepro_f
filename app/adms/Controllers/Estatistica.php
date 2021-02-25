<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * FAMASOFT LDA
 *
 * @author ´Jacinto Katimba 931419529
 */
class Estatistica {
    //put your code here
    private $Dados;
    private $DadosId;
    
    public function estatistica() {
        

            $listarMenu = new \App\adms\Models\AdmsMenu();

            $estatistica = new \App\adms\Models\ModelsEstatistica();

            $this->Dados['estatisticaNatureza'] = $estatistica->estatisticaPorNatureza();
            $this->Dados['estatisticamilitar'] = $estatistica->estatisticaCrimeMilitar();
            $this->Dados['estatisticaSexo'] = $estatistica->estatisticaPorSexo();
            $this->Dados['estatisticaRamo'] = $estatistica->estatisticaPorRamo();
            $this->Dados['estatisticaPatente'] = $estatistica->estatisticaPorPatente();
            $this->Dados['estatisticaano'] = $estatistica->estatisticaAnoInstrucao();
            $this->Dados['estatisticaCondicao'] = $estatistica->estatisticaCondicaoInfractor();
            //var_dump($estatistica->estatisticaPorNatureza());
    
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/estatistica/fichaEstatistica", $this->Dados);
            $carregarView->renderizar();
        
    }
}
