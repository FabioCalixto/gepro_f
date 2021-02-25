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
 */
class AdmsCadastrarInfractorPoli {
    //put your code here
    
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
        $verPerfil->fullRead("SELECT * FROM tab_infratores_policia WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;
    }

    public function cadInfractor(array $Dados)
    {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $this->Foto = $this->Dados['imagem_nova'];
        unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);
        $this->inserirInfractor();
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
       
        $cadInfractor = new \App\adms\Models\helper\AdmsCreate;
        $cadInfractor->exeCreate("tab_infratores_policia", $this->Dados);
        if ($cadInfractor->getResultado()) {
            if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Infractor cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id'] = $cadInfractor->getResultado();
                $this->valFoto();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro:  O Infractor que tentou cadatrar já existe!  por favor verifique O Nip ou Nº do BI!</div>";
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
        tb_patente.id,
        tb_patente.patente
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

        $this->Resultado = ['sex' => $registro['sex'], 'crime_comum' => $registro['crime_comum'],'unid' => $registro['unid'],'proc' => $registro['proc'],'pat' => $registro['pat'],'condicao_pre' => $registro['condicao_pre'],'crim_milit' => $registro['crim_milit'],'post_pol' => $registro['post_pol'],'unidade_poli' => $registro['unidade_poli']];

        return $this->Resultado;
    }


    public function estatisticaCrimePolicia() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
            
                     COUNT(tab_infratores_policia.cod_posto_policia) AS policiaCrime, adms_postos_policia.patente_policia,
 
                ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores_policia)) * 100 ) AS percentage
                 FROM
                 tab_infratores_policia
    
                 INNER JOIN adms_postos_policia ON tab_infratores_policia.cod_posto_policia = adms_postos_policia.id 
                 INNER JOIN adms_crime_comum ON tab_infratores_policia.id_crime_comum = adms_crime_comum.id 
                 GROUP BY tab_infratores_policia.cod_posto_policia");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

     public function estatisticaPorNatureza() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
            
                     COUNT(tab_infratores_policia.id_crime_comum) AS quantidadeInfractores, adms_crime_comum.descricao_crimecomum As crime,
 
              ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores_policia)) * 100 ) AS percentage
                 FROM
                 tab_infratores_policia
    
                INNER JOIN adms_crime_comum ON tab_infratores_policia.id_crime_comum = adms_crime_comum.id 
                GROUP BY tab_infratores_policia.id_crime_comum");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

public function estatisticaSexoPolicia() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
            
                     COUNT(tab_infratores_policia.sexo) AS quantidadesexo, tb_sexo.sexo AS perSe,
 
                ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores_policia)) * 100 ) AS percentage
                 FROM
                 tab_infratores_policia
                     
                 INNER JOIN tb_sexo ON tb_sexo.id = tab_infratores_policia.sexo 
                 GROUP BY tab_infratores_policia.sexo");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

     public function estatisticaPorCrimeMilitar() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
                   
                     COUNT(tab_infratores_policia.id_crime_militar) AS quantidadeInfractores, adms_crime_militar.descricao_crime_militar As militar,
 
              ((COUNT( * ) / ( SELECT COUNT( * ) FROM tab_infratores_policia)) * 100 ) AS percentage
                 FROM
                 tab_infratores_policia
    
                INNER JOIN adms_crime_militar ON tab_infratores_policia.id_crime_militar = adms_crime_militar.id 
                GROUP BY tab_infratores_policia.id_crime_militar");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

        public function estatisticaPorAnoInstrcao() {
    
        $Visualizar = new \App\adms\Models\helper\AdmsRead();


        $Visualizar->fullRead("SELECT
                     tb_processo.anoinstrucao_id, 
                     COUNT(tb_processo.anoinstrucao_id) AS ano, tb_ano_instrucao.ano,
 
                     ((COUNT( * ) / ( SELECT COUNT( * ) FROM tb_processo)) * 100 ) AS percentage

                   FROM
                   tb_processo
                
                    INNER JOIN tb_ano_instrucao ON tb_processo.anoinstrucao_id = tb_ano_instrucao.id 
                   
                    GROUP BY tb_processo.anoinstrucao_id ");

        $this->Resultado = $Visualizar->getResultado();

        //$this->RowCount = $Visualizar->getRowCount();

        return $this->Resultado;
    }

}
