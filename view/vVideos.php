<?php


include '../includes/header2.php';


?>

    <center><h1>Videos</h1></center> 
    <center><table class="table text-center" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
			<tr>
                  	<th scope="col"><strong>Titulo</strong></th>
	                <th scope="col"><strong>Descripcion</strong></th>
                        <th scope="col"><strong>Status</strong></th>
                	<th scope="col"><strong>Eliminar</strong></th>
	                <th scope="col"><strong>Actualizar</strong></th>
        	        </tr>
		     </thead>
		  <tbody>

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
                <tr class='btn-outline-primary'>
                    <td><?php echo $llenar[$i]["titulo"]; ?></td>
                    <td><?php echo $llenar[$i]["descripcion"]; ?></td>
                    <?php
                        
                          if ($llenar[$i]["status"] == 'R') {
                        printf("<td height='80' align='center' style='color: #EA1515 ;'><h5><b>Pendiente de corrección</b></h5></td>");
                    }else  if ($llenar[$i]["status"] == 'C') {
                        printf("<td height='80' align='center' style='color: blue ;'><h5><b>En Revisión</b></h5></td>");
                    } if ($llenar[$i]["status"] == 'A') {
                        printf("<td height='80' align='center' style='color: #22C322;'><h5><b>Aprobado (Publicado)</b></h5></td>");
                    }
                        
                        ?>
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara el cupon
                    $idv = $llenar[$i]["id_video"];
                    $idrob = $llenar[$i]["id_revision_objeto"];
                    $t = $llenar[$i]["titulo"];
                    $dc = $llenar[$i]["descripcion"];
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
	</tbody>
        </table></center>
 <?php


include '../includes/footer.php';


?>

