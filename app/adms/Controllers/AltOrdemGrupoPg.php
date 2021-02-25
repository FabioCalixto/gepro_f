<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AltOrdemGrupoPg
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class AltOrdemGrupoPg
{

    private $DadosId;

    public function altOrdemGrupoPg($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $altOrdemGrupoPg = new \App\adms\Models\AdmsAltOrdemGrupoPg();
           $altOrdemGrupoPg->altOrdemGrupoPg($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um grupo de página!</div>";
        }
        $UrlDestino = URLADM . 'grupo-pg/listar';
        header("Location: $UrlDestino");
    }

}
