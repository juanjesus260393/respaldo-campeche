<?php

include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

class set_usu_model2 {

    private $db;
    private $sector;
    private $pas;
    private $empresas;

    public function __construct() {
        $this->db = Conectar::con();
        $this->sector = array();
        $this->id = array();
        $this->empresas = array();
    }

    public function get_sectores() {

        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->sector[] = $filas;
        }

        $resultado->close();
        //$this->db->close();

        return $this->sector;
    }

    public function get_Rangos() {

        $sqlconsultaRangos = ("SELECT R.id_rango_ventas, R.descripcion FROM rango_ventas R WHERE 1");

        $resRangos = $this->db->query($sqlconsultaRangos);
        while ($filaR = $resRangos->fetch_row()) {
            $this->rango[] = $filaR;
        }

        $resRangos->close();
        //$this->db->close();

        return $this->rango;
    }

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

    public function add_usuario($idEU, $usubfset) {
        $imglogoA = $_POST['logoA'];
        $pathlogo = "../Imagenes/Sitios/logo/";
        $valid_formatsimg = array("jpg");
        $id_logo = $_FILES['idlogoSet']['name'];
        if ($_FILES['idlogoSet']['error'] === 4) {

            $actual_logo_name = $imglogoA;
        } else {

            $fileInfoLogo = pathinfo($id_logo);
            $extLogo = $fileInfoLogo['extension'];
            if (in_array($extLogo, $valid_formatsimg)) {
                $aux = random_bytes(12);
                $actual_logo_name = substr(bin2hex($aux), 0, 12);

                //$a = str_split($aux);
                $tmp2 = $_FILES['idlogoSet']['tmp_name'];
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
        }

        $email = $_POST['email'];
        $nombre = $_POST['empresa'];
        $sector = (int) $_POST['sectores'];
        $precios = (int) $_POST['rangos'];
        $tel1 = (int) $_POST['tel1'];
        if (isset($_POST['tel2'])) {
            $tel2 = (int) $_POST['tel2'];
        } else {
            $tel2 = "0";
        }
        if (isset($_POST['tel2'])) {
            $cel = (int) $_POST['cel'];
        } else {
            $cel = "0";
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
            
            $tamaux =$_POST['tam'];
            switch ($tamaux){
                case '1':
                    $tamano='Micro Empresa';
                    break;
                case '2':
                    $tamano='Pequeña Empresa';
                    break;
                case '3':
                    $tamano='Mediana Empresa';
                    break;
                case '4':
                    $tamano='Gran Empresa';
                    break;
                case '5':
                    $tamano='Sin Especificar';
                    break;
                default :
                    $tamano=$_POST['tam'];
            }
        } else {
            $tamano = '';
        }
        $desc = htmlspecialchars($_POST['desc']);

        $membresia = $_POST['membresia'];

        if ($_POST['fechafin'] == '') {
            $fechafin = $_POST['fecdefault'];
        } else {
            $fechafin = $_POST['fechafin'];
        }


        $sqlAuxMembresia = ("SELECT m.id_membresia FROM membresia m WHERE m.nombre='" . $membresia . "'");
        $Mres = $this->db->query($sqlAuxMembresia);
        $idmembresia = $Mres->fetch_row();




        if ($usubfset == $email) {
            $agregado = 1;
        } else {
            $sqlinsert1 = ("UPDATE users SET username='" . $email . "' WHERE username='" . $usubfset . "'");
            $agregado = $this->db->query($sqlinsert1);
        }
        if ($agregado) {
            $sqlinsert = ("UPDATE empresa SET id_membresia=" . $idmembresia[0] . ", id_sector=" . $sector . ", id_rango_ventas=" . $precios
                    . ", descripcion='" . $desc . "', telefono=" . $tel1 . ", extension=" . $tel2 . ", celular=" . $cel . ", direccion='" . $dir . "', "
                    . "nombre='" . $nombre . "', numero_empleados=" . $numE . ", propietario='" . $owner . "', tamano=" . $tamano . ", "
                    . "facebook='" . $facebook . "', twitter='" . $twitter . "', instagram='" . $instagram . "', youtube='" . $youtube . "', "
                    . "googleplus='" . $google . "', id_logo='" . $actual_logo_name . "', fecha_fin_membresia='" . $fechafin . "' "
                    . " WHERE id_empresa=" . $idEU . "");
            $agregado = $this->db->query($sqlinsert);
            if ($agregado) {
                unlink($pathlogo . $imglogoA);
                $sqlconsultaAux = ("SELECT id_empresa FROM empresa WHERE nombre='" . $nombre . "' AND propietario='" . $owner . "'");
                $res = $this->db->query($sqlconsultaAux);
                $id = $res->fetch_row();

                //$sqlinsertAux=("INSERT INTO usuario_empresa (id_empresa, username) VALUES (".$id[0].", '".$email."')");
                // $agregadoAux=$this->db->query($sqlinsertAux);  
                /* $agregadoAuX=1;
                  if($agregadoAux){
                  echo ("<script> alert('Usuario modificado con Exito'); </script>");

                  }else{ printf("Errormessage1: %s\n", $this->db->error);} */
            } else {
                printf("Errormessage2: %s\n", $this->db->error);
            }
        } else {
            printf("Errormessage3: %s\n", $this->db->error);
        }

        return $email;
    }

    public function get_empresas($usu_set) {

        $sqlconsulta = ("SELECT U.username, E.nombre, S.id_sector, S.nombre, E.telefono, E.extension, E.celular, E.direccion, "
                . "E.propietario, E.numero_empleados, E.descripcion, E.tamano, U.enabled, EU.id_empresa, "
                . "RV.id_rango_ventas, RV.descripcion, M.id_membresia, M.nombre, E.facebook, E.twitter, E.instagram, E.youtube, E.googleplus, E.id_logo, date(E.fecha_fin_membresia) "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username "
                . "INNER JOIN rango_ventas RV ON E.id_rango_ventas=RV.id_rango_ventas "
                . "INNER JOIN membresia M ON E.id_membresia=M.id_membresia "
                . "WHERE EU.username='" . $usu_set . "'");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->empresas[] = $filas;
        }

        $resultado->close();
        // $this->db->close();

        return $this->empresas;
    }

    public function habilitando($usu) {
        if (isset($usu)) {
            $sqlupdate = ("UPDATE users SET enabled = '1' WHERE users.username = '" . $usu . "'");
            $update = $this->db->query($sqlupdate);
            if ($update) {

                echo ("<script> alert('Usuario modificado con Exito'); location.href ='../Controller/Emp_Activas_controller.php';</script>");
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        }
    }

    public function deshabilitando($usu) {
        if (isset($usu)) {
            $sqlupdate = ("UPDATE users SET enabled = NULL WHERE users.username = '" . $usu . "'");
            $update = $this->db->query($sqlupdate);
            if ($update) {
                echo ("<script> alert('Usuario modificado con Exito'); location.href ='../Controller/Emp_Activas_controller.php';</script>");
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        }
    }

}
