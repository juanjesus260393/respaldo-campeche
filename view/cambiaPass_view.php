<?php
include '../includes/header2.php';

?>
       
        
        
        
        <div id="formulario" >
            <form  id="setpas"  name="passform" onSubmit="return validar_pass(this);" action="../Controller/cambiaPass_controller.php"  method="post">
            <br><br>
            <h4>Ingresa tu nueva contraseña</h4>
            <label>Contraseña</label>
            <input type="password" size="40" id="password" name="password" />
            <label>Confirma Constraseña</label>
            <input type="password" size="40" id="password2">
            <input type="submit" name="si"   value="Cambiar Contraseña">
            </form>
        </div>
 <?php
include '../includes/footer.php';
?>
