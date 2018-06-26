<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo usuario</title>
    </head>
    <body>
        <h1 align="center">Nuevo Usuario</h1>
        <div id="formulario" >
            <form enctype="text/plain" method="post" action="Nuevo_usu_model">
            <br><br>
            
            <label>Correo</label>
            <input type="text" size="32" placeholder="ejemplo@correo.com" name="email" />
            <label>Nombre de la Empresa</label>
            <input type="text" size="40" name="empresa">
            <label>Sector</label>
            <?php
                     printf("<select required name='sector'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($sector as $sec){
                     printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <label>Telefono 1</label>
            <input type="text" size="20" name="tel1">
            <label>Telefono 2</label>
            <input type="text" size="20" name="tel2">
            <br>
            <label>Direccion</label>
            <br>
            <textarea name="dir" rows="3" cols="35" placeholder="Escriba la direccion..."></textarea>
            <label>Propietario</label>
            <input type="text" size="35" name="propietario">
             <label>Numero de Empleados</label>
            <input type="text" size="5" name="numempleados">
            <br>
            <label>Descripcion corta</label>
            <br>
            <textarea name="descC" rows="5" cols="25" placeholder="Escriba una descripcion corta..."></textarea>
            <br>
            <label>Descripcion larga</label>
            <br>
            <textarea name="descL$" rows="10" cols="80" placeholder="Escriba una descripcion larga ..."></textarea>


            <br>
            <br>
            <input type="submit" value="Agregar usuario">
            
            
        </form>
        
    </div>
        <?php
         

        ?>
    </body>
</html>
