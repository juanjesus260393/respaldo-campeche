<?php

//Se llama al modelo sitios
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener sitios
$cupon = new obtener_cupon();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$pd = $cupon->lista_cupones();
//Se llama a la vista vista sitios     
 require_once("C:/xampp/htdocs/campeche-web2/view/vCupon.php");
?>