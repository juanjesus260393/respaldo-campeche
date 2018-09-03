<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-grid.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>


        <title>Proyecto Campeche 360</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--  jquery plguin -->
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <!--start manu -->
        <link href="../css/flexy-menu.css" rel="stylesheet">
        <link href="../css/menu.css" rel="stylesheet">
    </head>
    <body>
        <?php
        //Se manda a llamar a la clase validaciones para verificar el estado de la empresa
        require_once ("../Model/conexion.php");
        require_once("../scripts/Validaciones.php");
        $val = new validacion ();
        //Se llama al metodo habilitado
        //$estatus = $val->habilitado($ena);
        //echo $_SESSION['id_membresia'];
        ?>
        <!-- Se recibe el nombre de usuario debido a que las opciones cambiaran dependiendo del tipo de usuario--> 
        <!-- Funcion para habilitar un div si el tipo de usuario es empresa o administrador--> 
        <div id = "tipo_usuario"> 
            <?php $estatus = $val->mostrar_ocultar(); ?>
        </div>

    

<?php
include '../includes/footer.php';
?>