<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of ApagarSit
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ApagarSit
{

    private $DadosId;

    public function apagarSit($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
           $apagarSit = new \App\adms\Models\AdmsApagarSit();
           $apagarSit->apagarSit($this->DadosId);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma situação!</div>";
        }
        $UrlDestino = URLADM . 'situacao/listar';
        header("Location: $UrlDestino");
    }

}
