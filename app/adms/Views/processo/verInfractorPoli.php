<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['dados_infractor'][0])) {
    extract($this->Dados['dados_infractor'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
             <a href="<?php echo URLADM; ?>infra-policia/listar" align="right" title="Fechar Pagina">
                <div class="p-2">
                  <span class=" badge badge-danger">
                        X
                    </span>
                </div>
            </a>
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Dados do Infractor</h2>
                </div>
                <div class="p-2">
                   
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list-estudantes']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "infra-policia/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_infractor']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-infractor-poli/edit-infractor-poli/$id'>Editar</a>";
                            }
                          
                            if ($this->Dados['botao']['del_infractor']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-infractor-poli/apagar-infractor-poli/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div><hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
                  
               <a href="<?php echo URLADM; ?>detalhe-poli-pdf/detalhes-poli-pdf/<?php echo $id; ?>" align="right">
                <div class="p-2">
                  <span class=" badge badge-secondary">
                        Ver Ficha Completa em PDF
                    </span>
                </div>
            </a>
                   
            <dl class="row">
                <dt class="col-sm-3">Foto</dt>
                <dd class="col-sm-9">                    
                    <?php
                    if (!empty($imagem)) {
                        echo "<img src='" . URLADM . "assets/imagens/infractor/" . $id . "/" . $imagem . "' witdh='150' height='70'>";
                    } else {
                        echo "<img src='" . URLADM . "assets/imagens/infractor/icone_usuario.png' witdh='150' height='70'>";
                    }
                    ?>
                </dd>
                <dt class="col-sm-3">Nome do Infractor</dt>
                <dd class="col-sm-9"><?php echo $nome_infractor; ?></dd>  

                <dt class="col-sm-3">Processo</dt>
                <dd class="col-sm-9"><?php echo $processo; ?></dd>                

                <dt class="col-sm-3">Data de Nascimento</dt>
                <dd class="col-sm-9"><?php echo $data_nascimento; ?></dd>  

                <dt class="col-sm-3">Sexo</dt>
                <dd class="col-sm-9"><?php echo $sexo; ?></dd> 

                <dt class="col-sm-3">Nip</dt>
                <dd class="col-sm-9"><?php echo $nip; ?></dd>

                <dt class="col-sm-3">Patente</dt>
                <dd class="col-sm-9"><?php echo $patente_policia; ?></dd>

                <dt class="col-sm-3">Unidade</dt>
                <dd class="col-sm-9"><?php echo $unidade_policial; ?></dd>
                
                <dt class="col-sm-3">Crime Militar</dt>
                <dd class="col-sm-9"><?php echo $descricao_crime_militar; ?></dd>

                <dt class="col-sm-3">Crime Comum</dt>
                <dd class="col-sm-9"><?php echo $descricao_crimecomum; ?></dd>

                <dt class="col-sm-3">Situação</dt>
                <dd class="col-sm-9">
                    <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $descricao_proc; ?></span>
                </dd>

            </dl>


        </div>
    </div>
    <?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Infractor não encontrado!</div>";
    $UrlDestino = URLADM . 'infra-policia/listar';
    header("Location: $UrlDestino");
}
