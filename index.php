<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
       <?php
       session_start();

            $_SESSION['loggedin']=NULL;
            $_SESSION['username']=NULL;
            $_SESSION['enabled']=NULL;
            $_SESSION['idemp']=NULL;
            $_SESSION['tipo']=NULL;
       
       ?>
    <center><h1>Inicio de sesion</h1></center>
    <center><form method="post" name="Iniciodesesion" action="Controller/IniciodeSesion.php">
            <div>
                <span><label>Nombre de Usuario:</label></span>
                <span><input type="text" id="username" name="username" placeholder="Nombre de usuario" pattern=".{5,50}" required title="Minimo 5 carateres y  maximo 50">
                </span>
            </div>
            <div>
                <span><label>Contraseña:</label></span>
                <span><input type="password" id="password" name="password" placeholder="Contraseña" pattern=".{5,100}" required title="Minimo 5 carateres y  maximo 50"></span>
            </div>   
            <div>
                <span><input type="submit" value="Iniciar Sesion"></span>
            </div>
        </form></center>
</body>
</html>