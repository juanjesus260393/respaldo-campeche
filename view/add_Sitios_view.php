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
       <<nav class = "navbar navbar-expand-lg navbar-dark bg-dark" style = "margin:24px 0;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']);?></a>
            <button class = "navbar-toggler navbar-toggler-right" type = "button" data-toggle = "collapse" data-target = "#navb">
            <span class = "navbar-toggler-icon"></span>
            </button>
            <div class = "collapse navbar-collapse" id = "navb">
            <ul class = "navbar-nav mr-auto">
            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/ControladorSitios.php">Ver Sitios</a>
            </li>

            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/cambiaPass_controller.php">Cambiar Contraseña</a>
            </li>
            
            </ul>
              <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                  <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
              </form>
          </div>
      </nav>
        <div id="formulario" >
            <form  action="../Controller/add_Sitios_controller.php" method="post">
            <br><br>
            
            
            <label>Nombre del Sitio</label>
            <input type="text" size="40" name="nombreSitio">
            <label>Municipio</label>
            <?php
                     printf("<select required name='municipios'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($municipio as $mpio){
                     printf("<option value='".$mpio[0]."'>".$mpio[1]."</option>");
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
            <label>Capacidad</label>
            <input type="text" size="20" name="tam">
            <br>
            <label>Horario</label>
            <br>
            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAbre-&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-Cierra</label>
            <br>
            <input type="time" name="horaAbre" value="07:00"  step="1">
            <input type="time" name="horaCierra" value="07:00"  step="1">
            <br><br>
            
            <input type="submit" name="submit" value="Agregar Sitio">
            
            
        </form>
        
    </div>
        <?php
         

        ?>
    </body>
</html>
