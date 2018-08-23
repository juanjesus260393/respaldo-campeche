<?php
session_start();
require_once('../scripts/Validaciones.php');
$na = new validacion();
$idro = $na->registros_cupon();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>

        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>


    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0px 0px 24px 0px;">
            <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="../Controller/IniciodeSesion.php" >
                            HOME
                        </a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Sitios
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/ControladorSitios.php">Ver Sitios</a>
                            <a class="dropdown-item" href="../Controller/add_Sitios_controller.php">Agregar Sitios</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="../Controller/crtCupones.php" id="navbardrop" data-toggle="dropdown">
                            Cupones
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/crtCupones.php">Cupones  </a>
                            <a class="dropdown-item" href="../view/Addcupon.php">Agregar Cupon</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="../Controller/crtcVideos.php" id="navbardrop" data-toggle="dropdown">
                            Videos
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/crtcVideos.php">Videos  </a>
                            <a class="dropdown-item" href="../view/Addvideo.php">Agregar Cupon</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="../Controller/crtcFlyers.php" id="navbardrop" data-toggle="dropdown">
                            Flyers & Banners
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/crtcFlyers.php">Flyers & Banners  </a>
                            <a class="dropdown-item" href="../view/Addflyerybanner.php">Agregar Flyers & Banners</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Graficas
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Controller/crtEstadisticacupones.php">Estadisticas Cupones </a>
                            <a class="dropdown-item" href="#">  </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="../Controller/cambiaPass_controller.php" id="navbardrop" data-toggle="dropdown">
                            Cambia Contraseña
                        </a>       
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                    <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                </form>
            </div>
        </nav>
        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    <center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>  
    <center><h1>Agregar Cupon</h1></center>
    <center><form method="post" action="../Controller/crtAdcupon.php" name="form1" enctype="multipart/form-data">
            <div>
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
            </div>
            <div>
                <span><label>*Titulo del Cupon:</label></span>
                <span><input type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" maxlength="99" required></span>
            </div>
            <div>
                <span><label>*Descripcion Corta:</label></span>
                <span><input type="text" id="descripcion_corta" name="descripcion_corta" placeholder="Descripcion Corta"  maxlength="149" required></span>
            </div>   
            <div>
                <span><label>*Descripcion Larga:</label></span>
                <span><textarea  id="descripcion_larga" name="descripcion_larga" rows="10" cols="40" placeholder="Descripcion Larga" maxlength="490" required></textarea></span>
            </div>
            <div>
                <span><label>*Imagen Vista Previa:</label></span>
                <span><input type="file"  id="id_imagen_vista_previa" onchange= "ValidarImagenc(this)" accept=".jpg" name="id_imagen_vista_previa" required></span>
            </div>
            <div>
                <span><label>Imagen Del Cupon:</label></span>
                <span><input type="file" id="id_imagen_extra" onchange= "ValidarImagenvp(this)" accept=".jpg" name="id_imagen_extra"></span>
            </div>
            <div>
                <span><label>*Vigencia inicio:</label></span>
                <span><input type="date" id="vigencia_inicio"  name="vigencia_inicio" value="<?php echo date('Y-m-d'); ?>"></span>    </div>
            <div>
                <span><label>*Vigencia fin:</label></span>
                <span><input type="date" id="vigencia_fin" name="vigencia_fin" value="<?php echo date('Y-m-d'); ?>"></span>
            </div>
            <div>
                <span><label>*Terminos y Condiciones:</label></span>
                <span><textarea id="terminos_y_condiciones" name="terminos_y_condiciones" rows="10" cols="40" placeholder="Terminos y condiciones" maxlength="240" required></textarea></span>
            </div>
            <div>
                <span><label>*Limite de cupones:</label></span>
                <span><input type="number" id="limite_codigos" name="limite_codigos" rows="10" cols="40" placeholder="Cantidad de cupones" maxlength="2" required></span>
            </div>
            <div>

                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres registrar este cupon?')) {
                            return false;
                        }" value="Registrar Cupon" ></span>

            </div>
        </form></center>
</body>
</html>