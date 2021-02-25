<?php
if (!defined('URL')) {
    header("Location: http://celke.com.br?derev=7rdk");
    exit();
}


/**
 * Descricao de ModelsUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsPesquisaUsuario {

    private $Resultado;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;
    private $PageId;


    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }
    public function pesquisarUsuarios($PageId = null, $Dados = null) {

        $this->PageId = $PageId;
        $this->Dados = $Dados;

        $this->PageId = strip_tags($this->PageId);
        $this->PageId = trim($this->PageId);

        $this->Dados['name'] = strip_tags($this->Dados['name']);
        $this->Dados['name'] = trim($this->Dados['name']);
        $this->Dados['email'] = strip_tags($this->Dados['email']);
        $this->Dados['email'] = trim($this->Dados['email']);

        if (!empty($this->Dados['name']) and ! empty($this->Dados['email'])):
            $this->pesquisarUsuariosComp();
        elseif (!empty($this->Dados['name'])):
            $this->pesquisarUsuariosName();
        elseif (!empty($this->Dados['email'])):
            $this->pesquisarUsuariosEmail();
        endif;
        
        return $this->Resultado;
    }
    
    private function pesquisarUsuariosComp() {
        $Paginacao = new ModelsPaginacao(URL . 'controle-usuario/pesquisar-usuario/', 'name=' . $this->Dados['name'], '&email=' . $this->Dados['email']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT id
				FROM users
                                WHERE name LIKE '%' :name '%' OR 
                                email LIKE '%' :email '%'", 
                                "name={$this->Dados['name']}&email={$this->Dados['email']}");
        //var_dump($this->ResultadoPaginacao);
        
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT id, name, email,created 
				FROM users
                                WHERE name LIKE '%' :name '%' OR 
                                email LIKE '%' :email '%'  
                                ORDER BY id DESC LIMIT :limit OFFSET :offset", 
                                "name={$this->Dados['name']}&email={$this->Dados['email']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif; 
    }
    
    private function pesquisarUsuariosName() {
        $Paginacao = new ModelsPaginacao(URL . 'controle-usuario/pesquisar-usuario/', 'name=' . $this->Dados['name']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT id
				FROM users
                                WHERE name LIKE '%' :name '%'", 
                                "name={$this->Dados['name']}");
        //var_dump($this->ResultadoPaginacao);
        
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT id, name, email,created 
				FROM users
                                WHERE name LIKE '%' :name '%'  
                                ORDER BY id DESC LIMIT :limit OFFSET :offset", 
                                "name={$this->Dados['name']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif; 
    }
    
    private function pesquisarUsuariosEmail() {
        $Paginacao = new ModelsPaginacao(URL . 'controle-usuario/pesquisar-usuario/', 'email=' . $this->Dados['email']);
        $Paginacao->condicao($this->PageId, 1);
        $this->ResultadoPaginacao = $Paginacao->paginacaoFullRead("SELECT id
				FROM users
                                WHERE email LIKE '%' :email '%'", 
                                "email={$this->Dados['email']}");
        //var_dump($this->ResultadoPaginacao);
        
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT id, name, email,created 
				FROM users
                                WHERE email LIKE '%' :email '%'  
                                ORDER BY id DESC LIMIT :limit OFFSET :offset", 
                                "email={$this->Dados['email']}&limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            //var_dump($this->Resultado);
            $this->Resultado = array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif; 
    }

}
