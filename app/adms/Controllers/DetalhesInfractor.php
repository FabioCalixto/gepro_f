<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * Description of DetalhesInfractor
 *
 * @copyright (c) year, Fábio Calixto (FAMASOFT)
 */
class DetalhesInfractor {
    //Codigo da Class
   
    private $Dados;
    private $DadosId;
    
    public function detalhesInfra($DadosId = null) {
        
        
        
        
        $this->DadosId = (int) $DadosId;

        if (!empty($this->DadosId)) {
            $detaInfractor = new \App\adms\Models\AdmsDetalhesInfra();
            $this->Dados['dados_infractor'] = $detaInfractor->verInfractor($this->DadosId);

             $botao = ['list_infractor' => ['menu_controller' => 'usuarios', 'menu_metodo' => 'listar'],
                'edit_usuario' => ['menu_controller' => 'editar-usuario', 'menu_metodo' => 'edit-usuario'],
                'edit_senha' => ['menu_controller' => 'editar-senha', 'menu_metodo' => 'edit-senha'],
                'del_usuario' => ['menu_controller' => 'apagar-usuario', 'menu_metodo' => 'apagar-usuario']];
            $listarBotao = new \App\adms\Models\AdmsBotao();
            $this->Dados['botao'] = $listarBotao->valBotao($botao);
            $listarMenu = new \App\adms\Models\AdmsMenu();
            $this->Dados['menu'] = $listarMenu->itemMenu();

            $carregarView = new \Core\ConfigView("adms/Views/processo/visualizarInfractor", $this->Dados);
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
            $UrlDestino = URLADM . 'consulta-processo/pesquisar-processo';
            header("Location: $UrlDestino");
        }
    
        
    }
    
    
}
