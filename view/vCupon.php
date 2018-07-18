<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
    <body>
         <nav class = "navbar navbar-expand-lg navbar-dark bg-dark" style = "margin:24px 0;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']);?></a>
            <button class = "navbar-toggler navbar-toggler-right" type = "button" data-toggle = "collapse" data-target = "#navb">
            <span class = "navbar-toggler-icon"></span>
            </button>
            <div class = "collapse navbar-collapse" id = "navb">
            <ul class = "navbar-nav mr-auto">
            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/IniciodeSesion.php">Principal</a>
            </li>

            <li class = "nav-item">
                <a class = "nav-link" href = "../view/Addcupon.php">Agregar Cupon</a>
            </li>
            
            </ul>
              <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                  <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
              </form>
          </div>
      </nav>
    <center><h1>Cupones</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Titulo</strong></td>
                <td><strong>Vigencia</strong></td>
                <td><strong>Terminos y Condiciones</strong></td>
                <td><strong>Status</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
            <?php
            $lcupones;
            $llenar;
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($lcupones);
            if ($lcupones == null) {
                $llenar = [0];
            } else {
                $llenar = $lcupones;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr>
                    <td><?php echo $lcupones[$i]["titulo"]; ?></td>
                    <td><?php echo $lcupones[$i]["vigencia_inicio"]; ?></td>
                    <td><?php echo $lcupones[$i]["terminos_y_condiciones"]; ?></td>
                    <td><?php 
                            switch ($lcupones[$i]["status"]){
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
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idcup = $lcupones[$i]["id_cupon"];
                    $idrob = $lcupones[$i]["id_revision_objeto"];
                    $img = $lcupones[$i]["id_imagen_extra"];
                    $img2 = $lcupones[$i]["id_imagen_vista_previa"];
                    ?>
                    <td> <?php echo '<a href="../Controller/crteCupon.php?id_revision_objeto=' . $idrob . '&id_cupon=' . $idcup . '&id_imagen_extra=' . $img . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este cupon?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td><form method="post" action="../Controller/crtsCupon.php">
                            <?php echo "<input type='hidden' id='id_cupon' name='id_cupon' value='$idcup'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>
