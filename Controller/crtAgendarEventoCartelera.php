<?php

/**
 * Description of crtAgendarEventoCartelera
 *
 * @author Pablo
 */
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlAgendarEventoCartelera.php");

$evento = new AgendarEventoCartelera();
$respuesta= $evento->AddEventoCartelera();
