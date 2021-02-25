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
class AdmsEditarInfractor {

    //put your code here

    private $Resultado;
    private $Dados;
    private $DadosId;
    private $Foto;
    private $ImgAntiga;

    function getResultado() {
        return $this->Resultado;
    }

    public function verInfractor($DadosId) {
        $this->DadosId = (int) $DadosId;
        $verPerfil = new \App\adms\Models\helper\AdmsRead();
        $verPerfil->fullRead("SELECT * FROM tab_infratores
                WHERE id =:id LIMIT :limit", "id=" . $this->DadosId . "&limit=1");
        $this->Resultado = $verPerfil->getResultado();
        return $this->Resultado;

    }

    public function altInfractor(array $Dados) {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        $this->Foto = $this->Dados['imagem_nova'];
        $this->ImgAntiga = $this->Dados['imagem_antiga'];
        unset($this->Dados['imagem_nova'], $this->Dados['imagem_antiga']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {
            $this->valCampos();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos() {
         
        $EditarUnico = true;
         
        $valInfractor = new \App\adms\Models\helper\AdmsValInfractor();
        $valInfractor->valInfractor($this->Dados['nome_infractor'], $EditarUnico, $this->Dados['id']);

        

  

        if (( $valInfractor->getResultado()) ) {
            $this->valFoto();
        } else {
            $this->Resultado = false;
        }
    }

    private function valFoto() {
        if (empty($this->Foto['name'])) {
            $this->updateEditInfractor();
        } else {
            $slugImg = new \App\adms\Models\helper\AdmsSlug();
            $this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);

            $uploadImg = new \App\adms\Models\helper\AdmsUploadImgRed();
            $uploadImg->uploadImagem($this->Foto, 'assets/imagens/infractor/' . $this->Dados['id'] . '/', $this->Dados['imagem'], 150, 150);
            if ($uploadImg->getResultado()) {
                $apagarImg = new \App\adms\Models\helper\AdmsApagarImg();
                $apagarImg->apagarImg('assets/imagens/infractor/' . $this->Dados['id'] . '/' . $this->ImgAntiga);
                $this->updateEditInfractor();
            } else {
                $this->Resultado = false;
            }
        }
    }

    private function updateEditInfractor() {
        $this->Dados['modified'] = date("Y-m-d H:i:s");
        $this->Dados['nome_denuciante']=$this->Dados['nome_ofendido'];
        unset($this->Dados['nome_ofendido'],$this->Dados['nome_instrutor']);

        $upAltSenha = new \App\adms\Models\helper\AdmsUpdate();
        
        $upAltSenha->exeUpdate("tab_infratores", $this->Dados, "WHERE id =:id", "id=" . $this->Dados['id']);
        if ($upAltSenha->getResultado()) {
            $_SESSION['msg'] = "<div class='alert alert-success'>Dados do Infractor atualizado com sucesso!</div>";
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Os Dados não foram atualizados!</div>";
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

        $this->Resultado = ['sex' => $registro['sex'],'unid' => $registro['unid'],'proc' => $registro['proc'],'pat' => $registro['pat']];

        return $this->Resultado;
    }

}
