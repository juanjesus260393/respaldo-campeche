<?php

require_once('model.php');
require_once('Conexion.php');

Class Turista extends model {
    
    function __construct() {
        $this->LlavePrimaria = ['username'];
        $this->NombreDeTabla = 'users';
        $this->indices = [];
        $this->columnas = array(
            'username' => null,
            'password' => null,
            'enabled' => null);
    }

    public function login($username, $password) {
        $str = "username='$username' AND password = '$password'";
        $mutbl = NULL;
        print_r($this->Seleccionar($str));
         return count($this->Seleccionar($str)) > 0 ? true:false;
    }

    public function buscar_turista($username, $password) {
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $aux = $conn->con();
        $consultaturista = mysqli_prepare($aux, "SELECT t.username, u.enabled FROM users u inner join turista t  on t.username = ? and u.password = ? group by t.username;");
        mysqli_stmt_bind_param($consultaturista, "ss", $username, $password);
        mysqli_stmt_execute($consultaturista);
        mysqli_stmt_store_result($consultaturista);
        mysqli_stmt_bind_result($consultaturista, $username, $enabled);
        $response = array();
        $response["success"] = false;

        while (mysqli_stmt_fetch($consultaturista)) {
            $response["success"] = true;
            $response["t.username"] = $username;
            $response["u.enabled"] = $enabled;
        }
        echo json_encode($response);
    }

}
