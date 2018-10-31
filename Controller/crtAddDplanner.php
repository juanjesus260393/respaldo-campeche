<?php
/**
 * Description of crtAddDplanner
 *
 * @author Pablo
 */
 require_once("C:/xampp/htdocs/campeche-web2/Model/mdlEventDplanner.php");
$evento = new eventDplanner();
$respuesta= $evento->agregarEvento();

