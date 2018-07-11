<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
    <center><h1>Administracion de los Sitios</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Nombre del sitio</strong></td>
                <td><strong>Direccion del sitio</strong></td>
                <td><strong>Modificar Contenido del Sitio</strong></td>
            </tr>
            <?php
            for ($i = 0; $i < count($pd); $i++) {
                ?>
                <tr>
                    <td><?php echo $pd[$i]["nombre"]; ?></td>
                    <td><?php echo $pd[$i]["direccion"]; ?></td>
                    <?php
                    $nm = $pd[$i]["nombre"];
                    ?>
                    <td> <?php echo "<a href='../view/Contenido.php?name=$nm'><img src='img/actualizar.jpg'/></a>" ?></td>                    
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>