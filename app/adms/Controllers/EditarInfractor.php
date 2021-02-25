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
class EditarInfractor {
    //put your code here
     private $Dados;
    private $DadosId;

    public function editInfractor($DadosId = null)
    {
      $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $this->editInfractorPriv();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'carregar-infractores-js/listarInfractoresJs';
            header("Location: $UrlDestino");
        }
    }

    private function editInfractorPriv()
    {
        if (!empty($this->Dados['EditInfractor'])) {
            unset($this->Dados['EditInfractor']);
            $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $editarInfractor = new \App\adms\Models\AdmsEditarInfractor();
            $editarInfractor->altInfractor($this->Dados);
            if ($editarInfractor->getResultado()) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Infractor editado com sucesso!</div>";
                $UrlDestino = URLADM . 'ver-infractor/ver-infractor/' . $this->Dados['id'];
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
                $this->editInfractorViewPriv();
            }
        } else {
            $verInfractor = new \App\adms\Models\AdmsEditarInfractor();
            $this->Dados['form'] = $verInfractor->verInfractor($this->DadosId);
            $this->editInfractorViewPriv();
        }
    }

    private function editInfractorViewPriv()
    {
        if ($this->Dados['form']) {
            $listarSelect = new \App\adms\Models\AdmsEditarInfractor();
            $this->Dados['select'] = $listarSelect->listarCadastrar();
            
            $botao = ['vis_usuario' => ['menu_controller' => 'ver-infractor', 'menu_metodo' => 'ver-infractor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();
            $carregarView = new \Core\ConfigView("adms/Views/processo/alterarDadosInfractor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'carregar-infractores-js/listarInfractoresJs';
            header("Location: $UrlDestino");
        }
    }

}
