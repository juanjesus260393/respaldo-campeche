<?php
include '../includes/header2.php';
?>
<div> 
    <center><h1>Cupones Validos</h1></center> 
    <center><table class="table text-center" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
			<tr>
                  	<th scope="col"><strong>Titulo</strong></th>
                	<th scope="col"><strong>Vigencia</strong></th>
	                <th scope="col"><strong>Terminos y Condiciones</strong></th>
        	        <th scope="col"><strong>Status</strong></th>
                	<th scope="col"><strong>Eliminar</strong></th>
	                <th scope="col"><strong>Actualizar</strong></th>
        	        </tr>
		     </thead>
		  <tbody>
            <?php
            $lcupones;
            $lcupones2;
            $llenar;
            $validacion = new validacion();
            $aux = $validacion->campo_vaciocupon($lcupones,$lcupones2);
            if ($lcupones == null) {
                $llenar = [0];
            } else {
                $llenar = $lcupones;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr  class='btn-outline-primary'>
                    <td><?php echo $lcupones[$i]["titulo"]; ?></td>
                    <td><?php echo $lcupones[$i]["vigencia_fin"]; ?></td>
                    <td><?php echo $lcupones[$i]["terminos_y_condiciones"]; ?></td>
                    <?php
                        
                          if ($lcupones[$i]["status"] == 'R') {
                        printf("<td height='80' align='center' style='color: #EA1515 ;'><h5><b>Pendiente de corrección</b></h5></td>");
                    }else  if ($lcupones[$i]["status"] == 'C') {
                        printf("<td height='80' align='center' style='color: blue ;'><h5><b>En Revisión</b></h5></td>");
                    } if ($lcupones[$i]["status"] == 'A') {
                        printf("<td height='80' align='center' style='color: #22C322;'><h5><b>Aprobado (Publicado)</b></h5></td>");
                    }
                        
                        ?>
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
	</tbody>
        </table></center>
</div>
<div> 
    <center><h1>Cupones Caducados</h1></center> 
    <center><table class="table text-center" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
            <thead class="thead-dark" align='center'>
		<tr>
                <th scope="col">Titulo</th>
                <th scope="col">Vigencia</th>
                <th scope="col">Terminos y Condiciones</th>
                <th scope="col">Eliminar</th>
            </tr>
	</thead>
            <?php
            $lcupones2;
            $llenar;
            if ($lcupones2 == null) {
                $llenar = [0];
            } else {
                $llenar = $lcupones2;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr class='btn-outline-primary'>
                    <td><?php echo $lcupones2[$i]["titulo"]; ?></td>
                    <td><?php echo $lcupones2[$i]["vigencia_fin"]; ?></td>
                    <td><?php echo $lcupones2[$i]["terminos_y_condiciones"]; ?></td>
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idcup = $lcupones2[$i]["id_cupon"];
                    $idrob = $lcupones2[$i]["id_revision_objeto"];
                    $img = $lcupones2[$i]["id_imagen_extra"];
                    $img2 = $lcupones2[$i]["id_imagen_vista_previa"];
                    ?>
                    <td> <?php echo '<a href="../Controller/crteCupon.php?id_revision_objeto=' . $idrob . '&id_cupon=' . $idcup . '&id_imagen_extra=' . $img . '&id_imagen_vista_previa=' . $img2 . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este cupon?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                </tr>
                <?php
            }
            ?>
        </table></center>
</div>
<?php
include '../includes/footer.php';
?>
