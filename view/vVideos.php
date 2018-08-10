<?php


include '../includes/header2.php';


?>

    <center><h1>Videos</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Titulo</strong></td>
                <td><strong>Descripcion</strong></td>
                <td><strong>Precio</strong></td>
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
                    <td><?php echo $llenar[$i]["titulo"]; ?></td>
                    <td><?php echo $llenar[$i]["descripcion"]; ?></td>
                    <td><?php echo $llenar[$i]["precio"]; ?></td>
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idv = $llenar[$i]["id_video"];
                    $idrob = $llenar[$i]["id_revision_objeto"];
                    $t = $llenar[$i]["titulo"];
                    $dc = $llenar[$i]["descripcion"];
                    $dl = $llenar[$i]["precio"];
                    $img = $llenar[$i]["fecha_subida"];
                    $tyc = $llenar[$i]["id_img_preview"];
                    $limcd = $llenar[$i]["id_video_archivo"];
                    ?>
                    <td> <?php echo '<a href="../Controller/crteVideo.php?id_revision_objeto=' . $idrob . '&id_video=' . $idv . '&id_img_preview=' . $tyc . '&id_video_archivo=' . $limcd . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este video?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td><form method="post" action="../Controller/crtaodaVideo.php">
                            <?php echo "<input type='hidden' id='id_video' name='id_video' value='$idv'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
 <?php


include '../includes/footer.php';


?>

