<meta charset="utf-8">
<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>

<script type="text/javascript">

function letras(){
  tecla = event.keyCode;
  if (tecla >= 48 && tecla <= 57){
      return false;
  }else{
     return true;
  }
}

</script>


  <script language='JavaScript'>
 

</script>

<script src="<?php echo URLADM . 'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Dados do Infrator</h2>
            </div>

            <a href="<?php echo URLADM; ?>controle-home/index">
                <div class="p-2">
                  <span class=" badge badge-danger">
                        Fechar
                    </span>
                </div>
            </a>


        </div>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
       
        <hr>
        <form name="CadInfractor" action="" method="post" enctype="multipart/form-data">
             <div class="form-row">
                <div class="form-group col-md-2">
                    <label><span class="text-danger">*</span> Condição do Infractor</label>
                    <select name="adms_condicao_id" id="adms_condicao_id" class="form-control" required="">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['condicao_pre'] as $est) {
                            extract($est);
                            if ($valorForm['adms_condicao_id'] == $id) {
                                echo "<option value='$id' selected>$descricao_codicao</option>";
                            } else {
                                echo "<option value='$id'>$descricao_codicao</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                     <div class="form-group col-md-8">
                   
                </div>
                    <div class="form-group col-md-2 ">
                    <label><span class="text-danger">*</span> Foto:</label><br>
                            <?php
                            $imagem_antiga = URLADM . 'assets/imagens/usuario/icone_usuario.png';

                            $icone_uploada_foto = URLADM . 'assets/imagens/usuario/icone_uploada_foto.png';

                            ?>
                            <img src="<?php echo $imagem_antiga; ?>"  alt="Imagem do Especialista" id="preview-user" class="img-thumbnail" style="width: 80px; height: 80px; "><br>
                            <input name="imagem_nova" type="file" onchange="previewImagem();" id="imagem_nova" style="display: none;" accept="image/*">
                            <a href="#" class="btnfoto"><img width="20" height="20" src="<?php echo $icone_uploada_foto; ?>"></a>
                </div>
             </div>
            
          
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome do Infrator</label>
                    <input name="nome_infractor" type="text" class="form-control" id="nome" required="" maxlength="50" onkeypress="return letras()" placeholder="Escreva o Nome completo do Infractor" value="<?php
                    if (isset($valorForm['nome_infractor'])): echo $valorForm['nome_infractor'];
                    endif;
                    ?>">
                </div>

                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome do Pai</label>
                    <input type="text"  class="form-control" name="nome_pai" required="" maxlength="50" onkeypress="return letras()"  placeholder="Escreva o Nome do Pai" value="<?php
                    if (isset($valorForm['nome_pai'])): echo $valorForm['nome_pai'];
                    endif;
                    ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label><span class="text-danger">*</span> Nome da Mãe</label>
                    <input type="text"  class="form-control" name="nome_mae" required="" maxlength="50" onkeypress="return letras()" placeholder="Escreva o Nome da Mãe" value="<?php
                    if (isset($valorForm['nome_mae'])): echo $valorForm['nome_mae'];
                    endif;
                    ?>">
                </div>

                <div class="form-group col-md-2">
                    <label><span class="text-danger"></span> Nº do BI</label>
                    <input type="text"  class="form-control" name="numero_bi" pattern="[0-9]{9}[A-Z]{2}[0-9]{3}$" placeholder="Escreva o Nº Bilhete" maxlength="14" value="<?php
                    if (isset($valorForm['numero_bi'])): echo $valorForm['numero_bi'];
                    endif;
                    ?>">
                </div>
           
                <div class="form-group col-md-2.1">
                    <label><span class="text-danger">*</span> Data de Nascimento</label>
                    <input type="date" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" required="" class="form-control" name="data_nascimento" placeholder="" value="<?php
                    if (isset($valorForm['data_nascimento'])): echo $valorForm['data_nascimento'];
                    endif;
                    ?>">
                </div>


                 <div class="form-group col-md-2.5" >
                    <label><span class="text-danger">*</span> Sexo</label>
                    <select name="sexo" id="sexo" class="form-control" required="" >
                        <option value="">Selecione o Sexo</option>
                        <?php
                        foreach ($this->Dados['select']['sex'] as $est) {
                            extract($est);
                            if ($valorForm['sexo'] == $id) {
                                echo "<option value='$id' selected>$sexo</option>";
                            } else {
                                echo "<option value='$id'>$sexo</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <p align="left" > INSTRUÇÃO </p>
            <hr style="border: 1px solid #8FBC8F ">


            <div class="form-row">
                <div class="form-group col-md-1.5">
                    <label><span class="text-danger">*</span> Processo</label>
                   <select name="n_processo" id="n_processo" class="form-control" required="" >
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['proc'] as $proc) {
                            extract($proc);
                            if ($valorForm['n_processo'] == $id) {
                                echo "<option value='$id' selected>$processo</option>";
                            } else {
                                echo "<option value='$id'>$processo</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
      
                <div class="form-group col-md-3.1">
                    <label><span class="text-danger"></span> Crime de Natureza Militar</label>
                    <select name="id_crime_militar" id="sexo" class="form-control" >
                        <option value="">Selecione o Crime Militar</option>
                        <?php
                        foreach ($this->Dados['select']['crim_milit'] as $infra) {
                            extract($infra);
                            if ($id != 19) {
                               if ($valorForm['id_crime_militar'] == $id) {
                                echo "<option value='$id' selected>$descricao_crime_militar</option>";
                            } else {
                                echo "<option value='$id'>$descricao_crime_militar</option>";
                            }
                            }
                            
                        }
                        ?>
                    </select> 
                </div>

                <div class="form-group col-md-3.1">

                    <label><span class="text-danger"></span> Crime de Natureza Comum</label>
                          <select name="id_crime_comum" id="sexo" class="form-control" >
                        <option value="">Selecione o Crime Comum</option>
                        <?php
                        foreach ($this->Dados['select']['crime_comum'] as $comum) {
                            extract($comum);
                            if ($id != 15) {
                                if ($valorForm['id_crime_comum'] == $id) {
                                echo  "<option value='$id' selected>$descricao_crimecomum</option>";
                            } else {
                                echo "<option value='$id'>$descricao_crimecomum</option>";
                            }
                            }
                            
                        }
                        ?>
                    </select> 

                </div>
            
                <div class="form-group col-md-2" id="nip">
                    <label><span class="text-danger">*</span>Nip</label>
                    <input type="text"  class="form-control" name="nip" maxlength="9"  onkeypress='return SomenteNumero(event)' placeholder="Escreva o Nip" value="<?php
                    if (isset($valorForm['nip'])): echo $valorForm['nip'];
                    endif;
                    ?>">
                </div>


                <div class="form-group col-md-3" id="cod_ramo">
                    <label><span class="text-danger">*</span>Ramo </label>
                    <select class="form-control selectpersonalizada" name="cod_ramo"  id="ramoPatente">
                         <option value="">Selecione o Ramo</option>
                          <?php
                    $vis = new \App\adms\Models\helper\AdmsRead();
                    //falta tabela estante
                    $vis->ExeRead('tb_ramo');

                     foreach ($vis->getResultado() as $autor):
                        extract($autor);
                     
                             ?>
                        <option value="<?php echo $autor["cod_ramo"]; ?>"><?php echo $autor["descricao_ramo"]; ?></option>
                                   <?php 
                    endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-3" >
                    <label><span class="text-danger">*</span>Patente:</label>
                    <select class="form-control selectpersonalizada" name="cod_patente" id="cod_patente">
                        <option value="">Selecione</option>                        
                    </select>
                </div>
                 
        
                <div class="form-group col-md-5" id="unidade_militar" >
                    <label><span class="text-danger">*</span> Unidade Militar:</label>
                   <select name="cod_Unidade" id="sexo" class="form-control" >
                        <option value="">Selecione a Unidade Militar</option>
                        <?php
                        foreach ($this->Dados['select']['unid'] as $uni) {
                            extract($uni);
                            if ($valorForm['cod_Unidade'] == $id) {
                                echo "<option value='$id' selected>$designacao_Unidade</option>";
                            } else {
                                echo "<option value='$id'>$designacao_Unidade</option>";
                            }
                        }
                        ?>
                    </select>
                </div>


               
                 

                <div class="form-group col-md-6">

                    <label><span class="text-danger">*</span> Nome do Queixoso ou Participante</label>
                    <input type="text"  class="form-control" name="nome_denuciante"  maxlength="50" onkeypress="return letras()" required="" placeholder="Escreva o Nome do Qeixoso ou Participante" value="<?php
                    if (isset($valorForm['nome_denuciante'])): echo $valorForm['nome_denuciante'];
                    endif;
                    ?>">

                </div>
            </div>

            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

            <p>
                <span class="text-danger">* </span>Campos Obrigatório
            </p>
            <button type="submit" class="btn btn-success" value="Guardar" name="CadInfractor">Guardar</button>
        </form>
    </div>
</div>
