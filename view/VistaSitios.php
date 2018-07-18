<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-grid.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
   
    
        <title>Proyecto Campeche 360</title>
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
                <a class = "nav-link" href = "../Controller/IniciodeSesion.php">Principal</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/add_Sitios_controller.php">Nuevo Sitio</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/cambiaPass_controller.php">Cambiar Contraseña</a>
            </li>
            
            </ul>
            <form class = "form-inline my-2 my-lg-0" action = "../Controller/cerrarSession.php">
            <button class = "btn btn-warning my-2 my-sm-0" type = "submit">Cerrar Sesion</button>
            </form>
            </div>
            </nav>
    <center><h1>Administracion de los Sitios</h1></center> 
    <center><table border="1">
            <tr>
                <td><strong>Nombre del sitio</strong></td>
                <td><strong>Direccion del sitio</strong></td>
                <td><strong>Modificar Contenido del Sitio</strong></td>
            </tr>
            <?php
            require_once '../scripts/Validaciones.php';
            $validacion = new validacion();
            $aux = $validacion->campo_vacio($pd);
            for ($i = 0; $i < count($pd); $i++) {
                ?>
                <tr>
                    <td><?php echo $pd[$i]["nombre"]; ?></td>
                    <td><?php echo $pd[$i]["direccion"]; ?></td>
                    <?php
                    $nm = $pd[$i]["nombre"];
                    ?>
                    <td> <?php echo "<a href='../view/Contenido.php?name=$nm'><img src='img/actualizar.jpg'/></a>" ?></td>                    
                </tr>
                <?php
            }
            ?>
        </table></center>
</body>
</html>