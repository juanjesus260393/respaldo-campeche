<?php
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');
$conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se genera el identificador de la revision del objeto
        $na = new validacion();
        $nombre = 'juan';
        $descripcion = 'cron prueba';
        $idpa = $na->generar_aleatorio();
        $status = 'C';
        $sql = "INSERT INTO paquete(id_paquete,nombre,status)
        VALUES('$idpa','$nombre','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);