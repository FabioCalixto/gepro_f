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
                <h2 class="display-4 titulo">Auditoria</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->Dados['botao']['fechar_audit']) {
                        echo "<a href='" . URLADM . "home/index' class='btn btn-outline-danger btn-sm'>Fehar</a> ";
                    }
               
                    ?>
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                        <?php
                        if ($this->Dados['botao']['fechar_audit']) {
                            echo "<a class='dropdown-item' href='" . URLADM . "home/home'>Fechar</a>";
                        }
                    
                        ?>
                    </div>
                </div>
            </div>
        </div>
      <hr>
        <?php
        if (empty($this->Dados['listAudit'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum Registro encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Acção Feita</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">NºProcesso</th>
                        <th class="d-none d-lg-table-cell">Nip</th>
                         <th class="d-none d-lg-table-cell">Autor da Acção</th>
                        <th class="text-center">Data da Acção</th>
                    </tr>
                </thead>
               <tbody>
                    <?php
                    foreach ($this->Dados['listAudit'] as $audit) {
                        extract($audit);
                        ?>
                        <tr>
                            <th> <span class="badge badge-<?php echo $cor; ?>"><?php echo $nome; ?></span></th>
                            <td><?php echo $aud_nome_infractor; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $processo; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $aud_nip; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $aud_usuario; ?></td>
                            <td><?php echo $created; ?></td>

                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            
            </table>
            <?php
            echo $this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>
<script src="<?php echo URLADM . 'assets/js/dashboard.js'; ?>"></script>

