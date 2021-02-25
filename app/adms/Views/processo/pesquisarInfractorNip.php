<?php
if (!defined('URL')) {
    header("Location: /");
    exit();

}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Pesquisa Infractor</h2>
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

  


      
 
        ?>

    <form  name="CadPesquisaInfractorNip" class="form-inline" method="POST" action="<?php echo URLADM . "consulta-nip/pesquisar-nip";?>">
        <div class="form-group">
            <label>Nip</label>
            
              <div class="col-sm-3">
      <input type="text" name="name" class="form-control" placeholder="Nip do Infractor">
            </div> 
        </div>

        <input type="submit" class="btn btn-info" value="Pesquisar" name="SendPesquisaInfractorNip">
    </form>   

        <div class="float-right">
         <a href="<?php echo URL; ?>controle-infractor/cadastrarInfractor"><button type="button" class="btn btn-outline-success btn-sm ">Registar</button></a>
        </div>

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
                        $i=1;
                        foreach ($this->Dados[0] as $user) {
                            extract($user);
                         
                            ?>   

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $processo; ?></td>
                                <td><?php echo  $nome_infractor; ?></td>
                                <td><?php echo $numero_bi; ?></td>
                                <td><?php echo  $nip; ?></td>
                                <td class="d-none d-sm-table-cell"><?php
                                if($cod_ramo <= 3 || $cod_ramo == 5):
                                 echo $patente;
                             else:
                                 echo $patente_mga;
                                 endif; ?></td>
                                <td class="d-none d-lg-table-cell"><?php echo $descricao_proc;  ?></td>

                                
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                $i++;
            endif;
      // echo $paginacao;
            ?>

        </div>
    </div>
</div>
