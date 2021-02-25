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
class Splash {
    //put your code here
     private $Dados;

    public function index()
    {
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu']= $listarMenu->itemMenu();
        
        $carregarView = new \Core\ConfigView("adms/Views/splash/splash", $this->Dados);
        $carregarView->renderizar();
    }
}
