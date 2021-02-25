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
class AdmsCadastrarAnoInstrucao{
    //put your code here
    private $Resultado;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadAnoInstrucao(array $Dados)
    {
        $this->Dados = $Dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->inserirAnoInstrucao();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirAnoInstrucao()
    {
        //$this->Dados['created'] = date("Y-m-d H:i:s");
        $cadUnidade = new \App\adms\Models\helper\AdmsCreate;
        $cadUnidade->exeCreate("tb_ano_instrucao", $this->Dados);
        if ($cadUnidade->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Ano de Instrução cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Ano de Instrução não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }
    
    
    
}
