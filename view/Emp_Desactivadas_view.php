<!DOCTYPE html>

<html lang="en">
       <head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
   
    
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:24px 0;">
  <a class="navbar-brand" href="">Administrador</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
              <a class="nav-link " href="../Controller/Emp_Activas_controller.php" >
                  HOME
              </a>

          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Empresas
              </a>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="../Controller/Emp_Activas_controller.php">Principal</a>
                  <a class="dropdown-item" href="../Controller/Nuevo_usu_controller.php">Nueva Empresa</a>
                  <a class="dropdown-item" href="../Controller/Emp_Desactivadas_controller.php">Empresas Deshabilitadas</a>
                  <a class="dropdown-item" href="../Controller/set_usu_controller1.php">Modificar Empresas</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Validar
              </a>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="">Cupones</a>
                  <a class="dropdown-item" href="">Videos</a>
                  <a class="dropdown-item" href="">Audioguia</a>
              </div>
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
          <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
      </form>
  </div>
</nav>        
  
  


        
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
                 
                 
    </body>
</html>

