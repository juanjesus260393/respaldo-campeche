<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Vista donde se encuentra toda la parte visual necesaria
 *   para  cambiar la contraseña
 * 
 * por Fabrica de Software, CIC-IPN
 */
include '../includes/header2.php';


//Formulario para cambiar contraseña
?>
       
        
        
        
        <div id="formulario" style="border-style:solid; border-width: 1px; border-color: #f1f1f1;">
            <form  id="setpas"  name="passform" onSubmit="return validar_pass(this);" action="../Controller/cambiaPass_controller.php"  method="post">
            <br><br>
            <h4>Ingresa tu nueva contraseña</h4>
            <label style="background-color:#f1f1f1;">Contraseña</label>
            <input type="password" size="40" id="password" name="password" />
            <label style="background-color:#f1f1f1;">Confirma Constraseña</label>
            <input type="password" size="40" id="password2">
            <input type="submit" name="si"   value="Cambiar Contraseña">
            </form>
        </div>
 <?php
include '../includes/footer.php';
?>
