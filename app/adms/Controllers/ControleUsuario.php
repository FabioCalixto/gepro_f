<?php

/**
 * Descricao de ControleUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleUsuario {

    private $Dados;
    private $UserId;
    private $PageId;

    public function index($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";

        $ListarUsuarios = new ModelsUsuario();
        $this->Dados = $ListarUsuarios->listar($this->PageId);
        $CarregarView = new ConfigView("usuario/listarUsuarios", $this->Dados);
        $CarregarView->renderizar();
    }

    public function pesquisarUsuario($PageId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);
        if (!empty($this->Dados['SendPesquisaUsuario'])):
            unset($this->Dados['SendPesquisaUsuario']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
            $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarUsuarios = new ModelsPesquisaUsuario();
        $this->Dados = $PesquisarUsuarios->pesquisarUsuarios($this->PageId, $this->Dados);
//        var_dump($this->Dados);
        $CarregarView = new ConfigView("usuario/pesquisarUsuario", $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadUsuario = new ModelsUsuario();
        if (!empty($this->Dados['SendCadUsuario'])):
            unset($this->Dados['SendCadUsuario']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            //var_dump($this->Dados);
            $CadUsuario = new ModelsUsuario();
            $CadUsuario->cadastrar($this->Dados);
            if (!$CadUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar o usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;
        endif;

        $Registros = $CadUsuario->listarCadastrar();
        $this->Dados = array($Registros[0], $Registros[1], $this->Dados);
        $CarregarView = new ConfigView("usuario/registarUsuario", $this->Dados);
        $CarregarView->renderizar();
    }

    public function visualizar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($UserId);

            if ($VerUsuario->getResultado()):
                $CarregarView = new ConfigView("usuario/visualizarUsuario", $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Usuário!</div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um Usuário!</div>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function verPerfil() {
        $this->UserId = (int) $_SESSION['id'];

        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if ($VerUsuario->getResultado()):
                $CarregarView = new ConfigView("usuario/verPerfil", $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Area Restrita</div>";
                $UrlDestino = URL . 'controle-login/login';
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Area Restrita</div>";
            $UrlDestino = URL . 'controle-login/login';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaUsuario = new ModelsUsuario();
            $Registros = $EditaUsuario->listarCadastrar();
            //var_dump($Registros);
            $this->Dados = array($Registros[0], $Registros[1], $this->Dados);
            $CarregarView = new ConfigView("usuario/alterarUsuario", $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um usuário</div>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditUsuario'])):
            unset($this->Dados['SendEditUsuario']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaUsuario = new ModelsUsuario();
            $EditaUsuario->editar($this->UserId, $this->Dados);
            if (!$EditaUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-usuario/visualizar/' . $this->UserId;
                header("Location: $UrlDestino");
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if ($VerUsuario->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um usuário</div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;
        //var_dump($this->Dados);
        endif;
    }

    public function editarPerfil() {
        $this->UserId = (int) $_SESSION['id'];

        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alteraPerfilPrivado();

            $CarregarView = new ConfigView("usuario/editarPerfil", $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Area Restrita.</div>";
            $UrlDestino = URL . 'controle-login/login';
            header("Location: $UrlDestino");
        endif;
    }

    private function alteraPerfilPrivado() {
        if (!empty($this->Dados['SendEditUsuario'])):
            unset($this->Dados['SendEditUsuario']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaUsuario = new ModelsUsuario();
            $EditaUsuario->editar($this->UserId, $this->Dados);
            if (!$EditaUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar é necessário preencher todos os campos!</div>";
            else:

                $ActualizarSessao = new ModelsUsuario();
                $ActualizarSessao->atualizaSessao($this->UserId);


                $_SESSION['msg'] = "<div class='alert alert-success'>Dados editados com sucesso!</div>";
                $UrlDestino = URL . 'controle-usuario/ver-perfil/';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);

        endif;
    }

    public function apagar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            echo "Usuário a ser apagado: {$this->UserId}<br>";
            $ApagarUsuario = new ModelsUsuario();
            $ApagarUsuario->apagar($this->UserId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um usuário</div>";
        endif;

        $UrlDestino = URL . 'controle-usuario/index';
        header("Location: $UrlDestino");
    }

}