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
class Tempo_sessao {
    //put your code here
    
    public function inicializa_sessao($tempoExpiracao,$erro=NULL) {
     
     if (!$_SESSION['usuario_nome']){
         header("Location:http://localhost/ginfra_faa/adm/?erro=" . $erro);
         if (isset($_SESSION["ultimoclick"]) and !empty($_SESSION["ultimoclick"])){
             
             $tempoAtual = time();
             
             if (($tempoAtual - $_SESSION["ultimoclick"]) > $tempoExpiracao){
                 unset($_SESSION["ultimoclick"]);
                 
                 var_dump($tempoAtual);
                 $_SESSION = array();
                 session_destroy();
                 header("Location:http://localhost/ginfra_faa/adm/");
                 exit();    
             }else{
                 $_SESSION["ultimoclick"] = time();
             }
             
         } else {
             $_SESSION["ultimoclick"] = time();
         }        
     } 
}
   
}
