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
class InfraPolicia {
    //put your code here

     private $Dados;
    private $PageId;
    private $TipoResultado;
    private $PesqInfractor;
    
    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;

     $botao = ['cad_usuario' => ['menu_controller' => 'cadastrar-usuario', 'menu_metodo' => 'cad-usuario'],
            'vis_infractor' => ['menu_controller' => 'ver-usuario', 'menu_metodo' => 'ver-usuario'],
            'edit_infractor' => ['menu_controller' => 'editar-infractor', 'menu_metodo' => 'edit-infractor'],
            'del_infract' => ['menu_controller' => 'apagar-infractor', 'menu_metodo' => 'apagar-infractor']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarEstudantes = new \App\adms\Models\AdmsListarInfraPolicia();
        $this->Dados['listEstudantes'] = $listarEstudantes->listarEstudantes($this->PageId);
        $this->Dados['paginacao'] = $listarEstudantes->getResultadoPg();

        $carregarView = new \Core\ConfigView("adms/Views/processo/listarInfraPolicia", $this->Dados);
        $carregarView->renderizar();
    }
    
}
