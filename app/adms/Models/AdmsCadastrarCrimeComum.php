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
class AdmsCadastrarCrimeComum {
    //put your code here
    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadCrimeComum(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirCrimeComum();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirCrimeComum()
    {
        //$this->Dados['created'] = date("Y-m-d H:i:s");
        $cadUnidade = new \App\adms\Models\helper\AdmsCreate;
        $cadUnidade->exeCreate("adms_crime_comum", $this->Dados);
        if ($cadUnidade->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Crime Comum cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Crime Comum não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }
    
    
    
}
