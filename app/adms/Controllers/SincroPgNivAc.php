<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of SincroPgNivAc
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class SincroPgNivAc
{

    public function sincroPgNivAc()
    {
        $sincroPgNivAc = new \App\adms\Models\AdmsSincroPgNivAc();
        $sincroPgNivAc->sincroPgNivAc();
        $UrlDestino = URLADM . "nivel-acesso/listar";
        header("Location: $UrlDestino");
    }

}
