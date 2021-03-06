<?php

/**
 * Descricao de ControleUsuario
 *
 * @copyright (c) year, Fábio Calixto - DI
 */
class ControleProcesso {
    private $pla;
    private $Dados;
    private $UserId;
    private $PageId;

    public function index($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";

        $ListarUsuarios = new ModelsUsuario();
        $this->Dados = $ListarUsuarios->listar($this->PageId);
        $CarregarView = new ConfigView("usuario/listarUsuario", $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadInfractor = new ModelsProcesso();

        if (!empty($this->Dados['SendCadProcesso'])):
            unset($this->Dados['SendCadProcesso']);
            $CadInfractor->cadastrar($this->Dados);
            if (!$CadInfractor->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao Registar: </b>Para Registar o Processo preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Processo Registado com sucesso!</div>";

             /*   $_SESSION['msgcad'] = "<div class='alert alert-success'>Processo cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-processo/cadastrar';
                header("Location: $UrlDestino");*/
        //    unset($this->Dados);
                $this->Dados = NULL;
            endif;

        else:
            $Dados = null;
        endif;

        $Registros = $CadInfractor->listarCadastrar();
        $this->Dados = array($Registros[0],$Registros[1],$this->Dados);
        $CarregarView = new ConfigView("processo/registarProcesso", $this->Dados);
        $CarregarView->renderizar();
    }

    public function visualizar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($UserId);
            $CarregarView = new ConfigView("usuario/visualizarUsuario", $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "Necessário selecionar um usuário<br>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário editado com sucesso</div>";
            $CarregarView = new ConfigView("usuario/editarUsuario", $this->Dados);
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
            $EditaUsuario = new ModelsUsuario();
            $EditaUsuario->editar($this->UserId, $this->Dados);
            if (!$EditaUsuario->getResultado()):
                $this->Dados['msg'] = $EditaUsuario->getMsg();
            else:
                $this->Dados['msg'] = $EditaUsuario->getMsg();
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
