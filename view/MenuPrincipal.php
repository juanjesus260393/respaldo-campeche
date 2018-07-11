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
        <?php
        //Se manda a llamar a la clase validaciones para verificar el estado de la empresa
        require_once("../scripts/Validaciones.php");
        $val = new validacion ();
        //Se llama al metodo habilitado
        //$estatus = $val->habilitado($ena);
        ?>
        <!-- Se recibe el nombre de usuario debido a que las opciones cambiaran dependiendo del tipo de usuario--> 
        <div class="container">
            <h2  style="text-align: center;" >-<?php echo "Bienvenido: " . $_SESSION['username']; ?></h2><h5 style="text-align: right;"><a href="../Controller/cerrarSession.php">Cerrar Sesion</a></h5>
        </div>
        <!-- Funcion para habilitar un div si el tipo de usuario es empresa o administrador--> 
        <div id = "tipo_usuario"> 
            <?php $estatus = $val->mostrar_ocultar(); ?>
        </div>




    </body>
</html>