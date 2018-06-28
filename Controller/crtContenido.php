<?php

//Se llama al modelo sitios
require_once("C:/xampp/htdocs/campeche-web2/Model/Sitios.php");
//se referencia la clase obtener sitios
$sitio = new obtener_sitios();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$pd = $sitio->lista_sitios();
//Se llama a la vista vista sitios     
 require_once("C:/xampp/htdocs/campeche-web2/view/VistaSitios.php");
?>

