<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CadastrarUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class CadastrarProcesso {

    private $Dados;

    public function cadProcesso() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $cadProcesso = new \App\adms\Models\ModelsProcesso();

        if (!empty($this->Dados['SendCadProcesso'])):
            unset($this->Dados['SendCadProcesso']);


            $cadProcesso->cadastrar($this->Dados);
            if ($cadProcesso->getResultado()):
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Processo Registado com sucesso!</div>";
           $this->Dados = NULL;
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao Registar: </b>Para Registar o Processo preencha todos os campos!</div>";
                //     $UrlDestino = URL . 'controle-usuario/index';
                //  header("Location: $UrlDestino");
                // unset($this->Dados);
     
            endif;
        else:
            $Dados = null;
        endif;

        $Registros = $cadProcesso->listarCadastrar();
        $this->Dados = array($Registros[0], $Registros[1], $this->Dados);


        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/processo/registarProcesso", $this->Dados);
        $carregarView->renderizar();
    }

    private function cadUsuarioViewPriv() {
        $listarSelect = new \App\adms\Models\AdmsCadastrarUsuario();
        $this->Dados['select'] = $listarSelect->listarCadastrar();

        $botao = ['list_usuario' => ['menu_controller' => 'usuarios', 'menu_metodo' => 'listar']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/processo/registarInfractor", $this->Dados);
        $carregarView->renderizar();
    }

}
