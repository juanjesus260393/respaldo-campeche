<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo usuario</title>
        
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/Validaciones.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="form-inline">
        <form action="../Controller/IniciodeSesion.php" method="post">
            <input type="submit" value="Principal" name="principal"  class="btn btn-warning"> 
        </form></div></div>
        <h1 style="text-align: center;">Nuevo Usuario</h1><h5 style="text-align: right;"><a href="../Controller/cerrarSession.php">Cerrar Sesion</a></h5>
        <div id="formulario" >
            <form  action="../Controller/Nuevo_usu_controller.php" method="post">
            <br><br>
            
            <label>Correo</label>
            <input type="text" size="32" placeholder="ejemplo@correo.com" name="email" />
            <label>Nombre de la Empresa</label>
            <input type="text" size="40" name="empresa">
            <label>Sector</label>
            <?php
                     printf("<select required name='sectores'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($sector as $sec){
                     printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <label>Telefono 1</label>
            <input type="text" size="20" name="tel1" onkeypress="soloNum()">
            <label>Telefono 2</label>
            <input type="text" size="20" name="tel2" onkeypress="soloNum()">
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
            <textarea name="desc" rows="10" cols="80" placeholder="Escriba una descripcion larga ..."></textarea>
            <br>
            <label>Tamaño</label>
            <input type="text" size="20" name="tam">
            <br>
            <label>Ventas mensuales</label>
            <input type="text" size="20" name="ventas" onkeypress="soloNum()">
            <label>Monto de rangos</label>
            <br>
            <label>Minimo---Maximo</label>
            <input type="text" size="20" name="min" onkeypress="soloNum()">
            <input type="text" size="20" name="max" onkeypress="soloNum()">
            <br><br>
            <input type="checkbox" name="habilitar" value="si" checked> Habilitar usuario<br>


            <br>
            <br>
            <input type="submit" name="submit" value="Agregar usuario">
            
            
        </form>
        
    </div>
        <?php
         

        ?>
    </body>
</html>
