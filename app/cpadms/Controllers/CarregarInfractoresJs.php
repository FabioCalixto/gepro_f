<?php

namespace App\cpadms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CarregarUsuariosJs
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class CarregarInfractoresJs {

    private $Dados;
    private $PageId;
    private $TipoResultado;
    private $PesqInfractor;

    public function listarInfractoresJs($PageId = null) {
        $this->TipoResultado = filter_input(INPUT_GET, 'tiporesult');
        $this->PageId = (int) $PageId ? $PageId : 1;

        $botao = ['cad_usuario' => ['menu_controller' => 'cadastrar-usuario', 'menu_metodo' => 'cad-usuario'],'vis_infractor' => ['menu_controller' => 'ver-usuario', 'menu_metodo' => 'ver-usuario'],
            'edit_infractor' => ['menu_controller' => 'editar-infractor', 'menu_metodo' => 'edit-infractor'],
            'del_infract' => ['menu_controller' => 'apagar-infractor', 'menu_metodo' => 'apagar-infractor']];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        if (!empty($this->TipoResultado) AND ( $this->TipoResultado == 1)) {
            $this->listarInfractoresPriv();
        } elseif (!empty($this->TipoResultado) AND ( $this->TipoResultado == 2)) {

            $this->PesqInfractor = filter_input(INPUT_POST, 'palavraPesq');
            $this->pesquisarInfractoresPriv();
        } else {
            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \App\cpadms\core\ConfigView("cpadms/Views/infractores/carregarInfractoresJs", $this->Dados);
            $carregarView->renderizar();
        }
    }

    private function listarInfractoresPriv() {
        $pesquisarInfractor = new \App\cpadms\Models\CpAdmsListarInfractor();
        $this->Dados['listInfra'] = $pesquisarInfractor->listarInfractoresGeral($this->PageId);
        $this->Dados['paginacao'] = $pesquisarInfractor->getResultadoPg();

        $carregarView = new \App\cpadms\core\ConfigView("cpadms/Views/infractores/listarInfractoresJs", $this->Dados);
        $carregarView->renderizarListar();
    }

    private function pesquisarInfractoresPriv() {
        $pesquisarInfractor = new \App\cpadms\Models\CpAdmsPesquisarInfractores();
        $this->Dados['listInfra'] = $pesquisarInfractor->pesqInfractor($this->PesqInfractor);
        $this->Dados['paginacao'] = $pesquisarInfractor->getResultadoPg();

        $carregarView = new \App\cpadms\core\ConfigView("cpadms/Views/infractores/listarInfractoresJs", $this->Dados);
        $carregarView->renderizarListar();
    }

}
