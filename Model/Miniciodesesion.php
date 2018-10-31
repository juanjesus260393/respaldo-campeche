<?php

//Conexion a la base de datos
require_once('Conexion.php');

require_once('sendnewpass.php');

class obtener_usuario {

    //Se define la funcion para definir que tipo de usuario es
    public function tipo_usuario() {
        $tipodeusuario;
        //Se llama a la case conectar del archivo conexion.php
        $conn = new Conectar();
        $cone1 = $conn->con();
        $username = $_POST['username'];
        //perimo se consulta si el usuario se encuentra en la tabla authorities
        $consultaua = "SELECT * FROM authorities WHERE username='" . $username . "'";
        $resultado1 = mysqli_query($cone1, $consultaua) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultado1);
        //Si no existe un registro asociado a esa busqueda en tabla authorities
        if (!$fila1[0]) {
            //Se busca en la tabla usuario empresa
            $consultaue = "SELECT u.id_empresa, u.username, e.id_membresia, e.id_sector FROM usuario_empresa u inner join empresa e on u.id_empresa = e.id_empresa where u.username = '" . $username . "' group by u.id_empresa";
            $resultado2 = mysqli_query($cone1, $consultaue) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($resultado2);
            //Si no se encuentra en la tabla empresa ni en la tabla authorities se activa una alerta que regresa al usuario a la pagina de inicio
            if (!$fila2[0]) {
                $_SESSION['loggedin'] = FALSE;
                session_destroy();
                echo '<script language = javascript>
	alert("Verifique que el usuario se encuentre registrado.")
           self.location = "../index.php"
	</script>';
            } else {
                //Si se encuentra un registro en la busqueda de la tabla usuario empresa de regresa el identificador de la empresa
                //el nombre de usuario. el tipo de usuario y el identificador de la membresia
                $idempresa = $fila2['id_empresa'];
                $nombreusuario = $fila2['username'];
                $tipodeusuario = "empresa";
                $idmembresia = $fila2['id_membresia'];
                $sectoremp = $fila2['id_sector'];
            }
        }
        //Si el nombre de usuario existe en la tabla authorities
        else {
            //Se declara un arreglo con los elemmentos que se utilizaran  
            $idempresa = $fila1['authority'];
            $tipodeusuario = "administrador";
            $nombreusuario = $fila1['username'];
            $idmembresia = $fila1['username'];
            $sectoremp = $fila1['username'];
        }
        //Se define un arreglo el cuando tendra el nombre de usuario y tipo de usuario
        return array($nombreusuario, $tipodeusuario, $idempresa, $idmembresia, $sectoremp);
    }

    //Se define la funcion busquedad de usuario la cual se realiza el inicio de sesion para acceder al menu principal
    public function busquedad_usuario() {
        $conn = new Conectar();
        $pd = $conn->con();
        $username2 = $_POST['username'];
        $username = obtener_usuario::search_register($username2);
        $password = $_POST['password'];
        //Consulta que compara el nombre de usuario y la contraseña coinciden con lo definido en la tabla usuariios
        $consulta = "SELECT * FROM users WHERE username='" . $username . "'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila[0] || password_verify($password, $fila[1]) == FALSE) {
            $_SESSION['loggedin'] = FALSE;
            session_destroy();
            echo '<script language = javascript>    
	alert("Usuario o contraseña incorrectos, por favor verifique.")
	self.location = "../index.php"
	</script>';
        } else {
            //Si existe un registro que coincida con lo que se encuentra de la base de datos se llama a la funcion obtener usuario  el tipo de usuario
            //El identificador de la empresa etc.
            $obu = new obtener_usuario();
            list($un, $tp, $im, $imem, $SeCEmp) = $obu->tipo_usuario();
            $_SESSION['username'] = $un;
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['enabled'] = $fila['enabled'];
            $_SESSION['idemp'] = $im;
            $_SESSION['tipo'] = $tp;
            $_SESSION['id_membresia'] = $imem;
            $_SESSION['sectorEmp'] = $SeCEmp;
            echo '<script language = javascript>
                	alert(' . $_SESSION['username'] . ');
		</script>';
        }
        return array($tp, $im);
    }

    public static function search_register($username) {
        $conn = new Conectar();
        $pd = $conn->con();
        $consulta = "select u.username from users u where u.username = '$username' and u.enabled = '1'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            echo '<script language = javascript> alert("El usuario no se encuentra habilitado") </script>';
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        } else {
            $username = $fila['username'];
        }
        return $username;
    }

    public static function generate_password($userdb) {
        $cadena_base = $userdb;
        $cadena_base .= '0123456789';
        $cadena_base .= '@#%.@';
        $password = '';
        $limite = strlen($cadena_base) - 1;
        for ($i = 0; $i < 8; $i++) {
            $password .= $cadena_base[rand(0, $limite)];
        }
        return $password;
    }

    public static function update_cashier_register($userdb) {
        $conn = new Conectar();
        $pd = $conn->con();
        $newchain = obtener_usuario::generate_password($userdb);
        newpass::sendwapass($userdb, $newchain, 0);
        $newpass = password_hash($newchain, PASSWORD_DEFAULT);
        $updatepass = "UPDATE users u SET u.password = '$newpass' WHERE username='$userdb';";
        if (!mysqli_query($pd, $updatepass)) {
            die('Error: ' . mysqli_error($pd));
        } else {
            mysqli_close($pd);
            header("Location:../index.php");
        }
    }

    public function reset_pass() {
        $conn = new Conectar();
        $pd = $conn->con();
        $username = $_POST['usernamep'];
        $userdb = obtener_usuario::search_register($username);
        obtener_usuario::update_cashier_register($userdb);
    }

}
