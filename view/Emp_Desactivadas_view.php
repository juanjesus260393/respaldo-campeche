<?php


include '../includes/header.php';


?>
     
                      <table style='border: 1px solid black' align='center'>
                
                     <tr align='center'>
                  <th width='120' align='center'>Id</th>
                    <th width='220' align='center'>Nombre</th>
                    <th width='500' align='center'>Descripción</th>
                    <th width='220' align='center'>Sector</th>
                    <th width='220' align='center'>Membresia</th>
                            <th width='220' align='center'></th>
                 </tr>
                 
                 <?php
             
   // while ($datos) {
   foreach ($datos as $dato) {
       
   
        printf("<tr>");
        printf ("<td height='80' align='center'> %s </td>"
                . "<td height='80' align='center'> %s </td>"
                . "<td height='80' align='center'> %s </td>"
                . "<td height='80' align='center'>%s </td>", $dato[0], $dato[1], $dato[2], $dato[3]);
        printf("<td height='80' align='center'>");
        switch ($dato[5]){
                    case 1:
                printf('         <img src="../Controller/img/Mbasica.png" alt="Basica" height="50" width="60" class="">');
                break;
                    case 2:
                printf('         <img src="../Controller/img/MPremium.png" alt="Premium" height="50" width="60" class="">');
                break;
                    case 3:
                printf('          <img src="../Controller/img/M360.png" alt="360" height="50" width="60">');
                break;
                }
        printf("</td>");
        
        printf("<td height='80' align='center'>"); ?>
                <table>
                <tr>
                <form action='../Controller/Emp_Desactivadas_controller.php' method='post'>
                    
                    
                   <div class="modal" id="Modalfecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Caducidad de Membresia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <label>Fecha Fin de Membresia</label><br>
                                <input type="date" name="fechafin">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="aprobar" name="activar" value="Aprobar">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>             
                    
                    
                <input type='hidden' name='user_able' value='<?php printf($dato[4]); ?>'>
                <input type='hidden' name='idemp' value='<?php printf($dato[0]); ?>'>
                <input type='button' name='abrefecha' value='Habilitar' data-toggle='modal' data-target='#Modalfecha'>
                </form>
               </tr>
                </table> 
                </td>
        </tr>
  <?php  } ?>
     </table>

       
               
<?php


include '../includes/footer.php';


?>

