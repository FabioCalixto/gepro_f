<?php
include('PHPMailer/PHPMailerAutoload.php');
//require ('assets/lib/PHPMailer/class.phpmailer.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsEnviaEmail
 *
 * @author 100977407
 */
class ModelsEnviaEmail {

    //put your code here
    private $Dados;
    private $Assunto;
    private $Mensagem;
    private $RemetenteNome;
    private $RemetenteEmail;
    private $DestinoEmail;
    private $Mail;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function Enviar(array $Dados) {
        $this->Dados = $Dados;

        // var_dump($this->Dados);
        $this->setEmail();
    }

    private function setEmail() {
        $this->Assunto = $this->Dados['assunto'];
        $this->Mensagem = $this->Dados['mensagem'];
        $this->RemetenteNome = "GINFRA";
        //Inserir abaixo seu email de remetente
        $this->RemetenteEmail = "candidaturasfaa@hotmail.com";
        $this->DestinoNome = $this->Dados['destinoNome'];
        $this->DestinoEmail = $this->Dados['destinoEmail'];
        if (empty($this->RemetenteEmail)):
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário inserir um email de rementente! Local: adm/models/helper/ModelsEnviaEmail.php / linha: 38 e dados do servidor linha 53 a 56</div>";
            die();
        else:
            $this->configurarEmail();
            $this->sendMail();
        endif;
    }

    private function configurarEmail() {



        //Inserir os Dados do Servidor para enviar o e-mail
        $this->Mail = new PHPMailer();
        $this->Mail->Host = 'smtp-mail.outlook.com';
        $this->Mail->Port = '587';
        $this->Mail->Username = 'candidaturasfaa@hotmail.com';
        $this->Mail->Password = 'devilar10';
        $this->Mail->CharSet = 'UTF-8';

        if (empty($this->Mail->Host)):
            $_SESSION['msgcad'] = "<div class='alert alert-danger'>Necessário inserir os dados do servidor linha 53 a 56</div>";
            die();
        endif;

        //Envia Email em HTML
        $this->Mail->isHTML(true);



        //SMTP AUTH
        $this->Mail->IsSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->SMTPSecure = 'tsl';
        $this->Mail->IsHTML(true);

        //Remetente e Retorno
        $this->Mail->From = $this->RemetenteEmail;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->AddReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //Assunto, mensagem e destino
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->AddAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function sendMail() {
        if ($this->Mail->Send()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

}
