<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bienvenidos</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-grid.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/Validaciones.js"></script>
        <link href="../campeche-web2/css/loginCss.css" rel="stylesheet">

    </head>
    <body>
        <?php
        session_start();

        if (isset($_SESSION['loggedin'])) {

            echo '<script language = javascript>
	
           self.location = "../campeche-web2/Controller/IniciodeSesion.php"
	</script>';
        } else {
            $_SESSION['loggedin'] = NULL;
            $_SESSION['username'] = NULL;
            $_SESSION['enabled'] = NULL;
            $_SESSION['idemp'] = NULL;
            $_SESSION['tipo'] = NULL;
            $_SESSION['total'] = NULL;
            $_SESSION['numCupones'] = NULL;
            $_SESSION['numVideos'] = NULL;
        }
        ?>
        <div class="row justify-content-center align-items-center">
        <script type="text/javascript" src="../campeche-web2/scripts/Comprobaciones.js"></script>
        <form method="post" name="Iniciodesesion" action="Controller/IniciodeSesion.php">
            <h1>Bienvenido Inicia Sesion</h1>
            <div class="inset">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <img src="Imagenes/web/ic_launcher.png" style="width:80px;">
                        </center>
                    </div>
                </div>
                <p>
                    <label for="username">Correo</label>
                    <input type="text" name="username" onkeypress = "validarcorreo()"  id="username" placeholder="Correo" pattern=".{5,50}" required title="Minimo 5 carateres y  maximo 50">
                    <span id="emailOK"></span>
                </p>
                <p>
                    <label for="password">Contraseña</label>
                    <input type="password" onkeypress = "validarespaciosvacioscontraseña()" id="password" name="password" placeholder="Contraseña" >
                    <span id="passOK"></span>
                    <input type="checkbox" onclick="showpassword()">Mostrar Contraseña
                </p>
            </div>
            <p class="p-container">
                <input type="submit" id="go" value="Iniciar Sesion">
            </p>
        </form>
        <div class="row justify-content-center align-items-center">
            <div class="col-2">
                <center>
                    <input class="btn btn-outline-warning btn-sm" type="button" data-toggle='modal' data-target='#resetpass' value='Restablecer contraseña'>
                    <?php include 'view/resetpass.php'; ?>
                </center>
            </div>

        </div>

        </div>
    </body>
</html>