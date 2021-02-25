<html>

    <script src="<?php echo URLADM . 'assets/js/slim.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/popper.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/dashboard.js'; ?>"></script>
    <script src="<?php echo URLADM . 'assets/js/jquery-3.2.1.min.js'; ?>"></script>


    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Relatórios de Infratores</h2>
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

            ?>
            <hr>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> </a>
                </li>               
            </ul>

            <div class="tab-content" id="myTabContent">
               
              <!-- R.PARAMETROS -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="mr-auto p-2">
                        <h2 class="display-4 titulo"></h2>
                    </div>



                    <form name="CadProcesso" action="" method="post" enctype="multipart/form-data" >



                        <div class="form-row">
                            <div class="form-group col-md-3.1">

                                <select class="form-control" name="tipo_lista" id="infra_param">
                                    <option value="">Selecione o Relatório</option>
                                    <option value="1">Geral </option>
                                    <option value="2">Por Processo</option>
                                    <option value="3">Por Crime Militar</option>
                                    <option value="4">Por Crime Comum</option>
                                    <option value="5">Por Sexo</option>
                                   <!-- <option value="6">Por Patente</option>-->
                                    <option value="7">Por Unidade</option>
                                    <option value="8">Por Ramo</option>

                                </select> 
                            </div>

                        </div>

                          <div class="form-row"  id="sexo" style="display: none;">
                            <div class="form-group col-md-1.5">
                                <label><span class="text-danger">*</span> Sexo</label>
                                <select class="form-control" name="n_sexo">
                                    <option value="">Selecione o Sexo</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
                                    $vis->ExeRead('tb_sexo');
                                    foreach ($vis->getResultado() as $processos):
                                        extract($processos);
                                        $idP = $processos['id'];
                                        $proc = $processos['sexo'];
                                        if ($valorForm['cod_sexo'] == $id):
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


                        <div class="form-row"  id="processo" style="display: none;">
                            <div class="form-group col-md-1.1">
                                <label><span class="text-danger">*</span> Processo</label>
                                <select class="form-control" name="n_processo">
                                    <option value="">Selecione</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
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




                         <!--   <div class="form-row" id="patente" style="display:none;">



                            <div class="form-group col-md-3.1">

                            <label><span class="text-danger">*</span> Patente:</label>
                                <select class="form-control" name="cod_patente">
                                    <option value="">Selecione o Grau Militar</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
                                    $vis->ExeRead('tb_patente');

                                    foreach ($vis->getResultado() as $patentes):
                                        extract($patentes);
                                        $idP = $patentes['cod_patente'];
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
                        </div>-->


                        <div class="form-row" id="unidade" style="display:none;">
                            <div class="form-group col-md-4.2">
                                <label><span class="text-danger">*</span> Unidade Militar:</label>
                                <select class="form-control" name="cod_Unidade">
                                    <option value="">Selecione a Unidade Militar</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
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


            <div class="form-row" id="crimes_militares" style="display:none;">
                            <div class="form-group col-md-3.1">
                                <label><span class="text-danger">*</span> Crime Militar:</label>
                                <select class="form-control" name="id_crime_militar">
                                    <option value="">Selecione o Crime Militar</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
                                    $vis->ExeRead('adms_crime_militar');

                                    foreach ($vis->getResultado() as $crime_militar):
                                        extract($unidades);
                                        $idU = $crime_militar['id'];
                                        $unit = $crime_militar['descricao_crime_militar'];

                                        if ($valorForm['id_crime_militar'] == $id):
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



           <div class="form-row" id="crimes_comuns" style="display:none;">
                            <div class="form-group col-md-3.1">
                                <label><span class="text-danger">*</span> Crime Comum:</label>
                                <select class="form-control" name="id_crime_comum">
                                    <option value="">Selecione o Crime Comum</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
                                    $vis->ExeRead('adms_crime_comum');

                                    foreach ($vis->getResultado() as $crimes):
                                        extract($unidades);
                                        $idU = $crimes['id'];
                                        $unit = $crimes['descricao_crimecomum'];

                                        if ($valorForm['id_crime_comum'] == $id):
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

                        <div class="form-row" id="ramo" style="display:none;">
                            <div class="form-group col-md-2.5">
                                <label><span class="text-danger">*</span> Ramo Militar:</label>
                                <select class="form-control" name="cod_ramo">
                                    <option value="">Selecione o Ramo Militar</option>
                                    <?php
                                    $vis = new \App\adms\Models\helper\AdmsRead();
                                    $vis->ExeRead('tb_ramo');

                                    foreach ($vis->getResultado() as $crimes):
                                        extract($unidades);
                                        $cod_ramoU = $crimes['cod_ramo'];
                                        $unit = $crimes['descricao_ramo'];

                                        if ($valorForm['cod_ramo'] == $cod_ramo):
                                            $selecionado = "selected";
                                        else:

                                            $selecionado = "";
                                        endif;
                                        echo "<option value='$cod_ramoU' $selecionado>$unit</option>";
                                    endforeach;
                                    ?>
                                </select> 
                            </div>

                        </div>


                        <div class="form-row"  id="ano" style="display: none;">
                            <div class="form-group col-md-2"  >
                                <label><span class="text-danger">*</span> Ano</label>
                                <input type="date"  class="form-control" name="ano"  maxlength="9"     placeholder="Digite o Nip" value="">
                            </div>



                            <div class="form-group "  >
                                <label> Por Intervalos</label>
                                <input type="checkbox"  name="intervalo"  onchange="mudar(this);"   >
                            </div>


                        </div>

                        <div class="form-row" style="display: none;" id="ano2">
                            <div class="form-group col-md-2"  >
                                <label><span class="text-danger">*</span> Ano2</label>
                                <input type="date"  class="form-control" name="ano2">
                            </div>

                        </div>

                        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>" >

                        <p>
                            <span class="text-danger">* </span>Precisa Selecionar um Campo
                        </p>
                        <button type="submit" class="btn btn-success" value="Guardar" name="SendRepFicha">Emitir</button>


                        <input type="text" id="angola" hidden >


                    </form>


                </div>
               
               
                    

        </div>
    </div>

    <script type="text/javascript">

        $('#infra_param').change(function () {
            var valor = $(this).val();

            if (valor == 1) {
//alert(valor);
                $('#ano').show();
            } else {
                $('#ano').hide();

                $('#ano2').hide();
            }


            if (valor == 2) {
//alert(valor);
                $('#processo').show();
            } else {
                $('#processo').hide();
            }

            if (valor == 3) {
//alert(valor);
                $('#crimes_militares').show();
            } else {
                $('#crimes_militares').hide();
            }

            if (valor == 4) {
//alert(valor);
                $('#crimes_comuns').show();
            } else {
                $('#crimes_comuns').hide();
            }

            if (valor == 5) {
//alert(valor);
                $('#sexo').show();
            } else {
                $('#sexo').hide();
            }
            if (valor == 6) {
//alert(valor);
                $('#patente').show();
            } else {
                $('#patente').hide();
            }

            if (valor == 7) {
//alert(valor);
                $('#unidade').show();
            } else {
                $('#unidade').hide();
            }

            if (valor == 8) {
//alert(valor);
                $('#ramo').show();
            } else {
                $('#ramo').hide();
            }



        });

        function mudar(obj) {
            var selecionado = obj.checked;
            if (selecionado) {
                $('#ano2').show();

            } else {
                $('#ano2').hide();

            }
        }

    </script>

</html>
