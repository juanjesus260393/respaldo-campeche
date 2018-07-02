<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');

class obtener_usuario {

    //Se define la funcion administrador esto para definir cual de los usuarios es adminitrador
    public function tipo_usuario() {
        $tipodeusuario;
        //Se llama a la case conectar del archivo conexion.php
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        //la conexion se guardara en la varible cone1
        $cone1 = $conn->con();
        //Se recibe el nombre de usuario del formulario de inicio de sesion
        $username = $_POST['username'];
        //Consultar si el usuario se encuentra en la tabla authorities
        $consultaua = "SELECT * FROM authorities WHERE username='" . $username . "'";
        $resultado1 = mysqli_query($cone1, $consultaua) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultado1);
        //Si el nombre de usuario no existe en la tabla authorities
        if (!$fila1[0]) {
            //Se busca en la tabla empresa
            $consultaue = "SELECT * FROM usuario_empresa WHERE username='" . $username . "'";
            $resultado2 = mysqli_query($cone1, $consultaue) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($resultado2);
            //Si no se encuentra en la tabla empresa ni en la tabla authorities
            if (!$fila2[0]) {
                echo '<script language = javascript>
	alert("Verifique que el usuario se encuentre registrado.")
	self.location = "https://localhost/campeche-web2"
	</script>';
            }
            //opcion2: El usuario es una empresa
            else {
                
                //Se crea una variable auxiliar a la cual se le asignara el nombre de usuario 
                //para que el controlador la muestre en el menu principal
                //Identificador de la empresa que se utilizara para las operaciones de la empresa con losm sitios que tiene
                $idempresa = $fila2['id_empresa'];
                $nombreusuario = $fila2['username'];
                $tipodeusuario = "empresa";   
            }
        }
        //Si el nombre de usuario existe en la tabla authorities
        else {
            //Se declara un arreglo con los 2 elemmentos que se utilizaran 
            $idempresa = $fila1['authority'];
            $tipodeusuario = "administrador";
            $nombreusuario = $fila1['username'];
        }
        //Se define un arreglo el cuando tendra el nombre de usuario y tipo de usuario
        return array($nombreusuario, $tipodeusuario, $idempresa);
    }

    //Se define la funcion busquedad de usuario la cual realiza el inicio de sesion para acceder al menu principal
    public function busquedad_usuario() {
        //Se llama a la case conectar del archivo conexion.php
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se llama a la clase obtener usuario 
        $obu = new obtener_usuario();
        //Se recibe el array de la funcion admin_usuario
        list($un, $tp, $im) = $obu->tipo_usuario();
        $username = $un;
        //Se recibe la contrasela del formulario inicio de sesion
        $password = $_POST['password'];
        //Consultar si los datos son están guardados en la base de datos
        $consulta = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila[0]) {
            echo '<script language = javascript>
	alert("Usuario o contraseña incorrectos, por favor verifique.")
	self.location = "https://localhost/campeche-web2"
	</script>';
        }
        //opcion2: El usuario ha iniciado sesion correctamente
        else {
            $habilitada = $fila['enabled'];
        }
        return array($un, $tp, $im,$habilitada);
    }

}

?>