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
class VerInfractorPoli {
    //put your code here


    private $Dados;
    private $DadosId;

    public function verInfractorPoli($DadosId = null)
    {

        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verUsuario = new \App\adms\Models\AdmsVerInfractorPoli();
            $this->Dados['dados_infractor'] = $verUsuario->verInfractorPoli($this->DadosId);

            $botao = ['list_infract' => ['menu_controller' => 'infra-policia', 'menu_metodo' => 'listar'],
                'edit_infractor' => ['menu_controller' => 'editar-infractor', 'menu_metodo' => 'edit-infractor'],
                'del_infractor' => ['menu_controller' => 'apagar-infractor', 'menu_metodo' => 'apagar-infractor']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);

            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adms/Views/processo/verInfractorPoli", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'infra-policia/listar';
            header("Location: $UrlDestino");
        }
    }

}
