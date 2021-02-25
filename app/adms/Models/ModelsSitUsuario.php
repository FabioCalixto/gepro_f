<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsSitUsuario
 *
 * @author Fábio Calixto - CodeMan
 */
class ModelsSitUsuario {
    //put your code here
    private $Resultado;
    private $SitUsuarioId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;
    const Entity = 'situacoes_users';
   
   
    function getMsg() {
        return $this->Msg;
    }
    function getRowCount() {
        return $this->RowCount;
    }
    function getResultadoPaginacao() {
        return $this->ResultadoPaginacao;
    }
    
    function getResultado() {
        return $this->Resultado;
    }

    
        
     public function listar($PageId) {
        $Paginacao = new ModelsPaginacao(URL . 'controle-sit-usuario/index');
        $Paginacao->condicao($PageId, 20);
        $this->ResultadoPaginacao = $Paginacao->paginacao('situacoes_users');

        $Listar = new ModelsRead();
        $Listar->ExeRead('situacoes_users','ORDER BY id ASC LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }
    
    
    
      function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->inserir();
        endif;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }

    private function inserir() {

        $Create = new ModelsCreate();
        $Create->ExeCreate('situacoes_users', $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }


    public function visualizar($SitUsuarioId) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('situacoes_users', 'WHERE id=:id LIMIT :limit', "id={$this->SitUsuarioId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }



    public function editar($SitUsuarioId, array $Dados) {
        $this->SitUsuarioId = (int) $SitUsuarioId;
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('situacoes_users', $this->Dados, 'WHERE id =:id', "id={$this->Dados['id']}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
   }

   
   public function apagar($SitUsuarioId) {
       $this->SitUsuarioId = (int) $SitUsuarioId;
       $this->Dados = $this->visualizar($this->SitUsuarioId);
       if ($this->getRowCount() >= 0):
           
           $ApagarSitUsuario = new ModelsDelete();
          $ApagarSitUsuario->ExeDelete('situacoes_users', 'WHERE id=:id', "id={$this->SitUsuarioId}");
          $this->Resultado = $ApagarSitUsuario->getResultado();
           
           else:
               
       endif;
       
       
   }
   
   
    
}
