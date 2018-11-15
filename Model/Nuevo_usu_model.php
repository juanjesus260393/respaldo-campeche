<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  Dar de alta un nuevo Usuario-Empresa
 * 
 * por Fabrica de Software, CIC-IPN
 */

include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

//Se declara la clase Nuevo_usu_model
class Nuevo_usu_model {

    private $db;
    private $sector;
    private $pas;

//constructor de la clase
    public function __construct() {
        $this->db = Conectar::con();
        $this->sector = array();
        $this->id = array();
        $this->idmembresia = array();
        $this->rango = array();
    }

//obtiene los sectores de la base de datos 
    public function get_sectores() {
//Sentencia SQL
        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");
//Php realiza la consulta a Maria DB
        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->sector[] = $filas;
        }

        $resultado->close();
        //$this->db->close();
//Devuelve el resultado
        return $this->sector;
    }

//obtiene los rangos de precios de la base de datos
    public function get_Rangos() {
//sentencia Sql
        $sqlconsultaRangos = ("SELECT R.id_rango_ventas, R.descripcion FROM rango_ventas R WHERE 1");
//Php realiza la consulta a Maria DB
        $resRangos = $this->db->query($sqlconsultaRangos);
        while ($filaR = $resRangos->fetch_row()) {
            $this->rango[] = $filaR;
        }

        $resRangos->close();
        //Devuelve el resultado
        return $this->rango;
    }

//Genera una contraseña aleatoria
    public function gen_pass($correo) {
        $cadena_base = $correo;
        $cadena_base .= '0123456789';
        $cadena_base .= '@#%.@';

        $password = '';
        $limite = strlen($cadena_base) - 1;

        for ($i = 0; $i < 8; $i++) {
            $password .= $cadena_base[rand(0, $limite)];
        }
        return $password;
    }

