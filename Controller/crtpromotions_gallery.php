<?php
/**
 * Description of crtImage_Promociones
 *
 * @author Pablo
 */
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlImage_Promociones.php");
$galeria = new Image_Promociones();
$Resul= $galeria->search_galery();

