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
                 printf("<table style='border: 2px solid black'>");
                 printf("<tr>");
                    printf("<th>Id</th>");
                    printf("<th>Nombre</th>");
                    printf("<th>Descripción corta</th>");
                    printf("<th>Sector</th>");
                 printf("</tr>");
   // while ($datos) {
   foreach ($datos as $dato) {
       
   
        printf("<tr>");
        printf ("<td> %s </td><td> %s </td><td> %s </td><td>%s </td>", $dato[0], $dato[1], $dato[2], $dato[3]);
        printf("</tr>");
    }
     printf("</table>");

        ?>
    </body>
</html>
