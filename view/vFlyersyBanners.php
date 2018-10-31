<?php
include '../includes/header2.php';
?>

<center><h1>Flyers y Banners</h1></center> 
<center><table class="table text-center" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>

        <thead class="thead-dark" align='center'>
            <tr>
                <th scope="col"><strong>Imagen</strong></th>
                <th scope="col"><strong>Estado del Publicidad</strong></th>
                <th scope="col"><strong>Tipo de publicidad</strong></th>
                <th scope="col"><strong>Eliminar</strong></th>
                <th scope="col"><strong>Actualizar</strong></th>
            </tr>
        </thead>
        <tbody>
<?php
$lflyerybanners;
$llenar;
$validacion = new validacion();
$aux = $validacion->campo_vacio($lflyerybanners);
if ($lflyerybanners == null) {
    $llenar = [0];
} else {
    $llenar = $lflyerybanners;
}
for ($i = 0; $i < count($llenar); $i++) {
    ?>
                <tr class='btn-outline-primary'>
     <td> <?php echo ('<span><img src="../Imagenes/Publicidad/' . $lflyerybanners[$i]["id_img"]. '.jpg"/ width="152" height="118"></span>'); ?></td>
    <?php
    if ($lflyerybanners[$i]["status"] == 'R') {
        printf("<td height='80' align='center' style='color: #EA1515 ;'><h5><b>Pendiente de corrección</b></h5></td>");
    } else if ($lflyerybanners[$i]["status"] == 'C') {
        printf("<td height='80' align='center' style='color: blue ;'><h5><b>En Revisión</b></h5></td>");
    } if ($lflyerybanners[$i]["status"] == 'A') {
        printf("<td height='80' align='center' style='color: #22C322;'><h5><b>Aprobado (Publicado)</b></h5></td>");
    }
    ?>
                    <td><?php
                    switch ($lflyerybanners[$i]["tipo"]) {
                        case 'F':
                            echo 'Flyer';
                            break;
                        case 'B':
                            echo 'Banner';
                            break;
                    }
                    ?></td>
                        <?php
                        //Lista de parametros por medio de los cuales se actualizara el cupon
                        $idpub = $lflyerybanners[$i]["id_ad"];
                        $idrob = $lflyerybanners[$i]["id_revision_objeto"];
                        $img = $lflyerybanners[$i]["id_img"];
                        ?>
                    <td> <?php echo '<a href="../Controller/crtePublicidad.php?id_revision_objeto=' . $idrob . '&id_ad=' . $idpub . '&id_img=' . $img . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar esta publicidad?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td><form method="post" action="../Controller/crtsPublicidad.php">
                    <?php echo "<input type='hidden' id='id_ad' name='id_ad' value='$idpub'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
    <?php
}
?>
        </tbody>
    </table></center>
            <?php
            include '../includes/footer.php';
            ?>
