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
class RegistInfractorPoli {
    //put your code here
    
    
      private $Dados;
        private $DadosId;

    public function regInfractorPoli()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadInfractor'])) {
            unset($this->Dados['CadInfractor']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadInfractor = new \App\adms\Models\AdmsCadastrarInfractorPoli();
            $this->Dados['id_crime_comum'] = !empty($this->Dados['id_crime_comum']) ? $this->Dados['id_crime_comum'] : '15';
            $this->Dados['id_crime_militar'] = !empty($this->Dados['id_crime_militar']) ? $this->Dados['id_crime_militar'] : '19';
            $cadInfractor->cadInfractor($this->Dados);
            
            if ($cadInfractor->getResultado()) {
                $UrlDestino = URLADM . 'infra-policia/listar';

                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->cadInfractorViewPriv();

            }
        } else {
            $this->cadInfractorViewPriv();
        }
    }

    private function cadInfractorViewPriv()
    {
        $listarSelect = new \App\adms\Models\AdmsCadastrarInfractorPoli();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
       
        $botao = ['list_bolseiros' => ['menu_controller' => 'infra-policia', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/processo/registInfraPolicia", $this->Dados);
        $carregarView->renderizar();
    }
    
     public function estatistica() {
        

            $listarMenu = new \App\adms\Models\AdmsMenu();

            $estatistica = new \App\adms\Models\AdmsCadastrarInfractorPoli();

          $this->Dados['estatisticaNatureza'] = $estatistica->estatisticaPorNatureza();
          $this->Dados['estatisticaPatente'] = $estatistica->estatisticaCrimePolicia();
          $this->Dados['estatisticaPorSexo'] = $estatistica->estatisticaSexoPolicia();
          $this->Dados['estatisticaCrime'] = $estatistica->estatisticaPorCrimeMilitar();
          $this->Dados['estatisticaano'] = $estatistica->estatisticaPorAnoInstrcao();

            
            //var_dump($estatistica->estatisticaCrimePolicia());
    
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/estatistica/fichaEstatisticaPolicia", $this->Dados);
            $carregarView->renderizar();
        
    }

}
