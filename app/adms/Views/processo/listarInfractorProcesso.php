<div class="well">
    <div align="right" style="margin: 0px; margin-bottom: 0;">
        <a href="<?php echo URL; ?>controle-home/index" ><span class="badge badge-danger">Fechar</span></a>
    </div>
    <div class="page-header">
        <h1>Consultar Infractor Por Processo</h1>
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

    $paginacao = $this->Dados[1];
    $this->Dados = $this->Dados[0];


    ?>

    <form  name="CadPesquisaInfractorProcesso" class="form-inline" method="POST" action="<?php echo URL . "controle-infractor/pesquisar-infractor-processo"; ?>">
        <div class="form-group">
            <label>Nome</label>

            <div class="col-sm-3">
                <select class="form-control" name="name">
                    <option value="">Selecione</option>
                    <?php
                    $vis = new ModelsRead();
                    $vis->ExeRead('tb_processo');
                    if ($vis->getRowCount() > 0):
                    foreach ($vis->getResultado() as $processos):
                        extract($processos);
                    ?>
                     <option value="<?php echo $processos['id']; ?>"  ><?php echo $processos['processo']; ?></option><?php
                    endforeach;
                endif;
                    ?>
                </select> 
            </div> 




<!--  <input type="text" name="name" class="form-control" placeholder="Nome do Usuário">-->
        </div>

        <input type="submit" class="btn btn-info" value="Pesquisar" name="SendPesquisaInfractorProcesso">
    </form>  


    <div class="pull-right">
         <a href="<?php echo URL; ?>controle-infractor/cadastrarInfractor"><button type="button" class="btn btn-outline-success btn-sm ">Registar</button></a>
    </div>

    <?php
    if (!empty($this->Dados)):
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NºProcesso</th>
                    <th>Nome do Infractor</th>
                    <th class="hidden-xs">Patente</th>
                    <th class="hidden-xs">Estado do Processo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $user) {
                    extract($user);
                    ?>               
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $processo; ?></td>
                        <td><?php echo $nome_infractor; ?></td>
                        <td class="hidden-xs"><?php echo $patente; ?></td>
                        <td class="hidden-xs"><?php echo $descricao_proc; ?></td>
                        <td>
                            <a href="<?php echo URL; ?>controle-infractor/visualizar/<?php echo $id; ?>"><button type="button" class="btn btn-primary">Ver à Ficha</button></a>

                            <a href="<?php echo URL; ?>controle-infractor/Editar/<?php echo $id; ?>"><button type="button" class="btn btn-warning">Editar</button></a>

                            <a href="<?php echo URL; ?>controle-infractor/apagar/<?php echo $id; ?>"><button type="button" class="btn btn-danger">Apagar</button></a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    endif;
    echo $paginacao;
    ?>
</div>