//Metodo o Función que dara de alta un nuevo usuario y empresa en el sistema y la base de datos
    public function add_usuario($a) {

        $pathlogo = "../Imagenes/Sitios/logo/";
        $valid_formatsimg = array("jpg");

        $id_logo = $_FILES['idlogo']['name'];


//se declara la ruta y el nombre para el manejo de la imagen de logo
        $fileInfoLogo = pathinfo($id_logo);
        $extLogo = $fileInfoLogo['extension'];
        if (in_array($extLogo, $valid_formatsimg)) {
            $aux = random_bytes(12);
            $actual_logo_name = substr(bin2hex($aux), 0, 12);

            //$a = str_split($aux);
            $tmp2 = $_FILES['idlogo']['tmp_name'];
            if (move_uploaded_file($tmp2, $pathlogo . $actual_logo_name . "." . $extLogo)) {

                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Sitios/logo/" . $actual_logo_name . "." . $extLogo;
                $getID3 = new getID3;
                $file = $getID3->analyze($filename);
                //Una ves que se yha subido se comprueba la resolucion del mismo
                if ($file['video']['resolution_x'] > 120 && $file['video']['resolution_y'] > 120) {
                    //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior

                    unlink($filename);
                    echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño 120x120") </script>';
                    //Regresamos a la pagina anterior
                    echo "<html><head></head>" .
                    "<body onload=\"javascript:history.back()\">" .
                    "</body></html>";
                    exit;
                }
            } else {
                echo "failed Logo";
            }
        }

//Se declaran las variables y se reciben los valores del formulario
        $email = $_POST['email'];
        $nombre = $_POST['empresa'];
        $sector = (int) $_POST['sectores'];
        $precios = (int) $_POST['rangos'];
        $tel1 = (int) $_POST['tel1'];
        if (isset($_POST['tel2'])) {
            $tel2 = (int) $_POST['tel2'];
        } else {
            $tel2 = "";
        }
        if (isset($_POST['tel2'])) {
            $cel = (int) $_POST['cel'];
        } else {
            $cel = "";
        }
        $dir = htmlspecialchars($_POST['dir']);
        if (isset($_POST['propietario'])) {
            $owner = $_POST['propietario'];
        } else {
            $owner = '';
        }
        if (isset($_POST['numempleados'])) {
            $numE = (int) $_POST['numempleados'];
        } else {
            $numE = '';
        }

        if (isset($_POST['facebook'])) {
            $facebook = $_POST['facebook'];
        } else {
            $facebook = '';
        }

        if (isset($_POST['twitter'])) {
            $twitter = $_POST['twitter'];
        } else {
            $twitter = '';
        }

        if (isset($_POST['instagram'])) {
            $instagram = $_POST['instagram'];
        } else {
            $instagram = '';
        }

        if (isset($_POST['youtube'])) {
            $youtube = $_POST['youtube'];
        } else {
            $youtube = '';
        }

        if (isset($_POST['googleplus'])) {
            $google = $_POST['googleplus'];
        } else {
            $google = '';
        }

        if (isset($_POST['tam'])) {

            $tamaux = $_POST['tam'];

            switch ($tamaux) {
                case '1':
                    $tamano = 'Micro Empresa';
                    break;
                case '2':
                    $tamano = 'Pequeña Empresa';
                    break;
                case '3':
                    $tamano = 'Mediana Empresa';
                    break;
                case '4':
                    $tamano = 'Gran Empresa';
                    break;
                case '5':
                    $tamano = 'Sin Especificar';
                    break;
            }
        } else {
            $tamano = '';
        }

        $desc = htmlspecialchars($_POST['desc']);

        $membresia = $_POST['membresia'];

        if ($a == 1) {
            $fechafin = $_POST['fechafin'];
        } else {
            $fechafin = "0000-00-00";
        }
//Se genera la contraseña aleatoria para el nuevo Usuario
        $passaux = $this->gen_pass($email);
        sendmail($email, $passaux, 0);
        $pass = password_hash($passaux, PASSWORD_DEFAULT);

        date_default_timezone_set('America/Mexico_City');

        $fecalta = date("Y-m-d H:i:s");
        $fechainicio = date("Y-m-d H:i:s");
     //Sentencias Sql para el alta de Usuario-Empresa 
        $sqlAuxMembresia = ("SELECT p.id_membresia FROM membresia p WHERE p.nombre='" . $membresia . "'");
        $Mres = $this->db->query($sqlAuxMembresia);
        $idmembresia = $Mres->fetch_row();
        //Sentencias Sql para el alta de Usuario-Empresa
        $sqlinsert1 = ("INSERT INTO users (username, password) VALUES ('" . $email . "','" . $pass . "')");
        $agregado = $this->db->query($sqlinsert1);
        if ($agregado) {
//Sentencias Sql para el alta de Usuario-Empresa
            $sqlinsert = ("INSERT INTO empresa (id_membresia, id_sector, id_rango_ventas, descripcion, telefono, extension,celular, "
                    . "direccion, nombre, numero_empleados, propietario, tamano, facebook, twitter, instagram, youtube, googleplus, id_logo, fecha_alta, fecha_inicio_membresia, fecha_fin_membresia) "
                    . "VALUES (" . $idmembresia[0] . "," . $sector . "," . $precios . ",'" . $desc . "'," . $tel1 . "," . $tel2 . ","
                    . $cel . ",'" . $dir . "','" . $nombre . "'," . $numE . ",'" . $owner . "','" . $tamano . "'"
                    . ",'" . $facebook . "','" . $twitter . "','" . $instagram . "','" . $youtube . "','" . $google . "', '" . $actual_logo_name . "', '" . $fecalta . "', '" . $fechainicio . "', '" . $fechafin . "')");


            $agregado = $this->db->query($sqlinsert);
            if ($agregado) {
//Sentencias Sql para el alta de Usuario-Empresa
                $sqlconsultaAux = ("SELECT id_empresa FROM empresa WHERE nombre='" . $nombre . "' AND propietario='" . $owner . "'");
                $res = $this->db->query($sqlconsultaAux);
                $id = $res->fetch_row();
//Sentencias Sql para el alta de Usuario-Empresa
                $sqlinsertAux = ("INSERT INTO usuario_empresa (id_empresa, username) VALUES (" . $id[0] . ", '" . $email . "')");
                $agregadoAux = $this->db->query($sqlinsertAux);
                if ($agregadoAux) {
                    //Si todo esta correcto manda mensaje
                    echo ("<script> alert('Nuevo usuario agregado'); </script>");
                } else {
                    printf("Errormessage: %s\n", $this->db->error);
                }
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        } else {
            printf("Errormessage: %s\n", $this->db->error);
        }

        return $email;
    }
//Habilita el usuario que se acaba de dar de alta
    public function habilitando($usu) {
        if (isset($usu)) {
            $sqlupdate = ("UPDATE users SET enabled = '1' WHERE users.username = '" . $usu . "'");
            $update = $this->db->query($sqlupdate);
            if ($update) {
                
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        }
    }

}
