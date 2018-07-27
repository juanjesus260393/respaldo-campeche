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
    </head>
    <body>
        <?php
        //Se manda a llamar a la clase validaciones para verificar el estado de la empresa
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
        <div id = "cupones_caducados"> 
            <center><h2>Cupones que caducaran en los proximos 5 dias o que ya han caducado, Verifica el termino de vigencia</h2></center> 
            <center><table border="1">
                    <tr>
                        <td><strong>Titulo</strong></td>
                        <td><strong>Termino de Vigencia</strong></td>
                        <td><strong>Cantidad de Codigos Restantes</strong></td>
                    </tr>
                    <?php
                    $lcupones;
                    $lcupones = $val->lista_cupones_caducados();
                    $llenar;
                    $validacion = new validacion();
                    if ($lcupones == NULL) {
                        $llenar = [0];
                        echo 'Felicades Todos tus Cupones Se encuentran Activos';
                    } else {
                        $llenar = $lcupones;
                    }

                    for ($i = 0; $i < count($llenar); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $lcupones[$i]["titulo"]; ?></td>
                            <td><?php echo $lcupones[$i]["vigencia_fin"]; ?></td>
                            <td><?php echo $lcupones[$i]["limite_codigos"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table></center>
        </div>



    </body>
</html>