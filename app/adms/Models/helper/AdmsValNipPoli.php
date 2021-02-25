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
class AdmsValNipPoli {
    //put your code here
    private $Infractor;
    private $Resultado;
    private $EditarUnico;
    private $DadoId;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function valNipInfractorPoli($Infractor, $EditarUnico = null, $DadoId = null)
    {
        $this->Infractor = (string) $Infractor;
        $this->EditarUnico = $EditarUnico;
        $this->DadoId = $DadoId;
        $valNipInfractor = new \App\adms\Models\helper\AdmsRead();
        if(!empty($this->EditarUnico) AND ($this->EditarUnico == true)){
            $valNipInfractor->fullRead("SELECT id FROM tab_infratores_policia WHERE nip =:nip AND id <>:id LIMIT :limit", "nip={$this->Infractor}&limit=1&id={$this->DadoId}");            
        }else{
            $valNipInfractor->fullRead("SELECT id FROM tab_infratores_policia WHERE nip =:nip LIMIT :limit", "nip={$this->Infractor}&limit=1");
        }        
        $this->Resultado = $valNipInfractor->getResultado();
        if (!empty($this->Resultado)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Este Infractor já está cadastrado!</div>";
            $this->Resultado = false;
        } else {
            $this->valCarctInfractorPoli();
        }
    }

    private function valCarctInfractorPoli()
    {
        if (stristr($this->Infractor, "'")) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Caracter ( ' ) utilizado no NIP do Infractor! inválido!</div>";
            $this->Resultado = false;
        } else {
            if (stristr($this->Infractor, " ")) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Proibido utilizar espaço em branco no NIP do Infractor!</div>";
                $this->Resultado = false;
            } else {
               $this->valExtensInfractorPoli();
            }
        }
    }

    private function valExtensInfractorPoli()
    {
        if ((strlen($this->Infractor)) < 9) {
            var_dump($this->Infractor);
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O NIP do Infractor deve ter no mínimo 9 caracteres!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    
}
