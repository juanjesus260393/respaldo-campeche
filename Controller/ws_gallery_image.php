<?php

if(isset($_GET['id'])) {
	if(strlen($_GET['id']) > 0) {
		$type = 'image/jpg';
		$end = "jpg";
		
		$file = '/Imagenes/Galeria/' . $_GET['id'] . '.' . $end;
		header('Content-Type:'.$type);
		header('Content-Length: ' . filesize($file));
		readfile($file);
	}
}