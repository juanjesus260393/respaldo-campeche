<?php
//Se llama al modelo turista
require_once("C:/xampp/htdocs/campeche-web2/Model/VideosTurista.php");
//se referencia la clase turista
$videoss= new videosturista();
$sv = $videoss->indetificacion();
?>