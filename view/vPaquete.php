<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
    <center><h1>Paquetes</h1></center> 
    <center><table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
			<tr>
                  	<th scope="col"><strong>Nombre del pquete</strong></th>
	                <th scope="col"><strong>Descripcion</strong></th>
        	        <th scope="col"><strong>Eliminar</strong></th>
                	<th scope="col"><strong>Actualizar</strong></th>
	                </tr>
		     </thead>
		  <tbody>

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
                <tr class='btn-outline-primary'>
                    <td><?php echo $llenar[$i]["nombre"]; ?></td>
                    <td><?php echo $llenar[$i]["descripcion"]; ?></td>
                    <?php
                    $ip = $llenar[$i]["id_paquete"];
                    $nm = $llenar[$i]["nombre"];
                    $dc = $llenar[$i]["descripcion"];
                    $st = $llenar[$i]["status"];
                    ?>
                    <td> <?php echo '<a href="../Controller/crtEpaquete.php?id_paquete=' . $ip . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar este video?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td> 
                    <td><form method="post" action="../Controller/crtbpPaquete.php">
                            <?php echo "<input type='hidden' id='id_paquete' name='id_paquete' value='$ip'> <input type='submit' value='Actualizar'>" ?>
                        </form></td>
                </tr>
                <?php
            }
            ?>
	</tbody>
        </table>

    </center>
</body>
</html>