<?php

if(isset($_GET['id'])) {
	if(strlen($_GET['id']) > 0) {
		$file = '../Imagenes/Cupones/VistaPrevia/' . $_GET['id'] . '.jpg';
		$type = 'image/jpg';
		header('Content-Type:'.$type);
		header('Content-Length: ' . filesize($file));
		readfile($file);
	}
}