<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/Validaciones.js"></script>
    </head>
    <body>
        <div id="formulario" >
            <form  id="setpas"  name="passform" action="../Controller/cambiaPass_controller.php" onsubmit="return validar_pass()" method="post">
            <br><br>
            <h4>Ingresa tu nueva contraseña</h4>
            <label>Contraseña</label>
            <input type="password" size="40" id="password" name="password" />
            <label>Confirma Constraseña</label>
            <input type="password" size="40" id="password2">
            <input type="submit" name="submit"   value="Cambiar Contraseña">
            </form>
        </div>
    </body>
</html>
