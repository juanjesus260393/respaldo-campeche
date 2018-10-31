<?php

//Clase conectar que se manda  llamar cada vez que se necesita
class Conectar {

//Funcion publica que establece la conexion con el servidor de base de datos
    public static function con() {
        //Se declara la conexion en la cual se define el servidor, usuario y ccontrase
        //---------------------Conexion local y a Servidor Juan ---------------------------------------------
        // $conexion = mysqli_connect("127.0.0.1:3306", "root", "", "campeche");
        $conexion = mysqli_connect("localhost", "root", "P4SSW0RD", "campeche");
        //--------------------Conexion Local Isidro-----------------------------------------------------------
        //$conexion = mysqli_connect("148.204.63.167:3306", "root", "P4SSW0RD", "campeche");
        //$conexion = mysqli_connect("localhost", "root", "", "campeche1");
//------------------------------ Conexion local Campeche
        // $conexion = mysqli_connect("localhost", "root", "", "campeche");
        return $conexion;
    }

}
