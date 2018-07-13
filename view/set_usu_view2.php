<!DOCTYPE html>

<html lang="en">
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
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:24px 0;">
          <a class="navbar-brand" href="">Administrador</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navb">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="../Controller/Emp_Activas_controller.php">Principal</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../Controller/Emp_Desactivadas_controller.php">Empresas Deshabilitadas</a>
                  </li>
                  
              </ul>
              <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                  <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
              </form>
          </div>
      </nav>
   
        <h1 align="center">Nuevo Usuario</h1>
        <div id="formulario" class="container">
        <?php
                    foreach ($datos as $info){   
          
            
                        printf('  <form  action="../Controller/Set_usu_controller2.php" method="post">');
                        printf('  <br><br>');
                        printf("<input type='hidden' name='usu_before_set' value='".$info[0]."'>");
                        printf('    <label>Correo</label>');
                        printf('<div class="input-group">');
                        printf('<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>');
                        printf(' <input id="email" type="text" size="32" name="email" class="form-control" value="'.$info[0].'"/>');
                        printf('</div>');
                        printf('   <label>Nombre de la Empresa</label>');
                        printf('   <input type="text" size="40" name="empresa" value="'.$info[1].'">');
                        printf('      <label>Sector</label>');
                        printf("<select required name='sectores'>");
                        printf("<option value='".$info[2]."'>".$info[3]."</option>");
                         foreach ($sector as $sec){
                               printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                        }
                        printf("</select>");
                        printf(' <label>Telefono 1</label>');
                        printf('    <input type="text" size="20" name="tel1" value="'.$info[4].'">');
                        printf('  <label>Telefono 2</label>');
                        printf('    <input type="text" size="20" name="tel2" value="'.$info[5].'">');
                        printf('  <br>');
                        printf('     <label>Direccion</label>');
                        printf('  <br>');
                        printf('     <textarea name="dir" rows="3" cols="35">'.$info[6].'</textarea>');
                        printf('  <label>Propietario</label>');
                        printf('       <input type="text" size="35" name="propietario" value="'.$info[7].'">');
                        printf('  <label>Numero de Empleados</label>');
                        printf('     <input type="text" size="5" name="numempleados" value="'.$info[8].'">');
                        printf('    <br>');
                        printf('      <label>Descripcion </label>');
                        printf(' <br>');
                        printf('   <textarea name="desc" rows="10" cols="80" >'.$info[9].'</textarea>');
                        printf('<br>');
                        printf('    <label>Tamaño</label>');
                        printf('  <input type="text" size="20" name="tam" value="'.$info[10].'">');
                        printf('   <br>');
                        printf('  <label>Ventas mensuales</label>');
                        printf('    <input type="text" size="20" name="ventas" value="'.$info[11].'">');
                        printf('  <label>Monto de rangos</label>');
                        printf('    <br>');
                        printf('  <label>Minimo---Maximo</label>');
                        printf('   <input type="text" size="20" name="min" value="'.$info[12].'">');
                        printf('<input type="text" size="20" name="max" value="'.$info[13].'">');
                        printf('    <br><br>');
                        if($info[14]==1){
                                 printf('  <label><h3>-------Ya Esta Habilitado-------</h3></label>');
                                 printf('  <br>');
                                 printf('  <br>');
                                 printf(' <input type="checkbox" name="habilitar"  checked> Deshabilitar usuario<br>');}
                      else{
                                 printf('  <label><h3>-------Ya Esta Deshabilitado-------</h3></label>');
                                 printf('  <br>');
                                 printf('  <br>');
                                 printf(' <input type="checkbox" name="habilitar" > Habilitar usuario<br>');
                      }
                      printf("<input type='hidden' name='userr' value='".$info[15]."'>");
       //  printf("<input type='hidden' name='user_to_set' value='".$dato[4]."'>");
                      printf('  <br>');
                      printf('  <br>');
                      printf('    <input type="submit" name="submit2" value="Modificar usuario">');
            
            
                     printf('   </form> ');
                    }
        ?>
    </div>
       
    </body>
</html>
