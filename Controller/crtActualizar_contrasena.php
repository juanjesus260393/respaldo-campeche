<?php
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlActualizar_contrasena.php");
/**
 * Description of crtActualizar_vacante
 *
 * @author Pablo
 */
$actualizarPass = new Actualizar_contrasena();
$respuesta = $actualizarPass->CambiarPassword();

?>

