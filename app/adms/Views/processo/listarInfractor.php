<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Mapa Geral de Infractores</h2>
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

    $paginacao = $this->Dados[1];
    $this->Dados = $this->Dados[0];
    ?>
        <div class="float-right">
         <a href="<?php echo URL; ?>controle-infractor/cadastrarInfractor"><button type="button" class="btn btn-outline-success btn-sm ">Registar</button></a>
        </div>
    <?php
    if (!empty($this->Dados)):
        ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                  
                    <th>Nº Processo</th>
                    <th>Nome do Infractor</th>
                    <th class="hidden-xs">Patente</th>
                    <th class="hidden-xs">Estado do Processo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados as $infra) {
                    extract($infra);
                    ?>               
                    <tr>
                        
                        <td><?php echo $processo; ?></td>
                        <td><?php echo $nome_infractor; ?></td>
                        <td class="hidden-xs"><?php echo $patente; ?></td>
                        <td class="hidden-xs"><?php echo utf8_encode($descricao_proc); ?></td>
                          <td class="text-center">
                                    <span class="d-none d-md-block">
                                        <a href="<?php echo URL; ?>controle-infractor/visualizar/<?php echo $id; ?>" class="btn btn-outline-primary btn-sm">Ver Ficha doInfractor</a>
                                        <a href="<?php echo URL; ?>controle-infractor/editar/<?php echo $id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                         
                                    </span>
                                    <div class="dropdown d-block d-md-none">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ações
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                            <a class="dropdown-item" href="<?php echo URL; ?>controle-infractor/visualizar/<?php echo $id; ?>">Ver Ficha do Infractor</a>
                                            <a class="dropdown-item" href="<?php echo URL; ?>controle-infractor/editar/<?php echo $id; ?>">Editar</a>
                                         
                                        </div>
                                    </div>
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
    </div>



