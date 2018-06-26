<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Proyecto Campeche 360</title>
</head>
<body>
   <center><h1>Sitios Disponibles</h1></center> 
    <center><table border="1">
        <tr>
            <td><strong>Nombre del sitio</strong></td>
            <td><strong>Modificar Sitio</strong></td>
            <td><strong>Eliminar Sitio</strong></td>
        </tr>
        <?php
            for($i=0;$i<count($pd);$i++)
            {
                ?>
                    <tr>
                        <td><?php echo $pd[$i]["nombre"]; ?></td>
                        <td><a href="index.php"> <img src="img/actualizar.jpg"/> </a></td>
                         <td><a href="index.php"> <img src="img/eliminar.jpg"/> </a></td>
                    </tr>
                <?php
            }
        ?>
    </table></center>
</body>
</html>