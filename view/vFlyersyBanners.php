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
        <?phprequire_once '../view/modals.php'; ?>
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
                                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalFlyer">Que es un Flyer???</button>
                                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalBanner">Que es un Banner???</button>
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
                                 <a class="nav-link" href="../Controller/cambiaPass_controller.php" >
                                                    Cambia Contraseña
                                                </a>       
                             </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                            <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </nav>
        
    <center><h1>Flyers y Banners</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Imagen</strong></td>
                <td><strong>Estado del Publicidad</strong></td>
                <td><strong>Tipo de publicidad</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
            <?php
            $lflyerybanners;
            $llenar;
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($lflyerybanners);
            if ($lflyerybanners == null) {
                $llenar = [0];
            } else {
                $llenar = $lflyerybanners;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr>
                    
                    <td><?php $ext = '.jpg'; echo ('<img src="../Imagenes/Publicidad/' . $lflyerybanners[$i]["id_img"] . '.jpg" width="152" height="118">'); ?></td>
                    <td><?php
                        switch ($lflyerybanners[$i]["status"]) {
                            case 'C':
                                echo 'En revision';
                                break;
                            case 'A':
                                echo 'Aprovado';
                                break;
                            case 'R':
                                echo 'Rechazado';
                                break;
                        }
                        ?></td>
                    <td><?php
                        switch ($lflyerybanners[$i]["tipo"]) {
                            case 'F':
                                echo 'Flyer';
                                break;
                            case 'B':
                                echo 'Banner';
                                break;
                        }
                        ?></td>
                        <?php
                        //Lista de parametros por medio de los cuales se actualizara el cupon
                        $idpub = $lflyerybanners[$i]["id_ad"];
                        $idrob = $lflyerybanners[$i]["id_revision_objeto"];
                        $img = $lflyerybanners[$i]["id_img"];
                        ?>
                    <td> <?php echo '<a href="../Controller/crtePublicidad.php?id_revision_objeto=' . $idrob . '&id_ad=' . $idpub . '&id_img=' . $img . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar esta publicidad?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td><form method="post" action="../Controller/crtsPublicidad.php">
                            <?php echo "<input type='hidden' id='id_ad' name='id_ad' value='$idpub'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>
