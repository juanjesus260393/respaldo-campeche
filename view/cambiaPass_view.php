<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <nav class = "navbar navbar-expand-lg navbar-dark bg-dark" style = "margin:24px 0;">
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
                <a class = "nav-link" href = "../Controller/IniciodeSesion.php">Principal</a>
            </li>
            
            </ul>
            <form class = "form-inline my-2 my-lg-0" action = "../Controller/cerrarSession.php">
            <button class = "btn btn-warning my-2 my-sm-0" type = "submit">Cerrar Sesion</button>
            </form>
            </div>
            </nav>
        
        
        
        <div id="formulario" >
            <form  id="setpas"  name="passform" action="../Controller/cambiaPass_controller.php" onsubmit="return validar_pass()" method="post">
            <br><br>
            <h4>Ingresa tu nueva contraseña</h4>
            <label>Contraseña</label>
            <input type="password" size="40" id="password" name="password" />
            <label>Confirma Constraseña</label>
            <input type="password" size="40" id="password2">
            <input type="submit" name="submit"   value="Cambiar Contraseña">
            </form>
        </div>
    </body>
</html>
