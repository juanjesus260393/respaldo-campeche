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
                    $t = $lcupones[$i]["titulo"];
                    $dc = $lcupones[$i]["descripcion_corta"];
                    $dl = $lcupones[$i]["descripcion_larga"];
                    $img = $lcupones[$i]["id_imagen_extra"];
                    $tyc = $lcupones[$i]["terminos_y_condiciones"];
                    $limcd = $lcupones[$i]["limite_codigos"];
                    ?>
                    <td> <?php echo '<a href="../Controller/crteCupon.php?id_revision_objeto=' . $idrob . '&id_cupon=' . $idcup . '&id_imagen_extra=' . $img . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este cupon?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td> <?php echo "<a href='../view/actualizarCupon.php?id_revision_objeto=$idrob&id_cupon=$idcup&titulo=$t&descripcion_corta=$dc&descripcion_larga=$dl&id_imagen_extra=$img&terminos_y_condiciones=$tyc&limite_codigos=$limcd'><img src='img/actualizar.jpg'/></a>" ?></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>