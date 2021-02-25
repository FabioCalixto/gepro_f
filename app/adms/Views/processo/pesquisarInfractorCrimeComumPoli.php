<?php
if (!defined('URL')) {
    header("Location: /");
    exit();

}
?>

<div class="content p-1">

    <div class="list-group-item">
                <div align="right" style="margin: 0px; margin-bottom: 0;">
        <a href="<?php echo URL; ?>controle-home/index" ><span class="badge badge-danger">Fechar</span></a>
    </div>
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Crime Comum</h2>
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

    <form  name="SendPesquisaInfractorCrimeComum" class="form-inline" method="POST" action="<?php echo URLADM . "consultapor-crime-comum-poli/pesquisar-crime-comum-poli";?>">
        <div class="form-group">
            <label>Nome</label>
            
              <div class="col-sm-3">
                <select class="form-control" name="name">
                    <option value="">Selecione o Crime Comum</option>
                    <?php
                        $vis = new \App\adms\Models\helper\AdmsRead();
                        $vis->ExeRead('adms_crime_comum');
                        foreach ($vis->getResultado() as $processos):
                            extract($processos);
                            $idP = $processos['id'];
                            $proc = $processos['descricao_crimecomum'];
                            if ($valorForm['id_crime_comum'] == $id):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$idP' $selecionado>$proc</option>";
                        endforeach;
                        ?>
                    </select> 

            </div> 
        </div>

        <input type="submit" class="btn btn-info" value="Pesquisar" name="SendPesquisaInfractorCrimeComumPoli">
    </form>   <br>

     

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
                            <th>Nome do Infractor</th>
                            <th>Nº do BI</th>
                            <th>Nip</th>
                            <th class="d-none d-sm-table-cell">Patente</th>
                            <th class="d-none d-lg-table-cell">Estado do Processo</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cont=1;
                        foreach ($this->Dados[0] as $user) {
                            extract($user);
                         
                            ?>   

                            <tr>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $processo; ?></td>
                                <td><?php echo  $nome_infractor; ?></td>
                                <td><?php echo $numero_bi; ?></td> 
                                <td><?php echo $nip; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $patente_policia; ?></td>
                                <td class="d-none d-lg-table-cell"><?php echo $descricao_proc;  ?></td>

                               
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                $cont++;
            endif;
      // echo $paginacao;
            ?>

        </div>
    </div>
</div>
