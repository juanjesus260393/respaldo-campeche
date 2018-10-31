<?php
/**
 * Description of crtCountry
 *
 * @author Pablo
 */
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCountry.php");

$pais = new Country();
$respuesta= $pais->getCountry();
