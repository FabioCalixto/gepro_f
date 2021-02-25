<?php

namespace App\adms\Controllers;
if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */
class CadastrarAnoInstrucao {
    //put your code here
     private $Dados;

    public function cadAnoInstrucao() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $cadUnidade = new \App\adms\Models\AdmsCadastrarAnoInstrucao();

        if (!empty($this->Dados['SendCadUnidade'])):
            unset($this->Dados['SendCadUnidade']);


            $cadUnidade->cadAnoInstrucao($this->Dados);
               
            if ($cadUnidade->getResultado() > 0):

                $_SESSION['msgcad'] = "<div class='alert alert-success'>Ano de Instrução Registado com sucesso!</div>";
           $this->Dados = NULL;
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao Registar: </b>Para Registar o Ano de Instrução preencha todos os campos!</div>";
                //     $UrlDestino = URL . 'controle-usuario/index';
                //  header("Location: $UrlDestino");
                // unset($this->Dados);
     
            endif;
        else:
            $Dados = null;
        endif;

    


        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        $carregarView = new \Core\ConfigView("adms/Views/processo/regAnoInstrucao", $this->Dados);
        $carregarView->renderizar();
    }



}
