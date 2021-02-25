<meta charset="utf-8">
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Processo</h2>
            </div>

            <a href="<?php echo URLADM; ?>controle-home/index">
                <div class="p-2">
                    <button class="btn btn-outline-danger btn-sm">
                        Fechar
                    </button>
                </div>
            </a>


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

        if (isset($this->Dados[0])):
            $SituacaoProcesso = $this->Dados[0];
        //var_dump($situacaoUsers);
        endif;
        if (isset($this->Dados[1])):
            $AnoInstrucao = $this->Dados[1];
        //var_dump($situacaoUsers);
        endif;

        if (isset($this->Dados[2])):
            $valorForm = $this->Dados[2];
        //var_dump($valorForm);
        endif;
        ?>
        <hr>
        <form name="CadProcesso" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label><span class="text-danger">*</span>Processo</label>
                    <input type="text"  class="form-control" name="processo" maxlength="8"  placeholder="Escreva o Processo" value="<?php
                    if (isset($valorForm['processo'])): echo $valorForm['processo'];
                    endif;
                    ?>">
                </div>

                <div class="form-group col-md-3.5">
                    <label><span class="text-danger">*</span>Situação do Processo</label>
                    <select class="form-control" name="situacaoprocesso_id">
                        <option value="">Selecione á Situação do Processo</option>
                        <?php
                        foreach ($SituacaoProcesso as $situacaoProcesso):
                            extract($situacaoProcesso);
                            if ($valorForm['situacaoprocesso_id'] == $id):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$id' $selecionado>$descricao_proc</option>";
                        endforeach;
                        ?>
                    </select> 
                </div>

                <div class="form-group col-md-2.1">
                    <label><span class="text-danger">*</span> Data de Entrada</label>
                    <input type="date" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$"  class="form-control" name="data_entrada" placeholder="" value="<?php
                    if (isset($valorForm['data_entrada'])): echo $valorForm['data_entrada'];
                    endif;
                    ?>">
                </div>

                <div class="form-group col-md-1.9">
                    <label><span class="text-danger">*</span> Ano de Instrução</label>
                    <select class="form-control" name="anoinstrucao_id">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($AnoInstrucao as $ano):
                            extract($ano);
                            if ($valorForm['anoinstrucao_id'] == $id):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$id' $selecionado>$ano</option>";
                        endforeach;
                        ?>
                    </select> 
                </div>

            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> Nome do Instrutor do Processo</label>
                    <input type="text"  class="form-control" name="instrutor" maxlength="50"  placeholder="Escreva o Nome do Instrutor do Processo" value="<?php
                    if (isset($valorForm['instrutor'])): echo $valorForm['instrutor'];
                    endif;
                    ?>">
                </div>

            </div>


            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

            <p>
                <span class="text-danger">* </span>Precisa Preencher Todos os Campos  
            </p>
            <button type="submit" class="btn btn-success" value="Guardar" name="SendCadProcesso">Guardar</button>
        </form>
    </div>
</div>
