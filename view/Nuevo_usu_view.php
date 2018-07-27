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
     <script src="../js/Validaciones.js"></script>
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
        <div class="container form-group" id="formulario" >
            <h1 style="text-align:center;">Nueva Empresa</h1>
            <form  action="../Controller/Nuevo_usu_controller.php" method="post">
            <br><br>
            
            <label>Correo</label>
            <input type="text" size="32" placeholder="ejemplo@correo.com" name="email" />
            <label>Nombre de la Empresa</label>
            <input type="text" size="40" name="empresa">
            <br>
            <span ><label>Membresias</label>
                <label class="btn btn-outline-primary">
                    <input type="radio"  name="membresia" class="" value="BASICA">
            
                    <img src="../Controller/img/Mbasica.png" alt="Basica" height="50" width="60" class="">
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio"  name="membresia" class="" value="PREMIUM">
                
                    <img src="../Controller/img/MPremium.png" alt="Premium" height="50" width="60" class="">
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio"  class="" name="membresia" value="360">
                
                    <img src="../Controller/img/M360.png" alt="360" height="50" width="60" class="">
                </label>
            </span>
            <label>Sector</label>
            <?php
                     printf("<select required name='sectores'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($sector as $sec){
                     printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <br>
            <label>Telefono</label>
            <input type="text" size="20" name="tel1" onkeypress="soloNum()">
            <label>Extension</label>
            <input type="text" size="20" name="tel2" onkeypress="soloNum()">
            <label>Celular</label>
            <input type="text" size="20" name="cel" onkeypress="soloNum()">
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
            <textarea name="desc" rows="10" cols="80"  maxlength="499" placeholder="Escriba una descripcion larga ..."></textarea>
            <label>Facebook</label>
            <input type="text" size="40" name="facebook">
            <label>Twitter</label>
            <input type="text" size="40" name="twitter">
            <label>Instagram</label>
            <input type="text" size="40" name="instagram">
            <label>Youtube</label>
            <input type="text" size="40" name="youtube">
            <label>Google +</label>
            <input type="text" size="40" name="googleplus">
            <br>
            <label>Tamaño</label>
            <input type="text" size="20" name="tam">
            <br>
            <label>Rango de costos</label>
            <br>
            <label>Minimo---Maximo</label>
            <?php
                     printf("<select required name='rangos'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($rangos as $costo){
                     printf("<option value='".$costo[0]."'>".$costo[1]."</option>");
                     }
                     printf("</select>");
                    ?>
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
