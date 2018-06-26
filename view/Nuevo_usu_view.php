<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo usuario</title>
    </head>
    <body>
        <h1 align="center">Nuevo Usuario</h1>
        <form>
            <br><br>
            
            <label>Correo</label>
            <input type="text" size="32" placeholder="ejemplo@correo.com" name="email" />
            <label>Nombre de la Empresa</label>
            <input type="text" size="40" name="empresa">
            <label>Sector</label>
            <?php
                     printf("<select>");
                     foreach ($sector as $sec){
                     printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <label>Telefono 1</label>
            <input type="text" size="20" name="tel1">
            <label>Telefono 2</label>
            <input type="text" size="20" name="tel2">
            
            
        </form>
        <?php
        
        ?>
    </body>
</html>
