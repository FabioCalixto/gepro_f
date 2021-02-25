<?php
if (!defined('URL')) {
    header("Location: /");
    exit();

}
?>

<div class="content p-1">

    <div class="list-group-item">
                <div align="right" style="margin: 0px; margin-bottom: 0;">
        <a href="<?php echo URLADM; ?>home/index" ><span class="badge badge-danger">Fechar</span></a>
    </div>
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo"> Unidade</h2>
            </div>
        </div>
        <?php

        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;
        if (isset($_SESSION['msgcad'])):
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        endif;

 //   $this->Dados = $this->Dados[0];

    
             
              
  
          
   
            
             
  // executa o que vc quer

        
       // $paginacao = $this->Dados[1];

        
        ?>

    <form  name="CadPesquisaInfractorProcesso" class="form-inline" method="POST" action="<?php echo URLADM . "consulta-unidade-poli/pesquisar-unidade-poli";?>">
        <div class="form-group">
            <label></label>
            
              <div class="col-sm-3">
                <select class="form-control" name="name">
                    <option value="">Selecione a Unidade</option>
                  <?php
                        $vis = new \App\adms\Models\helper\AdmsRead();
                        $vis->ExeRead('adms_unidade_policial');

                        foreach ($vis->getResultado() as $unidades):
                            extract($unidades);
                            $idU = $unidades['id'];
                            $unit = $unidades['unidade_policial'];

                            if ($valorForm['cod_unidade_policial'] == $id):
                                $selecionado = "selected";
                            else:

                                $selecionado = "";
                            endif;
                            echo "<option value='$idU' $selecionado>$unit</option>";
                        endforeach;
                        ?>
                    </select> 

            </div> 
        </div>

        <input type="submit" class="btn btn-info" value="Pesquisar" name="SendPesquisaInfractorUnidadePoli">
    </form>   
<br>
     

        <!--
           <div class="float-right">
        <a href="<?php echo URL; ?>controle-sit-usuario/cadastrar"><button type="button" class="btn btn-sm btn-success">Registar</button></a>
    </div>
        -->
        <div class="table-responsive">
            <?php
            if (!empty($this->Dados[0])):
                ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Processo</th>
                            <th>Nome do Infrator</th>
                            <th>Nº do BI</th>
                            <th>Nip</th>
                            <th class="d-none d-sm-table-cell">Patente</th>
                            <th class="d-none d-lg-table-cell">Estado do Processo</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($this->Dados[0] as $user) {
                            extract($user);
                         
                            ?>   

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $processo; ?></td>
                                <td><?php echo $nome_infractor; ?></td>
                                <td><?php echo $numero_bi; ?></td>
                                <td><?php echo $nip; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $patente_policia; ?></td>
                                <td class="d-none d-lg-table-cell"><?php echo $descricao_proc;  ?></td>

                                
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>

                <?php
            endif;
      // echo $paginacao;
            ?>

        </div>
    </div>
</div>
