<?php
$_SESSION['Expira'] = time();
if (($_SESSION['Expira'] - $_SESSION['Inicia']) > 10800) {

    header('Location: ../Controller/cerrarSession.php');
}
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>

        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/Validaciones.js"></script>
        <script src="../DataTables/DataTables-1.10.18/js/jquery.dataTables.js"></script>
        <script src="../DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.js"></script>

    </head>


    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0px 0px 24px 0px;">
            <a class="navbar-brand" href="">Administrador</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="../principal.php">
                            HOME
                        </a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Empresas
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/Nuevo_usu_controller.php">Nueva Empresa</a>
                            <a class="dropdown-item" href="../Controller/Emp_Desactivadas_controller.php">Empresas Deshabilitadas</a>
                            <a class="dropdown-item" href="../Controller/Emp_Activas_controller.php">Empresas Activas</a>
                            <?php
                            if ($_SESSION['username'] == 'juan@gmail.com') {
                                printf('<a class="dropdown-item" href="../Controller/insertAuthority.php">Agregar Administrador</a>');
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Validar <span> <?php printf($_SESSION['totalPendientes']); ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/validarEventos_controller.php">Cartelera <span></span></a>
                            <a class="dropdown-item" href="../Controller/validarSitios_controller.php">Sitios <span> <?php printf($_SESSION['nS']); ?></span></a>
                            <a class="dropdown-item" href="../Controller/validarCupon_controller.php">Cupones   <span> <?php printf($_SESSION['nC']); ?></span></a>
                            <a class="dropdown-item" href="../Controller/validarVideo_controller.php">Videos <span> <?php printf($_SESSION['nV']); ?></span></a>
                            <a class="dropdown-item" href="../Controller/validarFlyers_controller.php">Flyers & Banners <span><?php printf($_SESSION['nF']); ?></span></a>
                            <a class="dropdown-item" href="../Controller/validarVacante_controller.php">Bolsa de trabajo <span><?php printf($_SESSION['nF']); ?></span></a>
                            <a class="dropdown-item" href="../Controller/validarEvento_controller.php">Carteleraa <span><?php printf($_SESSION['nF']); ?></span></a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                    <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                </form>
            </div>
        </nav>        


        <!-- comienza codigo -->        
        <div class="row">
            <div class="col-md-12">
                <div class="row" style="min-height: 400px;">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10">
                        <!-- termina codigo -->
