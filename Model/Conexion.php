<?php
class Conectar
{
	public static function con()
	{
        //Se declara la conexion en la cual se define el servidor, usuario y ccontraseña
	 $conexion = mysqli_connect("127.0.0.1:3306","root","P4SSW0RD","campeche");
               //$conexion = mysqli_connect("localhost","root","","campeche");
        return $conexion;
	}
}