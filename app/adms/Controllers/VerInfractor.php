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
class VerInfractor {
    //put your code here


    private $Dados;
    private $DadosId;

    public function verInfractor($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verUsuario = new \App\adms\Models\AdmsVerInfractor();
            $this->Dados['dados_infractor'] = $verUsuario->verInfractor($this->DadosId);

            $botao = ['list_infract' => ['menu_controller' => 'carregar-infractores-js', 'menu_metodo' => 'listarInfractoresJs'],
                'edit_infractor' => ['menu_controller' => 'editar-infractor', 'menu_metodo' => 'edit-infractor'],
                'del_infractor' => ['menu_controller' => 'apagar-infractor', 'menu_metodo' => 'apagar-infractor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adms/Views/processo/verInfractor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'carregar-infractores-js/listarInfractoresJs';
            header("Location: $UrlDestino");
        }
    }

}
