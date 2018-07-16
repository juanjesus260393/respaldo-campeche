<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
    <center><h1>Paquetes</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Nombre del pquete</strong></td>
                <td><strong>Descripcion</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
            <?php
            $lpaquetes;
            $llenar;
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($lpaquetes);
            if ($lpaquetes == null) {
                $llenar = [0];
            } else {
                $llenar = $lpaquetes;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr>
                    <td><?php echo $llenar[$i]["nombre"]; ?></td>
                    <td><?php echo $llenar[$i]["descripcion"]; ?></td>
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $ip = $llenar[$i]["id_paquete"];
                    $nm = $llenar[$i]["nombre"];
                    $dc = $llenar[$i]["descripcion"];
                    $st = $llenar[$i]["status"];
                    ?>
                    <td> <?php echo '<a href="../Controller/crtEpaquete.php?id_paquete=' . $ip . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este video?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td> <?php echo "<a href='../Controller/crtbpPaquete.php?id_paquete=$ip'><img src='img/actualizar.jpg'/></a>" ?></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>