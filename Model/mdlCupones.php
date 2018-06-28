<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');

class obtener_cupon {
    //Se crea el metodo obtener los objetos revisados esto con el objetivo obtener aquellos cupones que han sido colocados por una empresa 
    //en especificos
    public function lista_objetos_revisados() {
        //Se llama a la case conectar del archivo conexion.php
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se recibe el dentificador de la empresa de  la clase contenido
        $id_empresa= $_GET['ide'];
        //Consultar si los datos son están guardados en la base de datos
        $consulta = "SELECT id_revision_objeto FROM revision_objeto WHERE id_empresa = '".$id_empresa."'";
        
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
       
    }
    public function lista_cupones() {
        //Se llama a la case conectar del archivo conexion.php
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se recibe la contrasela del formulario inicio de sesion
        $id_empresa= $_POST['id_empresa'];
        //Consultar si los datos son están guardados en la base de datos
        $consulta = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
       
    }

}

?>