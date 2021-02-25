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
class EditarInfractorPoli {
    //put your code here
     private $Dados;
    private $DadosId;

    public function editInfractorPoli($DadosId = null)
    {
      $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editInfractorPoliPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'InfraPolicia/listar';
            header("Location: $UrlDestino");
        }
    }

    private function editInfractorPoliPriv()
    {
        if (!empty($this->Dados['EditInfractor'])) {
            unset($this->Dados['EditInfractor']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarInfractor = new \App\adms\Models\AdmsEditarInfractorPoli();
            $editarInfractor->altInfractorPoli($this->Dados);
            if ($editarInfractor->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Infractor editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-infractor-poli/ver-infractor-poli/' . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editInfractorPoliViewPriv();
            }
        } else {
            $verInfractor = new \App\adms\Models\AdmsEditarInfractorPoli();
            $this->Dados['form'] = $verInfractor->verInfractorPoli($this->DadosId);
            $this->editInfractorPoliViewPriv();
        }
    }

    private function editInfractorPoliViewPriv()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adms\Models\AdmsEditarInfractorPoli();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_usuario' => ['menu_controller' => 'ver-infractor-poli', 'menu_metodo' => 'ver-infractor-poli']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/processo/alterarDadosInfractorPoli", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'infra-policia/listar';
            header("Location: $UrlDestino");
        }
    }

}
