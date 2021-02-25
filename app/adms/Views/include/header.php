<meta charset="utf-8">
<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
date_default_timezone_set('Africa/Luanda');
$date = date('Y-m-d H:i');
?>

<nav class="navbar navbar-expand navbar-dark " style="background:linear-gradient(rgba(4,15,43,0.9), rgba(15,20,31,0.7)); ">
    <a class="sidebar-toggle text-light mr-3">
        <span class="navbar-toggler-icon"></span>
    </a>
         <img class="rounded-circle" src="<?php echo URLADM;?>imagens/logofaa.png" width="40" height="40">&nbsp;
    <a class="navbar-brand" href="#">SIIPROC - Sistema de Informação Integrado de Processos-Crime / PJMFAA</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                   <?php if (isset($_SESSION['usuario_imagem']) AND ( !empty($_SESSION['usuario_imagem']))) { ?>
                        <img class="rounded-circle" src="<?php echo URLADM . 'assets/imagens/usuario/' . $_SESSION['usuario_id'] . '/' . $_SESSION['usuario_imagem']; ?>" width="20" height="20"> &nbsp;<span class="d-none d-sm-inline">
                        <?php } else { ?>
                            <img class="rounded-circle" src="<?php echo URLADM . 'assets/imagens/usuario/icone_usuario.png'; ?>" width="20" height="20"> &nbsp;<span class="d-none d-sm-inline">
                                <?php
                            }
                            $nome = explode(" ", $_SESSION['usuario_nome']);
                            $prim_nome = $nome[0];
                            echo $prim_nome;
                            ?></span><br>

                           <span class="d-none d-sm-inline">
                           	<b> <?php echo $_SESSION['adms_niveis_acesso_nome'];  
                           	?></b>
                           </span><br>

                            <strong>Data: </strong><?php echo $date; ?>
                </a>
                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo URLADM . 'ver-perfil/perfil'; ?>"><i class="fas fa-user"></i> Perfil</a>
                    <a class="dropdown-item" href="<?php echo URLADM . 'login/logout'; ?>"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </li>
        </ul>                
    </div>
</nav>

