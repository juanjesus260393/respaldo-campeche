<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once ("../Model/conexion.php");
require_once("../Model/Nuevo_usu_model.php");
$Nw_usu=new Nuevo_usu_model();

    echo '<h2>holaaaaaaaaaaaaaaaaa</h2>';
   $b=$Nw_usu->add_usuario();
    echo '<h2>holaaaaaaaaaaaaaaaaa</h2>';
    

        ?>
    </body>
</html>
