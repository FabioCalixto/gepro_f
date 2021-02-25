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
class AdmsCadastrarCrimeMilitar {
    //put your code here
    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadCrimeMilitar(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirCrimeMilitar();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirCrimeMilitar()
    {
        //$this->Dados['created'] = date("Y-m-d H:i:s");
        $cadUnidade = new \App\adms\Models\helper\AdmsCreate;
        $cadUnidade->exeCreate("adms_crime_militar", $this->Dados);
        if ($cadUnidade->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Crime Militar cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Crime Militar não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }
    
    
    
}
