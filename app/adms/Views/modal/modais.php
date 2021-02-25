<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>


 <div class="modal fade" id="reportNip" tabindex="-1" role="dialog" aria-labelledby="reportNipLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-info text-white text-center">

                    <h5 class="modal-title" id="exampleModalLabel">  
                        <img class="rounded-circle" src="<?php echo URL; ?>imagem/logofaa.png" width="40" height="40">&nbsp;Relatório de Infractor /NIP</h5>



                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="CadInfractor" action="<?php echo URL; ?>relatorios/reporInfracNip.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Nip</label>
                                <input name="nip" type="text" class="form-control" id="nome" placeholder="Nip" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Emitit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <div class="modal fade" id="reportProcesso" tabindex="-1" role="dialog" aria-labelledby="reportProcessoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-info text-white text-center">

                    <h5 class="modal-title" id="exampleModalLabel">  
                        <img class="rounded-circle" src="<?php echo URL; ?>imagem/logofaa.png" width="40" height="40">&nbsp;Relatório de Infractor /Processo</h5>



                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="CadInfractor" action="<?php echo URL; ?>relatorios/reportInfraProcesso.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Nº do Processo</label>
                                <select class="form-control" name="n_processo">
                                    <option value="">Selecione</option>
                                    <?php
                                    $vis = new ModelsRead();
                                    $vis->ExeRead('tb_processo');
                                    foreach ($vis->getResultado() as $processos):
                                        extract($processos);
                                        $idP = $processos['id'];
                                        $proc = $processos['processo'];
                                        if ($valorForm['numero_processo'] == $id):
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Emitit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>





    <div class="modal fade" id="reportUnidade" tabindex="-1" role="dialog" aria-labelledby="reportUnidadeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-info text-white text-center">

                    <h5 class="modal-title" id="exampleModalLabel">  
                        <img class="rounded-circle" src="<?php echo URL; ?>imagem/logofaa.png" width="40" height="40">&nbsp;Relatório de Infractor /Unidade</h5>



                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="CadInfractor" action="<?php echo URL; ?>relatorios/reportInfraUnidade.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Unidade</label>
                                <select class="form-control" name="cod_Unidade">
                                    <option value="">Selecione</option>
                                    <?php
                                    $vis = new ModelsRead();
                                    $vis->ExeRead('tb_u_e_o');

                                    foreach ($vis->getResultado() as $unidades):
                                        extract($unidades);
                                        $idU = $unidades['id'];
                                        $unit = $unidades['designacao_Unidade'];

                                        if ($valorForm['cod_Unidade'] == $id):
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Emitit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>







    <div class="modal fade" id="reportPatente" tabindex="-1" role="dialog" aria-labelledby="reportPatenteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-info text-white text-center">

                    <h5 class="modal-title" id="exampleModalLabel">  
                        <img class="rounded-circle" src="<?php echo URL; ?>imagem/logofaa.png" width="40" height="40">&nbsp;Relatório de Infractor /Patente</h5>



                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="CadInfractor" action="<?php echo URL; ?>relatorios/reportInfraPatente.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Patente</label>
                                <select class="form-control" name="cod_patente">
                                    <option value="">Selecione</option>
                                    <?php
                                    $vis = new ModelsRead();
                                    $vis->ExeRead('tb_patente');

                                    foreach ($vis->getResultado() as $patentes):
                                        extract($patentes);
                                        $idP = $patentes['id'];
                                        $pat = $patentes['patente'];
                                        if ($valorForm['cod_patente'] == $id):
                                            $selecionado = "selected";
                                        else:
                                            $selecionado = "";
                                        endif;
                                        echo "<option value='$idP' $selecionado>$pat</option>";
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Emitit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
        <?php
        ?>
    </body>
</html>
