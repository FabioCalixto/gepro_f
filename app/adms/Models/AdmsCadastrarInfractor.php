<?php

namespace App\adms\Models;
if (!defined('URL')) {
    header("Location: /");
    exit();
}


/**
 * FAMASOFT LDA
 *
 * @author ´Fábio Calixto 923644428
 */class AdmsCadastrarInfractor {
    //put your code here
     private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function verInfractor($DadosId)
    {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adms\Models\helper\AdmsRead();
        $verPerfil->fullRead("SELECT * FROM tab_infratores WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
        
    }

    public function cadInfractor(array $Dados)
    {
        $this->Dados = $Dados;
      
        $this->Foto = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

      //
        if($this->Dados['adms_condicao_id']==2)
        {

            unset($this->Dados['nip']);
            $this->Dados['cod_patente']=23;
            $this->Dados['cod_ramo']=5;

           
            
                    
        }  

        //var_dump($this->Dados);


        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        
        $valCampoVazio->validarDados($this->Dados);
      //
        if($valCampoVazio->getResultado()){

                $this->inserirInfractor();

                
        }
        else{

            $_SESSION['msg'] = ' Falha na  validaçao';
        }

       /* if ($valCampoVazio->getResultado()) {
            $this->valCampos();
        } else {
            $this->Resultado = false;
        }*/
    }

    private function valCampos()
    {
      
        $valInfractor = new \App\adms\Models\helper\AdmsValInfractor();
        $valInfractor->valInfractor($this->Dados['nome_infractor']);

        $valInfractorNip = new \App\adms\Models\helper\AdmsValNip();
        $valInfractorNip->valNipInfractor($this->Dados['nip']);
  
        if ( ( $valInfractor->getResultado()) AND ( $valInfractorNip->getResultado())) {
            $this->inserirInfractor();
        } else {
            $this->Resultado = false;
        }
    }

    private function inserirInfractor()
    {
        
        $this->Dados['created'] = date("Y-m-d H:i:s");
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);
 var_dump($this->Dados);
        $cadInfractor = new \App\adms\Models\helper\AdmsCreate;
        $cadInfractor->exeCreate("tab_infratores", $this->Dados);
        if ($cadInfractor->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Infractor cadastrado com sucesso!</div>";
                $this->Resultado = true;
               
            }  else {
                $this->Dados['id'] = $cadInfractor->getResultado();
                $this->valFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Infractor não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    private function valFoto()
    {
        $uploadImg = new \App\adms\Models\helper\AdmsUploadImgRed();
        $uploadImg->uploadImagem($this->Foto, 'assets/imagens/infractor/' . $this->Dados['id'] . '/', $this->Dados['imagem'], 150, 150);
        if ($uploadImg->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Infractor cadastrado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O Infractor não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }

    public function listarCadastrar()
    {
        $listar = new \App\adms\Models\helper\AdmsRead();
        $listar->fullRead("SELECT
            tb_sexo.id,
            tb_sexo.sexo
            FROM
            tb_sexo
            ");
        
        $registro['sex'] = $listar->getResultado();

        $listar->fullRead("SELECT
        adms_crime_comum.id,
        adms_crime_comum.descricao_crimecomum
        FROM
        adms_crime_comum

        ");
        $registro['crime_comum'] = $listar->getResultado();
        
        $listar->fullRead("SELECT
        tb_u_e_o.id,
        tb_u_e_o.designacao_Unidade,
        tb_u_e_o.Cod_Ramo
        FROM
        tb_u_e_o
        ");
        $registro['unid'] = $listar->getResultado();
        
        $listar->fullRead("SELECT
        tb_processo.id,
        tb_processo.processo
        FROM
        tb_processo

        ");
        $registro['proc'] = $listar->getResultado();
        
        $listar->fullRead("SELECT
        tb_patente.cod_patente,
        tb_patente.patente,
        tb_patente.patente_mga
        FROM
        tb_patente

        ");
        $registro['pat'] = $listar->getResultado();
       
        $listar->fullRead("SELECT
        adms_condicao.id,
        adms_condicao.descricao_codicao,
        adms_condicao.id_cor,
        adms_condicao.created,
        adms_condicao.modified
        FROM
        adms_condicao
        ");
        $registro['condicao_pre'] = $listar->getResultado();
        
        $listar->fullRead("SELECT
        adms_crime_militar.id,
        adms_crime_militar.descricao_crime_militar
        FROM
        adms_crime_militar
        ");
        $registro['crim_milit'] = $listar->getResultado();
        
        $listar->fullRead("SELECT
        adms_postos_policia.id,
        adms_postos_policia.patente_policia
        FROM
        adms_postos_policia

        ");
        $registro['post_pol'] = $listar->getResultado();
        
        $listar->fullRead("SELECT
        adms_unidade_policial.id,
        adms_unidade_policial.unidade_policial,
        adms_unidade_policial.ordem
        FROM
        adms_unidade_policial
        ");
        $registro['unidade_poli'] = $listar->getResultado();

        $listar->fullRead("SELECT
        tb_ramo.cod_ramo,
        tb_ramo.descricao_ramo
                
        FROM
        tb_ramo
        ");
        $registro['ramo'] = $listar->getResultado();

        $this->Resultado = ['sex' => $registro['sex'], 'crime_comum' => $registro['crime_comum'],'unid' => $registro['unid'],'proc' => $registro['proc'],'pat' => $registro['pat'],'condicao_pre' => $registro['condicao_pre'],'crim_milit' => $registro['crim_milit'],'post_pol' => $registro['post_pol'],'unidade_poli' => $registro['unidade_poli'],'ramo' => $registro['ramo']];

        return $this->Resultado;
    }

    
}
