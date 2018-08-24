<?php


include '../includes/header2.php';


?>
    <center><h1>Sitios Agregados</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Nombre del sitio</strong></td>
                <td><strong>Direccion del sitio</strong></td>
            </tr>
            <?php
            require_once '../scripts/Validaciones.php';
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($pd);
            for ($i = 0; $i < count($pd); $i++) {
                ?>
                <tr>
                    <td><?php echo $pd[$i]["nombre"]; ?></td>
                    <td><?php echo $pd[$i]["direccion"]; ?></td>   
                </tr>
                <?php
            }
            ?>
        </table></center>
<?php


include '../includes/footer.php';


?>
