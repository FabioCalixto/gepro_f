<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleSitUsuario
 *
 * @author Programador
 */
class ControleSitUsuario {

    //put your code here
    private $PosId;
    private $Dados;
    private $SitUsuarioId;
    private $Resultado;

    public function index($PageId = null) {
        $this->PostId = ((int) $PageId ? $PageId : 1);
        $ListarSitUsuario = new ModelsSitUsuario();
        $this->Dados = $ListarSitUsuario->listar($this->PostId);

        $CarregarView = new ConfigView('situacao/listarSitUsuario', $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendCadSitUsuario'])):
            unset($this->Dados['SendCadSitUsuario']);
            $CadSitUsuario = new ModelsSitUsuario();
            $CadSitUsuario->cadastrar($this->Dados);

            if ($CadSitUsuario->getResultado()):
                $SincronizarClasse = new ModelsLogin();
                $SincronizarClasse->cadastrarClasse();
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação do Usuário cadastrada com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar a Situação preencha todos os campos!</div>";
            endif;
        endif;

        $CarregarView = new ConfigView('situacao/CadastrarSitUsuario');
        $CarregarView->renderizar();
    }

    public function visualizar($SitUsuarioId = null) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $VerSitUsuario = new ModelsSitUsuario();
            $VerSitUsuario->visualizar($this->SitUsuarioId);
            $this->Dados = $VerSitUsuario->getResultado();

            if ($VerSitUsuario->getResultado()):
                $CarregarView = new ConfigView('situacao/visualizarSitUsuario', $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro  </b>Necessário Selecionar uma Situação do Usuário!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro </b>Necessário Selecionar uma Situação do Usuário!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($SitUsuarioId) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);
            $CarregarView = new ConfigView('situacao/editarSitUsuario', $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um nivel de acesso!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditSitUsuario'])):
            unset($this->Dados['SendEditSitUsuario']);
            $EditaSitUsuario = new ModelsSitUsuario();
            $EditaSitUsuario->editar($this->SitUsuarioId, $this->Dados);
            if (!$EditaSitUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar a situação  preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação do Usuário editada com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerSitUsuario = new ModelsSitUsuario();
            $this->Dados = $VerSitUsuario->visualizar($this->SitUsuarioId);

            if ($VerSitUsuario->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-success'>Situação do Usuário Alterada com sucesso!</div>";
                $UrlDestino = URL . 'controle-sit-usuario/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }

    public function apagar($SitUsuarioId) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        if (!empty($this->SitUsuarioId)):
            $ApagarSitUsuario = new ModelsSitUsuario();
            $ApagarSitUsuario->apagar($this->SitUsuarioId);
            $_SESSION['msgcad'] = "<div class='alert alert-success'>Situação do Usuário Apagada com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário Selecionar uma Situação!</div>";
            $UrlDestino = URL . 'controle-sit-usuario/index';
            header("Location: $UrlDestino");

        endif;
        $UrlDestino = URL . 'controle-sit-usuario/index';
        header("Location: $UrlDestino");
    }

}
