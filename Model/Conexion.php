<?php

class Conectar {

    public static function con() {
        $conexion = mysqli_connect("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
        return $conexion;
    }

}
