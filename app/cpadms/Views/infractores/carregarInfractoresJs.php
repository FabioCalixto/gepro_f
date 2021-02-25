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
                <h2 class="display-4 titulo"> Infractores</h2>
            </div>
        </div>

         <form class="form-inline" method="POST" action="">
            <div class="form-group col-md-4">
                <label></label>
                <input name="pesqInfractor" type="text" id="pesqInfractor" class="form-control mx-sm-3" placeholder="Nome, Nip ou Processo">
            </div>
                
        </form><br>
     
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <span id="conteudo"></span>
    </div>
</div>