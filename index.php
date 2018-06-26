<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
    <center><h1>Inicio de sesion</h1></center>
    <center><form method="post" name="Iniciodesesion" action="Controller/IniciodeSesion.php">
            <div>
                <span><label>Nombre de Usuario:</label></span>
                <span><input type="text" id="username" name="username" placeholder="Nombre de usuario"></span>
            </div>
            <div>
                <span><label>Contraseña:</label></span>
                <span><input type="password" id="password" name="password" placeholder="Contraseña"></span>
            </div>   
            <div>
                <span><input type="submit" value="Iniciar Sesion"></span>
            </div>
        </form></center>
</body>
</html>