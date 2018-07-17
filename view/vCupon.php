<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
    <center><h1>Cupones</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Titulo</strong></td>
                <td><strong>Vigencia</strong></td>
                <td><strong>Terminos y Condiciones</strong></td>
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
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idcup = $lcupones[$i]["id_cupon"];
                    $idrob = $lcupones[$i]["id_revision_objeto"];
                    $img = $lcupones[$i]["id_imagen_extra"];
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