<?php
include '../includes/header2.php';
?>

    <center><h1>Lista de Vacantes</h1></center> 
    <center>
         <table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
                  <th scope="col" width='120' align='center'>Nombre</th>
                <th scope="col" width='220' align='center'>Salario</th>
                <th scope="col" width='500' align='center'>Horario</th>
                <th scope="col" width='500' align='center'>Status</th>
                <th scope="col" width='80' align='center'>Eliminar</th>
                <th scope="col" width='100' align='center'>Actualizar</th>

            </tr>
             <?php
            $lvacantes;
            $llenar;
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($lvacantes);
            if ($lvacantes == null) {
                $llenar = [0];
            } else {
                $llenar = $lvacantes;
            }
            for ($i = 0; $i < count($llenar); $i++) {
                ?>
                <tr> 
                    <td><?php echo $llenar[$i]["nombre"]; ?></td>
                    <td><?php echo $llenar[$i]["salario"]; ?></td>
                    <td><?php echo $llenar[$i]["horario"]; ?></td>
                    <?php
                        switch ($lvacantes[$i]["status"]) {
                            case 'C':
                               printf("<td height='80' align='center' style='color: blue ;'><h5><b>En Revisión</b></h5></td>");
                                break;
                            case 'A':
                                printf("<td height='80' align='center' style='color: #22C322;'><h5><b>Aprobado (Publicado)</b></h5></td>");
                                break;
                            case 'R':
                                printf("<td height='80' align='center' style='color: #EA1515 ;'><h5><b>Pendiente de corrección</b></h5></td>");
                                break;
                        }
                        ?></td>
                    
                      
                    <?php
                    //Lista de parametros por medio de los cuales se actualizara la vacante
                    $idv = $llenar[$i]["id_vacante"];
                    $idrob = $llenar[$i]["id_revision_objeto"];
                    $nom = $llenar[$i]["nombre"];
                    $sal = $llenar[$i]["salario"];
                    $hor = $llenar[$i]["horario"];
                    $status = $llenar[$i]["status"];
                   if ($status!='A')  { ?>                 
                    <td> <?php echo '<a href="../Controller/crteVacante.php?id_revision_objeto=' . $idrob . '&id_vacante=' . $idv . '&nombre=' . $nom . '&salario=' . $sal . '&horario=' . $hor . '" onclick="if (!confirm(\'Estas seguro que quieres eliminar esta Vacante?\')) { return false}"><img src="img/eliminar.jpg"></a>' ?></td>
                    <td>
                        <form method="post" action="../Controller/crtaodaVacante.php">
                            <?php echo "<input type='hidden' id='id_vacante' name='id_vacante' value='$idv'> "
                                    . "<input type='submit' value='Actualizar'>" ?>
                        </form>
                        <?php } else { ?>

                            <td> </td> <td> </td>   <?php
            }
            ?>

                    </td>
                </tr>
                <?php
            }
            ?>
        </table></center>
 <?php
include '../includes/footer.php';
?>

