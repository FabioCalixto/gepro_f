<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>

<script type="text/javascript">

function letras(){
  tecla = event.keyCode;
  if (tecla >= 48 && tecla <= 57){
      return false;
  }else{
     return true;
  }
}

</script>


  <script language='JavaScript'>
 function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
      if (tecla==8 || tecla==0) return true;
  else  return false;
   }
}

</script>


<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Ano de Instrução</h2>
            </div>
            <?php /*
            if ($this->Dados['botao']['list_unidade']) {
                ?>
                <div class="p-2">
             <!--       <a href="<?php echo URLADM . 'cor/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a> -->
                </div>
                <?php
            }*/
            ?>


        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data"> 

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label><span class="text-danger">*</span> Ano</label>
                    <input name="ano" type="text" maxlength="4" onkeypress='return SomenteNumero(event)' class="form-control" placeholder="Escreva o Ano" value="<?php
                    if (isset($valorForm['nome'])) {
                        echo $valorForm['nome'];
                    }
                    ?>">
                </div>
             
            </div>

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="SendCadUnidade" type="submit" class="btn btn-warning" value="Guardar">
        </form>
    </div>
</div>
