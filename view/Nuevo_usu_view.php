<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Nueva Empresa</title>
    
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
                      <a class="nav-link " href="../Controller/set_usu_controller1.php">Modificar empresas</a>
                  </li>
              </ul>
              <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                  <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
              </form>
          </div>
      </nav>
        <div id="formulario" >
            <form  action="../Controller/Nuevo_usu_controller.php" method="post">
            <br><br>
            
            <label>Correo</label>
            <input type="text" size="32" placeholder="ejemplo@correo.com" name="email" />
            <label>Nombre de la Empresa</label>
            <input type="text" size="40" name="empresa">
            <label>Sector</label>
            <?php
                     printf("<select required name='sectores'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($sector as $sec){
                     printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <label>Telefono 1</label>
            <input type="text" size="20" name="tel1" onkeypress="soloNum()">
            <label>Telefono 2</label>
            <input type="text" size="20" name="tel2" onkeypress="soloNum()">
            <br>
            <label>Direccion</label>
            <br>
            <textarea name="dir" rows="3" cols="35" placeholder="Escriba la direccion..."></textarea>
            <label>Propietario</label>
            <input type="text" size="35" name="propietario">
             <label>Numero de Empleados</label>
            <input type="text" size="5" name="numempleados">
            <br>
            <label>Descripcion </label>
            <br>
            <textarea name="desc" rows="10" cols="80" placeholder="Escriba una descripcion larga ..."></textarea>
            <br>
            <label>Tamaño</label>
            <input type="text" size="20" name="tam">
            <br>
            <label>Ventas mensuales</label>
            <input type="text" size="20" name="ventas" onkeypress="soloNum()">
            <label>Monto de rangos</label>
            <br>
            <label>Minimo---Maximo</label>
            <input type="text" size="20" name="min" onkeypress="soloNum()">
            <input type="text" size="20" name="max" onkeypress="soloNum()">
            <br>
            <input type="checkbox" name="habilitar" value="si" checked> Habilitar usuario<br>


          
            <br>
            <input type="submit" name="submit" value="Agregar usuario">
            
            
        </form>
        
    </div>
        <?php
         

        ?>
    </body>
</html>
