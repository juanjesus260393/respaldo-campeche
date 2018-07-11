<?php

require_once('model.php');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

Class Turista extends model {

    function __construct() {
        $this->LlavePrimaria = ['token'];
        $this->NombreDeTabla = 'token';
        $this->indices = [];
        $this->columnas = array(
            'token' => null,
            'username' => null,
            'vigencia' => null);
    }

    public function login($username, $token) {
        $str = "token = '$token' AND username = '$username'";
        //Se imprime la consulta en la tabla token y se obtienen los elementos que necesitamos de esta tabla: token, username, vigencia.
        //$this->SeleccionarVistas($str,$username);
        print_r($this->SeleccionarVistas($str, $username));
        return count($this->Seleccionar($str)) > 0 ? true : false;
    }

    public function login_movil($username, $password) {
        //Se llama a la funcion conectar
        $conn = new Conectar();
        $pd = $conn->con();
        //se define token y el usuario
        $token = bin2hex(openssl_random_pseudo_bytes (64));
        $vigencia = date('H:i:s', (strtotime("+ 1 Hours")));
        $consultausers = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
        $resultadoconsultausers = mysqli_query($pd, $consultausers) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultadoconsultausers);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila[0]) {
            return null;
        } else {
            $nombredeusuario = $fila['username'];
        }
        //se define el tipo de usuario
        $consultatoken = "SELECT * FROM token WHERE username='" . $nombredeusuario . "'";
        $resultadoconsultatoken = mysqli_query($pd, $consultatoken) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultadoconsultatoken);
        //Si el nombre de usuario no existe en la tabla authorities
        if (!$fila1[0]) {
            //Se busca en la tabla usuario_empresa
            $consultausuarioempresa = "SELECT * FROM usuario_empresa WHERE username='" . $nombredeusuario . "'";
            $resultadoconsultausuarioempresa = mysqli_query($pd, $consultausuarioempresa) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($resultadoconsultausuarioempresa);
            //Si no se encuentra en la tabla empresa ni en la tabla authorities
            if (!$fila2[0]) {
                die(mysqli_error());
            }
            //opcion2: El usuario es un cajero
            else {
                $idempresa = $fila2['id_empresa'];
                $nombreusuario = $fila2['username'];
                $tipodeusuario = "C";
                //pasar parametros al token
                $respuesta['token'] = $token;
                $respuesta['tipo_de_usuario'] = $tipodeusuario;
                $respuesta['vigencia'] = $vigencia;
            }
        } else {
            //el usuario es un turista
            $idempresa = $fila1['vigencia'];
            $tipodeusuario = "T";
            $nombreusuario = $fila1['username'];
            //Pasar parametros a arreglo
            $respuesta['token'] = $token;
            $respuesta['tipo_de_usuario'] = $tipodeusuario;
            $respuesta['vigencia'] = $vigencia;
        }
        return json_encode($respuesta);
    }

}