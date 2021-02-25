<?php
namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Descricao de ControleUsuario
 *
 * @copyright (c) year, Fábio Calixto - DI
 */
class ControleInfractor {

    private $Dados;
    private $UserId;
    private $PageId;
    private $InfraId;


    public function index($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";

        $ListarInfractor = new \App\adms\Models\ModelsInfractor();
        $this->Dados = $ListarInfractor->listar($this->PageId);
        $CarregarView = new ConfigView("processo/listarInfractor", $this->Dados);
        $CarregarView->renderizar();
    }
    
    
    public function relatorioGeral() {
         $CarregarView = new ConfigView("relatorios/MapaInfractores");
        $CarregarView->renderizar();
    }




    public function consultaInfractorProcesso($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";

        $ListarInfractor = new ModelsInfractor();
        $this->Dados = $ListarInfractor->listar($this->PageId);


        $CarregarView = new ConfigView("processo/listarInfractorProcesso", $this->Dados);
        $CarregarView->renderizar();
    }
    
    
            
     public function pesquisarInfractorNip($PageId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);
        if (!empty($this->Dados['SendPesquisaInfractorNip'])):
            unset($this->Dados['SendPesquisaInfractorNip']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new ModelsPesquisaInfractorNip();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados);
//        var_dump($this->Dados);
        $CarregarView = new ConfigView("processo/pesquisarInfractorNip", $this->Dados);
        $CarregarView->renderizar();
    }
    
        
     public function pesquisarInfractorProcesso($PageId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);
        if (!empty($this->Dados['SendPesquisaInfractorProcesso'])):
            unset($this->Dados['SendPesquisaInfractorProcesso']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarUsuarios = new ModelsPesquisaInfractorProcesso();
        $this->Dados = $PesquisarUsuarios->pesquisarInfractoresP($this->PageId, $this->Dados);
//        var_dump($this->Dados);
        $CarregarView = new ConfigView("processo/pesquisarInfractorProcesso", $this->Dados);
        $CarregarView->renderizar();
    }
    
    
    
         public function pesquisarInfractorPatente($PageId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);
        if (!empty($this->Dados['SendPesquisaInfractorPatente'])):
            unset($this->Dados['SendPesquisaInfractorPatente']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractor = new ModelsPesquisaInfractorPatente();
        $this->Dados = $PesquisarInfractor->pesquisarInfractoresP($this->PageId, $this->Dados);
//        var_dump($this->Dados);
        $CarregarView = new ConfigView("processo/pesquisarInfractorPatente", $this->Dados);
        $CarregarView->renderizar();
    }
    

    public function consultaInfractorUnidade($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";

        $ListarInfractor = new ModelsInfractor();
        $this->Dados = $ListarInfractor->listar($this->PageId);


        $CarregarView = new ConfigView("processo/listarInfractorUnidade", $this->Dados);
        $CarregarView->renderizar();
    }
    

    

    public function pesquisarInfractorUnidade($PageId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);
        if (!empty($this->Dados['SendPesquisaInfractor'])):
            unset($this->Dados['SendPesquisaInfractor']);
        else:
            $this->PageId = ((int) $PageId ? $PageId : 1);
            $this->Dados['name'] = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
        //  $this->Dados['email'] = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        endif;

        $PesquisarInfractores = new ModelsPesquisaInfractor();
        $this->Dados = $PesquisarInfractores->pesquisarInfractores($this->PageId, $this->Dados);
//        var_dump($this->Dados);
        $CarregarView = new ConfigView("processo/pesquisarInfractorUnidade", $this->Dados);
        $CarregarView->renderizar();
    }

        public function RegistrarInfractor()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendCadInfractor'])) {
            unset($this->Dados['SendCadInfractor']);
          //  $this->Dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadInfractor = new \App\adms\Models\ModelsInfractor();
            $cadInfractor->cadastrar($this->Dados);
            if ($cadInfractor->getResultado()) {
              //  $UrlDestino = URLADM . 'usuarios/listar';
              //  header("Location: $UrlDestino");
            } else {
               // $this->Dados['form'] = $this->Dados;
               // $this->cadUsuarioViewPriv();
            }
        }
               $carregarView = new \Core\ConfigView("adms/Views/processo/registarInfractor", $this->Dados);
                 $carregarView->renderizar();
    }

    

    public function cadastrarInfractor() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadInfractor = new \App\adms\Models\ModelsInfractor();
        if (!empty($this->Dados['SendCadInfractor'])):
            unset($this->Dados['SendCadInfractor']);
            //   $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            //var_dump($this->Dados);
            $CadInfractor->cadastrar($this->Dados);
            if (!$CadInfractor->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao Registar: </b>Para Registar o Infractor preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Infractor Registado com sucesso!</div>";
                //     $UrlDestino = URL . 'controle-usuario/index';
                //  header("Location: $UrlDestino");
               // unset($this->Dados);
                $this->Dados = NULL;
            endif;
        endif;

        $Registros = $CadInfractor->listarCadastrar();
        $this->Dados = [$Registros[0],$Registros[1],$Registros[2],$Registros[3],$this->Dados];
        $CarregarView = new ConfigView("processo/registarInfractor", $this->Dados);
        $CarregarView->renderizar();
    }

    

    public function visualizar($InfraId = null) {
        $this->InfraId = (int) $InfraId;
        if (!empty($this->InfraId)):
            $VerInfractor = new ModelsInfractor();
            $this->Dados = $VerInfractor->visualizar($InfraId);
          //  var_dump($this->Dados);
            $CarregarView = new ConfigView("processo/visualizarInfractor", $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "Necessário selecionar um Infractor<br>";
            $UrlDestino = URL . 'controle-infractor/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($InfraId = null) {
        $this->InfraId = (int) $InfraId;
        if (!empty($this->InfraId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            //var_dump($Registros);
           $EditaInfractor = new ModelsInfractor();
           $Registros = $EditaInfractor->listarCadastrar();
            //var_dump($Registros);
            $this->Dados = [$Registros[0],$Registros[1],$Registros[2],$Registros[3],$this->Dados];
            $CarregarView = new ConfigView("processo/alterarDadosInfractor", $this->Dados);
            $CarregarView->renderizar();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Infractor</div>";
            $UrlDestino = URL . 'controle-infractor/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['SendEditaInfractor'])):
            unset($this->Dados['SendEditaInfractor']);
            $EditaInfractor = new ModelsInfractor();
            $EditaInfractor->editar($this->InfraId, $this->Dados);
            if (!$EditaInfractor->getResultado()):
                $this->Dados['msg'] = $EditaInfractor->getMsg();
            else:
                $this->Dados['msg'] = $EditaInfractor->getMsg();
                $UrlDestino = URL . 'controle-infractor/visualizar/' . $this->InfraId;
                header("Location: $UrlDestino");
            endif;
        else:
            $VerInfractor = new ModelsInfractor();
            $this->Dados = $VerInfractor->visualizar($this->InfraId);
            if ($VerInfractor->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Infractor</div>";
                $UrlDestino = URL . 'controle-infractor/index';
                header("Location: $UrlDestino");
            endif;
        //var_dump($this->Dados);
        endif;
    }


}
