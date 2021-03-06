<?php

namespace App\adms\Models\helper;
if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class AdmsValInfractor {
    //put your code here
    private $Infractor;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function valInfractor($Infractor, $EditarUnico = null, $DadoId = null)
    {
        $this->Infractor = (string) $Infractor;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valInfractor = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valInfractor->fullRead("SELECT id FROM tab_infratores WHERE nome_infractor =:nome_infractor AND id <>:id LIMIT :limit", "nome_infractor={$this->Infractor}&limit=1&id={$this->DadoId}");            
        }else{
            $valInfractor->fullRead("SELECT id FROM tab_infratores WHERE nome_infractor =:nome_infractor LIMIT :limit", "nome_infractor={$this->Infractor}&limit=1");
        }        
        $this->Resultado = $valInfractor->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Infractor já está cadastrado!</div>";
            $this->Resultado = false;
        } else {
            $this->valCarctInfractor();
        }
    }

    private function valCarctInfractor()
    {
        if (stristr($this->Infractor, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Caracter ( ' ) utilizado no Nome do Infractor inválido!</div>";
            $this->Resultado = false;
        }  else {
                $this->valExtensInfractor();
            }
        
    }

    private function valExtensInfractor()
    {
        if ((strlen($this->Infractor)) < 6) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Nome do Infractor deve ter no mínimo 6 caracteres!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

}
