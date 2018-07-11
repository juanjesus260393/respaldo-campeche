<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
    <center><h1>Videos</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Titulo</strong></td>
                <td><strong>Descripcion</strong></td>
                <td><strong>Estado</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
            <?php
            $lvideos;
            $llenar;
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($lvideos);
            if ($lvideos == null) {
                $llenar = [0];
            } else {
                $llenar = $lvideos;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr>
                    <td><?php echo  $llenar[$i]["titulo"]; ?></td>
                    <td><?php echo  $llenar[$i]["descripcion"]; ?></td>
                    <td><?php echo  $llenar[$i]["status"]; ?></td>
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idcup =  $llenar[$i]["id_video"];
                    $idrob =  $llenar[$i]["id_revision_objeto"];
                    $t =  $llenar[$i]["titulo"];
                    $dc =  $llenar[$i]["descripcion"];
                    $dl =  $llenar[$i]["precio"];
                    $img =  $llenar[$i]["fecha_subida"];
                    $tyc =  $llenar[$i]["id_img_preview"];
                    $limcd =  $llenar[$i]["id_video_archivo"];
                    $est =  $llenar[$i]["status"];
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