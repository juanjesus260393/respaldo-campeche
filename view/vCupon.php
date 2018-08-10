<?php
include '../includes/header2.php';
?>
<div> 
    <center><h1>Cupones Validos</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Titulo</strong></td>
                <td><strong>Vigencia</strong></td>
                <td><strong>Terminos y Condiciones</strong></td>
                <td><strong>Status</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
<?php
$lcupones;
$llenar;
$validacion = new validacion();
// $aux = $validacion->campo_vacio($lcupones);
if ($lcupones == null) {
    $llenar = [0];
} else {
    $llenar = $lcupones;
}
for ($i = 0; $i < count($llenar); $i++) {
    ?>
                <tr>
                    <td><?php echo $lcupones[$i]["titulo"]; ?></td>
                    <td><?php echo $lcupones[$i]["vigencia_fin"]; ?></td>
                    <td><?php echo $lcupones[$i]["terminos_y_condiciones"]; ?></td>
                    <td><?php
            switch ($lcupones[$i]["status"]) {
                case 'C':
                    echo 'En revision';
                    break;
                case 'A':
                    echo 'Aprovado';
                    break;
                case 'R':
                    echo 'Rechazado';
                    break;
            }
    ?></td>
                        <?php
                        //Lista de parametros por medio de los cuales se actualizara el cupon
                        $idcup = $lcupones[$i]["id_cupon"];
                        $idrob = $lcupones[$i]["id_revision_objeto"];
                        $img = $lcupones[$i]["id_imagen_extra"];
                        $img2 = $lcupones[$i]["id_imagen_vista_previa"];
                        ?>
                    <td> <?php echo '<a href="../Controller/crteCupon.php?id_revision_objeto=' . $idrob . '&id_cupon=' . $idcup . '&id_imagen_extra=' . $img . '&id_imagen_vista_previa=' . $img2 . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este cupon?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td><form method="post" action="../Controller/crtsCupon.php">
                    <?php echo "<input type='hidden' id='id_cupon' name='id_cupon' value='$idcup'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
                            <?php
                        }
                        ?>
        </table></center>
</div>
<div> 
    <center><h1>Cupones Caducados</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Titulo</strong></td>
                <td><strong>Vigencia</strong></td>
                <td><strong>Terminos y Condiciones</strong></td>
                <td><strong>Status</strong></td>
                <td><strong>Eliminar</strong></td>
                <td><strong>Actualizar</strong></td>
            </tr>
<?php
$lcupones2;
$llenar;
if ($lcupones == null) {
    $llenar = [0];
} else {
    $llenar = $lcupones2;
}
for ($i = 0; $i < count($llenar); $i++) {
    ?>
                <tr>
                    <td><?php echo $lcupones2[$i]["titulo"]; ?></td>
                    <td><?php echo $lcupones2[$i]["vigencia_fin"]; ?></td>
                    <td><?php echo $lcupones2[$i]["terminos_y_condiciones"]; ?></td>
                    <td><?php
            switch ($lcupones2[$i]["status"]) {
                case 'C':
                    echo 'En revision';
                    break;
                case 'A':
                    echo 'Aprovado';
                    break;
                case 'R':
                    echo 'Rechazado';
                    break;
            }
    ?></td>
                        <?php
                        //Lista de parametros por medio de los cuales se actualizara el cupon
                        $idcup = $lcupones2[$i]["id_cupon"];
                        $idrob = $lcupones2[$i]["id_revision_objeto"];
                        $img = $lcupones2[$i]["id_imagen_extra"];
                        $img2 = $lcupones2[$i]["id_imagen_vista_previa"];
                        ?>
                    <td> <?php echo '<a href="../Controller/crteCupon.php?id_revision_objeto=' . $idrob . '&id_cupon=' . $idcup . '&id_imagen_extra=' . $img . '&id_imagen_vista_previa=' . $img2 . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este cupon?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td><form method="post" action="../Controller/crtsCupon.php">
                    <?php echo "<input type='hidden' id='id_cupon' name='id_cupon' value='$idcup'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
                            <?php
                        }
                        ?>
        </table></center>
</div>
            <?php
            include '../includes/footer.php';
            ?>

