<?php


include '../includes/header.php';


?>
      
  
  


        
                 <table style='border: 3px solid black' align='center'>
                
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
        
        printf("<td height='80' align='center'>"
                . "<table>"
                . "<tr>"
                . "<form action='../Controller/Emp_Desactivadas_controller.php' method='post'>"
                ."<input type='hidden' name='user_able' value='".$dato[4]."'>"
                . "<input type='submit' name='activar' value='Habilitar'>"
                . "</form>"
                . "</tr>"
                . "</table> "
                . "</td>");
        printf("</tr>");
    }
     printf("</table>");

        ?>
                 
                 
<?php


include '../includes/footer.php';


?>

