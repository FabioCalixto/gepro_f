<?php
namespace App\adms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}
/**
 * Descricao de ModelsUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsInfractor {

    private $Resultado;
    private $InfraId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;

    const Entity = 'tab_infratores';

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function listar($PageId) {
        $Paginacao = new ModelsPaginacao(URL . 'controle-infractor/index/');
        $Paginacao->condicao($PageId, 10);
        $this->ResultadoPaginacao = $Paginacao->paginacao('tab_infratores');

        $Listar = new ModelsRead();
        $Listar->fullRead('SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tb_patente.patente,
        tb_patente.patente_mga,
        tb_processo.processo,
        tb_estado_processo.descricao_proc
                
        FROM
        tab_infratores
                
        INNER JOIN tb_patente ON tb_patente.cod_patente = tab_infratores.cod_patente
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_u_e_o ON tb_u_e_o.id = tab_infratores.cod_Unidade LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");

        //  $Listar->ExeRead('tab_infratores', 'LIMIT :limit OFFSET :offset', "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            //echo "Nenhum usuário encontrado<br>";
            $Paginacao->paginaInvalida();
        endif;
    }

    public function visualizar($InfraId) {
        $this->InfraId = (int) $InfraId;
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
        tab_infratores.id,
        tab_infratores.nome_infractor,
        tb_processo.processo,
        tb_patente.patente,
        tb_patente.patente_mga,
        tb_u_e_o.designacao_Unidade,
        tb_estado_processo.descricao_proc,
        tab_infratores.nome_pai,
        tab_infratores.nome_mae,
        tab_infratores.numero_bi,
        tab_infratores.data_nascimento,
        tab_infratores.nip,
        tb_sexo.sexo,
        tab_infratores.nome_denuciante,
        tab_infratores.data_infracao,
        tb_processo.instrutor,
        tab_infratores.created,
        tab_infratores.modified
                
        FROM
        tab_infratores
                
        INNER JOIN tb_processo ON tb_processo.id = tab_infratores.n_processo
        INNER JOIN tb_patente ON tab_infratores.cod_patente = tb_patente.cod_patente
        INNER JOIN tb_u_e_o ON tab_infratores.cod_Unidade = tb_u_e_o.id
        INNER JOIN tb_estado_processo ON tb_estado_processo.id = tb_processo.situacaoprocesso_id
        INNER JOIN tb_sexo ON tab_infratores.sexo = tb_sexo.id WHERE tab_infratores.id =:id ", "id={$this->InfraId}");



        //  $Visualizar->ExeRead('tab_infratores', 'WHERE id =:id LIMIT :limit', "id={$this->InfraId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();

        $this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->ValidarDados();
        if ($this->Resultado):
            $this->inserir();
        endif;
    }

    public function listarCadastrar() {
        $Listar = new \App\adms\Models\helper\AdmsRead();
        $Listar->ExeRead('tb_patente');
        $patente = $Listar->getResultado();

        $Listar->ExeRead('tb_u_e_o');
        $Unidades = $Listar->getResultado();


        $Listar->ExeRead('tb_processo');
        $Processos = $Listar->getResultado();

        $this->Resultado = array($Infraccoes, $patente, $Unidades, $Processos);
        //var_dump($this->Resultado);
        return $this->Resultado;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        $this->Dados = array_map('htmlspecialchars', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            //       $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

    private function inserir() {
        $Create = new \App\adms\Models\helper\AdmsCreate();
        $Create->ExeCreate(self::Entity, $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    public function editar($InfraId, array $Dados) {
        $this->InfraId = (int) $InfraId;
        $this->Dados = $Dados;

        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new \App\adms\Models\helper\AdmsUpdate();
        $Update->ExeUpdate(self::Entity, $this->Dados, "WHERE id = :id", "id={$this->InfraId }");
        if ($Update->getResultado()):
            $_SESSION['msg'] = "<div class='alert alert-success'><b>Sucesso: </b>O Dado do Infractor {$this->Dados['nome_infractor']} foi editado no sistema!</div>";
            $this->Resultado = true;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro: </b> O Dado do Infractor  {$this->Dados['nome_infractor']} não foi editado no sistema!</div>";
            $this->Resultado = false;
        endif;
    }

    public function apagar($InfraId) {
        $this->Dados = $this->visualizar($InfraId);
        //   var_dump($this->Dados);
        if ($this->getRowCount() > 0):
            echo "O usuario existe: {$this->getRowCount()}<br>";
            $ApagarUsuario = new \App\adms\Models\helper\AdmsDelete();
            $ApagarUsuario->ExeDelete('user\s', 'WHERE id = :id', "id=$UserId");
            $this->Resultado = $ApagarUsuario->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário apagado com sucesso.</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi encontrado o usuário.</div>";
        endif;
    }

}
