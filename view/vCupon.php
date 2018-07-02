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
                    <?php $idemp = $lcupones2;
                    $idrob = $lcupones[$i]["id_revision_objeto"];
                    ?>
                    <td> <?php echo "<a href='../view/Addcupon.php?id_empresa=$idemp&id_revision_objeto=$idrob'><img src='img/agregar.png'/></a>" ?></td>
                    <td> <?php echo "<a href='../view/Contenido.php?id_empresa=$idemp&id_revision_objeto=$idrob'><img src='img/eliminar.jpg'/></a>" ?></td>
                    <td> <?php echo "<a href='../view/Contenido.php?id_empresa=$idemp&id_revision_objeto=$idrob'><img src='img/actualizar.jpg'/></a>" ?></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>