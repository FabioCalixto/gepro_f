<?php

namespace App\adms\Models;
if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class AdmsCadastrarUnidadePoli {
    //put your code here
    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadUnidadePoli(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirUnidade();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirUnidade()
    {
        //$this->Dados['created'] = date("Y-m-d H:i:s");
        $cadUnidade = new \App\adms\Models\helper\AdmsCreate;
        $cadUnidade->exeCreate("adms_unidade_policial", $this->Dados);
        if ($cadUnidade->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Unidade cadastrada com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A Unidade não foi cadastrada!</div>";
            $this->Resultado = false;
        }
    }
    
    
    
}
