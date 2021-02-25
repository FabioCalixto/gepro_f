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
class RegistInfractor {
    //put your code here
    private $Dados;

    public function regInfractor()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['CadInfractor'])) {
            unset($this->Dados['CadInfractor']);
           $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadInfractor = new \App\adms\Models\AdmsCadastrarInfractor();
              $this->Dados['id_crime_comum'] = !empty($this->Dados['id_crime_comum']) ? $this->Dados['id_crime_comum'] : '15';
            $this->Dados['id_crime_militar'] = !empty($this->Dados['id_crime_militar']) ? $this->Dados['id_crime_militar'] : '19';
            $cadInfractor->cadInfractor($this->Dados);
            if ($cadInfractor->getResultado()) {
                $UrlDestino = URLADM . 'carregar-infractores-js/listar-infractores-js';
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
        $listarSelect = new \App\adms\Models\AdmsCadastrarInfractor();
        $this->Dados['select'] = $listarSelect->listarCadastrar();
       
        $botao = ['list_bolseiros' => ['menu_controller' => 'carregar-infractores-js', 'menu_metodo' => 'listar-infractores-js']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/processo/regInfractor", $this->Dados);
        $carregarView->renderizar();
    }
}
