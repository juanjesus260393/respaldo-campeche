<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>.</title>
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="container">
        <h1>Bienvenido Administrador </h1> <h5 style="text-align: right;"><a href="../Controller/cerrarSession.php">Cerrar Sesion</a></h5>
      </div>
        <div class="container">
            <div class="form-inline">
      <form  action="../Controller/IniciodeSesion.php" method="post">
        <input type="submit" value="Principal" name="principal" class="btn btn-warning"> 
        </form>
                
    <form  action="../Controller/Emp_Activas_controller.php" method="post">
            <input type="submit" value="Activas" name="activas" class="btn btn-warning "> 
    </form>

       <form action="../Controller/set_usu_controller1.php" method="post">
        <input type="submit" value="Modificar" name="setusu" class="btn btn-warning"> 
    </form>     
            
            </div>
        </div>
  <?php
  


            /* obtener el array asociativo */
                 printf("<table style='border: 3px solid black' align='center'>");
                 printf("<tr align='center'>");
                    printf("<th width='120' align='center'>Id</th>");
                    printf("<th width='220' align='center'>Nombre</th>");
                    printf("<th width='500' align='center'>Descripción</th>");
                    printf("<th width='220' align='center'>Sector</th>");
                    printf("<th width='220' align='center'></th>");
                 printf("</tr>");
   // while ($datos) {
   foreach ($datos as $dato) {
       
   
        printf("<tr>");
        printf ("<td height='80' align='center'> %s </td>"
                . "<td height='80' align='center'> %s </td>"
                . "<td height='80' align='center'> %s </td>"
                . "<td height='80' align='center'>%s </td>", $dato[0], $dato[1], $dato[2], $dato[3]);
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
    </body>
</html>

