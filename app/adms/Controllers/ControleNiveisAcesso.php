<?php

/**
 * Descricao de ControleNiveisAcesso
 *
 * @copyright (c) year,Fábio Calixto- FAMASOFT
 */
class ControleNiveisAcesso {

    private $PostId;
    private $Dados;
    private $NivelAcessoId;
    private $Resultado;

    public function index($PageId = null) {
        $this->PostId = ((int) $PageId ? $PageId : 1);
        $ListarNiveisAcesso = new ModelsNiveisAcesso();
        $this->Dados = $ListarNiveisAcesso->listar($this->PostId);

        $CarregarView = new ConfigView('niveisacesso/listarNiveisAcesso', $this->Dados);
        $CarregarView->renderizar();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendCadNivelAcesso'])):
            unset($this->Dados['SendCadNivelAcesso']);
            $CadNivelAcesso = new ModelsNiveisAcesso();
            $CadNivelAcesso->cadastrar($this->Dados);

            if ($CadNivelAcesso->getResultado()):
                //$SincronizarClasse = new ModelsLogin();
             //  $SincronizarClasse->cadastrarClasse();
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Nivel de Acesso cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar o Nivel de Acesso preencha todos os campos!</div>";
            endif;
        endif;

        $CarregarView = new ConfigView('niveisacesso/registarNivelAcesso');
        $CarregarView->renderizar();
    }

    public function visualizar($NivelAcessoId = null) {
        $this->NivelAcessoId = (int) $NivelAcessoId;
        if (!empty($this->NivelAcessoId)):
            $VerNivelAcesso = new ModelsNiveisAcesso();
            $VerNivelAcesso->visualizar($this->NivelAcessoId);
            $this->Dados = $VerNivelAcesso->getResultado();

            if ($VerNivelAcesso->getResultado()):
                $CarregarView = new ConfigView('niveisacesso/visualizarNivel', $this->Dados);
                $CarregarView->renderizar();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro  </b>Necessário Selecionar um Nivel de Acesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro </b>Necessário Selecionar um Nivel de Acesso!</div>";
            $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($NivelAcessoId) {
        $this->NivelAcessoId = (int) $NivelAcessoId;
        if (!empty($this->NivelAcessoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $verNivelAcesso = new ModelsNiveisAcesso();
            $this->Dados = $verNivelAcesso->visualizar($this->NivelAcessoId);
            $CarregarView = new ConfigView('niveisacesso/editarNivelAcesso', $this->Dados);
            $CarregarView->renderizar();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um nivel de acesso!</div>";
            $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditNivelAcesso'])):
            unset($this->Dados['SendEditNivelAcesso']);
            $EditaNivelAcesso = new ModelsNiveisAcesso();
            $EditaNivelAcesso->editar($this->NivelAcessoId, $this->Dados);
            if (!$EditaNivelAcesso->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar nivel de acesso preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Nivel de acesso editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            endif;
        else:
            $VerNivelAcesso = new ModelsNiveisAcesso();
            $this->Dados = $VerNivelAcesso->visualizar($this->NivelAcessoId);

            if ($VerNivelAcesso->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-success'>Nivel de acesso editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-niveis-acesso/index';
                header("Location: $UrlDestino");
            endif;
        endif;
    }

    public function apagar($NivelAcessoId) {
        $this->NivelAcessoId = (int) $NivelAcessoId;
        if (!empty($this->NivelAcessoId)):
              $ApagarNivelAcesso = new ModelsNiveisAcesso();
               $ApagarNivelAcesso->apagar($this->NivelAcessoId);
                   $_SESSION['msgcad'] = "<div class='alert alert-success'>Nivel de acesso Apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário Selecionar um Nivel de Acesso!</div>";
            $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
 
        endif;
              $UrlDestino = URL . 'controle-niveis-acesso/index';
            header("Location: $UrlDestino");
 
    }

}
