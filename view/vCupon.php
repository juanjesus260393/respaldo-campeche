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
                <td><strong>Agregar</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
            <?php
            for ($i = 0; $i < count($lcupones); $i++) {
                ?>
                <tr>
                    <td><?php echo $lcupones[$i]["titulo"]; ?></td>
                    <td><?php echo $lcupones[$i]["vigencia"]; ?></td>
                    <td><?php echo $lcupones[$i]["terminos_y_condiciones"]; ?></td>
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idemp = $lcupones2;
                    $idcup = $lcupones[$i]["id_cupon"];
                    $idrob = $lcupones[$i]["id_revision_objeto"];
                    $t = $lcupones[$i]["titulo"];
                    $dc = $lcupones[$i]["descripcion_corta"];
                    $dl = $lcupones[$i]["descripcion_larga"];
                    $img = $lcupones[$i]["id_imagen_extra"];
                    $tyc = $lcupones[$i]["terminos_y_condiciones"];
                    ?>
                    <td> <?php echo "<a href='../view/Addcupon.php?id_empresa=$idemp'><img src='img/agregar.png'/></a>" ?></td>
                    <td> <?php echo "<a href='../Controller/crteCupon.php?id_empresa=$idemp&id_revision_objeto=$idrob&id_cupon=$idcup&id_imagen_extra=$img'><img src='img/eliminar.jpg'/></a>" ?></td>
                    <td> <?php echo "<a href='../view/actualizarCupon.php?id_empresa=$idemp&id_revision_objeto=$idrob&id_cupon=$idcup&titulo=$t&descripcion_corta=$dc&descripcion_larga=$dl&terminos_y_condiciones=$tyc'><img src='img/actualizar.jpg'/></a>" ?></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>