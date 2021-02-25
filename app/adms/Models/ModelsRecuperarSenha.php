<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelsRecuperarSenha
 *
 * @author 100977407
 */
class ModelsRecuperarSenha {

    //put your code here
   private $Dados;
    private $DadosSalvarBd;
    private $Resultado;
    private $Msg;
    private $RowCount;
    private $DadosRecSenha;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function recuperarSenha(array $Dados) {
        $this->Dados = $Dados;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('users', 'WHERE email =:email LIMIT :limit', "email={$this->Dados['email']}&limit=1");
        if ($Visualizar->getResultado()):
            $this->Dados= $Visualizar->getResultado();
            $this->criarEmailRecSenha();
            
            $EnviaEmail = new ModelsEnviaEmail();
            $EnviaEmail->Enviar($this->DadosRecSenha);
            
            $Update = new ModelsUpdate();
            $Update->ExeUpdate('users', $this->DadosSalvarBd, 'WHERE id =:id', "id={$this->Dados[0]['id']}");
            
            return $this->Resultado = true;
        else:
            return $this->Resultado = false;
        endif;
    }
    
    private function criarEmailRecSenha() {
        $this->DadosSalvarBd['recuperar_senha'] = md5(time() . "{$this->Dados[0]['email']}");
        
        $this->DadosRecSenha['assunto'] = 'Recuperar Senha';
        $this->DadosRecSenha['destinoNome'] = current(str_word_count($this->Dados[0]['name'], 2));
        $this->DadosRecSenha['destinoEmail'] = $this->Dados[0]['email'];
        $url = URL . 'controle-login/atualizar-senha'.$this->DadosSalvarBd['recuperar_senha'];
        
        $this->DadosRecSenha['mensagem'] = "Olá {$this->DadosRecSenha['destinoNome']} <br><br>";
        $this->DadosRecSenha['mensagem'] .= "Você solicitou uma alteração de senha em Celke.<br>";
        $this->DadosRecSenha['mensagem'] .= "Seguindo o link abaixo você poderá alterar sua senha.<br>";
        $this->DadosRecSenha['mensagem'] .= "Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço abaixo no seu navegador.<br><br>";
        $this->DadosRecSenha['mensagem'] .= $url . "<br><br>";
        $this->DadosRecSenha['mensagem'] .= "Usuário: {$this->Dados[0]['email']}<br><br>";
        $this->DadosRecSenha['mensagem'] .= "Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
        $this->DadosRecSenha['mensagem'] .= "Respeitosamente, Direção de Informática - EMG";
    }

}
