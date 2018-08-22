<?php
require_once("C:/xampp/htdocs/campeche-web2/Model/Sectores2.php");
$sec = new Sector;
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$ls = $sec->search_sectorwithid();
echo json_encode($ls);