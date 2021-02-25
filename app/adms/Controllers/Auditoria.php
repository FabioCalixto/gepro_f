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
class Auditoria {
    //put your code here
    
     private $Dados;
    private $PageId;

    public function listar($PageId = null)
    {
        $this->PageId = (int) $PageId ? $PageId : 1;
        
       // echo "Pagina {$this->PageId} <br>";

        $botao = ['fechar_audit' => ['menu_controller' => 'home', 'menu_metodo' => 'index'],
            'detalhes_audit' => ['menu_controller' => 'visualizar-detalhes', 'menu_metodo' => 'detalhes-aud']];
            
        
        
        
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);

        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();

        $listarAuditoria = new \App\adms\Models\AdmsListarAuditoria();
        $this->Dados['listAudit'] = $listarAuditoria->listarAuditoria($this->PageId);
        $this->Dados['paginacao'] = $listarAuditoria->getResultadoPg();

        $carregarView = new \Core\ConfigView("adms/Views/auditoria/listarAuditoria", $this->Dados);
        $carregarView->renderizar();
    }
}
