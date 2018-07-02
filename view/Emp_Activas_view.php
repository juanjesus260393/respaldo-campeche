<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>.</title>
    </head>
    <body>
        <h1>Bienvenido Administrador </h1>
        
    <form action="E-Pendientes.php" method="post">
        <input type="submit" value="Pendientes" name="Pendientes" > 
    </form>
    <form action="E-Desactivadas.php" method="post">
        <input type="submit" value="Desactivadas" name="Desactivadas" > 
    </form>
        
        
  <?php
  


            /* obtener el array asociativo */
                 printf("<table style='border: 3px solid black' align='center'>");
                 printf("<tr align='center'>");
                    printf("<th width='120' align='center'>Id</th>");
                    printf("<th width='220' align='center'>Nombre</th>");
                    printf("<th width='500' align='center'>Descripción</th>");
                    printf("<th width='220' align='center'>Sector</th>");
                 printf("</tr>");
   // while ($datos) {
   foreach ($datos as $dato) {
       
   
        printf("<tr>");
        printf ("<td height='80' align='center'> %s </td><td height='80' align='center'> %s </td><td height='80' align='center'> %s </td><td height='80' align='center'>%s </td>", $dato[0], $dato[1], $dato[2], $dato[3]);
        printf("</tr>");
    }
     printf("</table>");

        ?>
    </body>
</html>
