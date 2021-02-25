<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
header("content-type: text/html;charset=utf-8");
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('Africa/Luanda');
?>


<script src="<?php echo URLADM . 'assets/js/jquery-3.3.1.min.js'; ?>"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable({language: {
          sEmptyTable: "Nenhum registro do Infractor Encontrado",
          sProcessing: "A processar...",
          sLengthMenu: "Mostrar _MENU_ registros",
          sZeroRecords: "Não foram encontrados resultados",
          sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          sInfoEmpty: "Mostrando de 0 até 0 de 0 registos",
          sInfoFiltered: "(filtrado de _MAX_ registros no total)",
          sInfoPostFix: "",
          sSearch: "Pesquisar:",
            sUrl: "",
            oPaginate: {
              sFirst: "Primeiro",
              sPrevious: "Anterior",
              sNext: "Seguinte",
              sLast: "Último"
        },
            aria: {
              sSortAscending: ": Ordenar colunas de forma ascendente",
              sSortDescending: ": Ordenar colunas de forma descendente"
            }
        }});
    });
</script>

<style>
    table.dataTable{border-collapse:collapse !important;}

</style>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo"> Infractores</h2>
            </div>
            <!--  <div class="p-2">
                  <span class="d-none d-md-block">
        
                  </span>
                  <div class="dropdown d-block d-md-none">
                      <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Ações
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 

                      </div>
                  </div>
              </div>-->

        </div>
        
       
            <?php
       
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered tabelaPersonalizadaDataTable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="d-none d-lg-table-cell">Processo</th>
                        <th>Nome</th>
                        <th class="d-none d-lg-table-cell">Nº do BI</th>
                        <th class="d-none d-sm-table-cell">Nip</th>
                        <th class="d-none d-lg-table-cell">Patente</th>
                        <th class="d-none d-lg-table-cell">Estado do Processo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont=1;
                    foreach ($this->Dados['listEstudantes'] as $bolseiro) {
                        extract($bolseiro);
                      


                        //var_dump($bolseiro);<i class="fas fa-trash-alt"></i>
                        ?>
                        <tr>
                            <td><?php echo $cont; ?></td>
                            <td><?php echo $processo; ?></td>
                            <td><?php echo $nome_infractor; ?></td>
                            <td><?php echo $numero_bi; ?></td> 
                            <td><?php echo $nip; ?></td>
                            <td><?php echo $patente_policia; ?></td>                        
                            <td><span class="badge badge-<?php echo $cor ?>"><?php echo $descricao_proc; ?></span></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_infractor']) {
                                        echo "<a href='" . URLADM . "ver-infractor-poli/ver-infractor-poli/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_infractor']) {
                                        echo "<a href='" . URLADM . "editar-infractor-poli/edit-infractor-poli/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_infract']) {
                                        echo "<a href='" . URLADM . "apagar-infractor-poli/apagar-infractor-poli/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
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
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-infractor-poli/ver-infractor-poli/$id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_infractor']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-infractor-poli/edit-infractor-poli/$id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_infract']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-infractor-poli/apagar-infractor-poli/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                        }
                                        ?>


                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $cont++;
                    }
                    ?>
                </tbody>
                </table>


        </div>
    </div>
</div>
