<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
echo $this->Dados['paginacao'];
if (empty($this->Dados['listInfra'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        Nenhum Registro  encontrado!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php

}
?>
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="d-none d-lg-table-cell">#</th>
                <th class="d-none d-lg-table-cell">Processo</th>
                <th>Nome</th>
                <th>Nº do BI</th>
                <th class="d-none d-lg-table-cell">Nip</th>
                <th class="d-none d-sm-table-cell">Patente</th>
                <th class="d-none d-lg-table-cell">Estado do Processo</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach ($this->Dados['listInfra'] as $infrator) {
                extract($infrator);
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $processo; ?></td>
                    <td><?php echo $nome_infractor; ?></td>
                     <td><?php echo $numero_bi; ?></td>
                    <td class="d-none d-lg-table-cell">
                        <span class="badge badge-<?php ?>"><?php echo $nip; ?></span>
                    </td>
                    <td><?php   
                             if($cod_ramo <= 3 || $cod_ramo == 5):
                                 echo $patente;
                             else:
                                 echo $patente_mga;
                                 endif; ?></td>
                    <td class="d-none d-sm-table-cell"><?php echo $descricao_proc; ?></td>
                    
                    <td class="text-center">
                        <span class="d-none d-md-block">
                            <?php
                            if ($this->Dados['botao']['vis_infractor']) {
                                echo "<a href='" . URLADM . "ver-infractor/ver-infractor/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                            }
                            if ($this->Dados['botao']['edit_infractor']) {
                                echo "<a href='" . URLADM . "editar-infractor/edit-infractor/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                            }
                            if ($this->Dados['botao']['del_infract']) {
                                echo "<a href='" . URLADM . "apagar-infractor/apagar-infractor/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                            }
                            ?>
                        </span>
                        <div class="dropdown d-block d-md-none">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                <?php
                                if ($this->Dados['botao']['vis_infractor']) {
                                    echo "<a class='dropdown-item' href='" . URLADM . "ver-infractor/ver-infractor/$id'>Visualizar</a>";
                                }
                                if ($this->Dados['botao']['edit_infractor']) {
                                    echo "<a class='dropdown-item' href='" . URLADM . "editar-infractor/edit-infractor/$id'>Editar</a>";
                                }
                                if ($this->Dados['botao']['del_infract']) {
                                    echo "<a class='dropdown-item' href='" . URLADM . "apagar-infractor/apagar-infractor/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php

    echo $this->Dados['paginacao'];
    ?>
</div>
