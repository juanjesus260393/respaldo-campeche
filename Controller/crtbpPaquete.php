<?php
require_once("../Model/mdlPaquetes.php");
//se referencia la clase obtener sesiones
$dpaquete = new Paquetes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$paquete = $dpaquete ->buscar_paquete();
//Se llama a la vista vista sitios
require_once("../view/actualizarPaquete.php");

