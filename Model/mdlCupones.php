<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');
include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

class obtener_cupon {

    private $platillo;
    private $dbh;
    private $platillo2;
    private $platillo3;

    public function __construct() {
        $this->dbh = Conectar::con();
    }

    public function lista_cupones() {
        $fa = date('Y-m-d');
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select c.id_cupon, c.id_revision_objeto, c.titulo, c.descripcion_corta, c.descripcion_larga, c.id_imagen_extra, c.id_imagen_vista_previa,c.vigencia_fin, c.terminos_y_condiciones, c.limite_codigos, revision_objeto.status from (cupon c inner join revision_objeto on c.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " where c.vigencia_fin > '$fa' group by titulo;";
        if (empty($this->dbh->query($sql))) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }

        return $this->platillo;
    }

    public function lista_cupones2() {
        $fa = date('Y-m-d');
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select c.id_cupon, c.id_revision_objeto, c.titulo, c.descripcion_corta, c.descripcion_larga, c.id_imagen_extra, c.id_imagen_vista_previa,c.vigencia_fin, c.terminos_y_condiciones, c.limite_codigos, revision_objeto.status from (cupon c inner join revision_objeto on c.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " where c.vigencia_fin <= '$fa' group by titulo;";
        if (empty($this->dbh->query($sql))) {
            $this->platillo2[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo2[] = $res;
            }
        }
        return $this->platillo2;
    }

    public function lista_cupones_caducados() {
        $fa = date('Y-m-d');
        $ftma = strtotime('+5 day', strtotime($fa));
        $ftm = date('Y-m-d', $ftma);
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "SELECT c.titulo, c.vigencia_fin FROM cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
inner join empresa e on r.id_empresa = e.id_empresa inner join usuario_empresa u on e.id_membresia = u.id_empresa where
c.vigencia_fin = '$ftm' group by c.titulo;";

        if (empty($this->dbh->query($sql))) {
            $this->platillo3[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo3[] = $res;
            }
        }
        return $this->platillo3;
    }

    public function obtener_codigos() {
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select * from revision_objeto";
        if (empty($this->dbh->query($sql))) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        return $this->platillo;
    }

    public function registrar_cupon() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se genera el identificador de la revision del objeto
        $na = new validacion();
        $idro = $na->generar_aleatorio();
        $iie = $na->generar_alfanumerico();
        $iive = $na->generar_alfanumerico();
        //Fecha de creacion y hora 
        $fa = $na->fecha_actual();
        $status = 'C';
        $sql = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,fecha_actualizacion,status)
        VALUES('$idro'," . $_SESSION['idemp'] . ",'$fa','0000-00-00','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        //A su vez se realiza la insersion en la tabla cupon
        //Se reciben los parametros de la vista de registros
        $titulo = $_POST['titulo'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $descripcion_larga = $_POST['descripcion_larga'];
        //Ruta donde se guardaran las imagenes de los cupones
        $nombreimagen = $_FILES['id_imagen_extra']['name'];
        $nombreimagen = $iie . ".jpg";
        if (move_uploaded_file($_FILES['id_imagen_extra']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen";
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1280 && $file['video']['resolution_y'] > 720) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                unlink($ruta . $nombreimagen);
                echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
        } else {
            $nombreimagen = "";
        }
        $nombres = $nombreimagen;
        $nombreimagen2 = $_FILES['id_imagen_vista_previa']['name'];
        $nombreimagen2 = $iive . ".jpg";
        if (move_uploaded_file($_FILES['id_imagen_vista_previa']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen2")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen2";
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1280 && $file['video']['resolution_y'] > 720) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                unlink($ruta . $nombreimagen2);
                echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
        } else {
            $nombreimagen2 = "";
        }
        $nombres2 = $nombreimagen2;
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fin = $_POST['vigencia_fin'];
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        $limite_codigos = $_POST['limite_codigos'];
        //Se genera el identificador del cupon
        $idcu = $na->generar_aleatorio();
        $sql2 = "INSERT INTO cupon (id_cupon,id_revision_objeto,titulo,descripcion_corta,descripcion_larga,id_imagen_vista_previa,id_imagen_extra,vigencia_inicio,vigencia_fin,terminos_y_condiciones,limite_codigos)
        VALUES('$idcu','$idro','$titulo','$descripcion_corta','$descripcion_larga','$nombres2','$nombres','$vigencia_inicio','$vigencia_fin','$terminos_y_condiciones','$limite_codigos')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/crtCupones.php");
    }

    public function buscarcodigoqr($idcupon) {
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select id_cupon from codigo_qr where id_cupon = '$idcupon'";
        if (empty($this->dbh->query($sql))) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        return $this->platillo;
    }

    public function eliminar_cupon() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        //Si el registro esta vacio regresar a la vista de los cupones

        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_cupon = $_GET["id_cupon"];
        if ($id_revision_objeto == NULL && $id_cupon == NULL) {
            echo '<script language = javascript> alert("No es un elemento valido de los cupones") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
        }
        $imagen = $_GET["id_imagen_extra"];
        $imagen2 = $_GET["id_imagen_vista_previa"];
        //primero buscar en la tabla codigo qr
        $c = new obtener_cupon();
        $cqr = $c->buscarcodigoqr($id_cupon);
        if ($cqr == NULL) {
            $Eliminar = "Delete from revision_objeto where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = '" . $_SESSION['idemp'] . "'";
            $Eliminar2 = "Delete from cupon where id_cupon = " . $id_cupon . " and id_revision_objeto = " . $id_revision_objeto . "";
            if (!mysqli_query($pd, $Eliminar2)) {
                die('Error: ' . mysqli_error($pd));
            }
            if (!mysqli_query($pd, $Eliminar)) {
                die('Error: ' . mysqli_error($pd));
            }
            if ($imagen == "") {
                mysqli_close($pd);
                header("Location:https://localhost/campeche-web2/Controller/IniciodeSesion.php");
            } else {
                //Se elimina la imagen 
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                unlink($ruta . $imagen);
                mysqli_close($pd);
                header("Location:https://localhost/campeche-web2/Controller/IniciodeSesion.php");
            }
            if ($imagen2 == "") {
                mysqli_close($pd);
                header("Location:https://localhost/campeche-web2/Controller/IniciodeSesion.php");
            } else {
                //Se elimina la imagen 
                $ruta2 = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                unlink($ruta2 . $imagen2);
                mysqli_close($pd);
                header("Location:https://localhost/campeche-web2/Controller/IniciodeSesion.php");
            }
        } else {
            echo '<script language = javascript> alert("Este cupon ya tiene codigos Qr generados, no se puede eliminar") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        }
    }

    public function buscar_cupon() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_cupon = $_POST['id_cupon'];
        $consulta = "SELECT * FROM cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto WHERE c.id_cupon = '$id_cupon' and r.status = 'C' or r.status = 'R';";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            echo '<script language = javascript>
	alert("Este cupon al estar aprobado no puede ser Modificado")
           self.location = "https://localhost/campeche-web2/Controller/crtCupones.php"
	</script>';
        } else {
            $id_cupon = $fila['id_cupon'];
            $id_revision_objeto = $fila['id_revision_objeto'];
            $titulo = $fila['titulo'];
            $descripcion_corta = $fila['descripcion_corta'];
            $descripcion_larga = $fila['descripcion_larga'];
            $id_imagen_extra = $fila['id_imagen_extra'];
            $id_imagen_vista_previa = $fila['id_imagen_vista_previa'];
            $terminos_y_condiciones = $fila['terminos_y_condiciones'];
            $limite_codigos = $fila['limite_codigos'];
        }
        return array($id_cupon, $id_revision_objeto, $titulo, $descripcion_corta, $descripcion_larga, $id_imagen_extra, $id_imagen_vista_previa, $terminos_y_condiciones, $limite_codigos);
    }

    public function actualizar_cupon() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se reciben los parametros de la vista actualizar cupon
        //se compara si el parametro id_imagen_ extra esta regresando vacia
        $na = new validacion();
        $iie = $na->generar_alfanumerico();
        $iip = $na->generar_alfanumerico();
        $nombreimagen = $_FILES['id_imagen_vista_previa']['name'];
        $nombreanterior = $_POST["id_imagen_anterior"];
        if ($nombreimagen == "") {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
            unlink($ruta . $nombreanterior);
        } else {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
            unlink($ruta . $nombreanterior);
            $nombreimagen = $_FILES['id_imagen_vista_previa']['name'];
            $nombreimagen = $iie . ".jpg";
            if (move_uploaded_file($_FILES['id_imagen_vista_previa']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen")) {
                $msg = "El archivo ha sido cargado correctamente.<br>";
            } else {
                die();
            }
        }
        $nombreimagen2 = $_FILES['id_imagen_extra']['name'];
        $nombreanterior2 = $_POST["id_imagen_anterior2"];
        if ($nombreimagen2 == "") {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
            unlink($ruta . $nombreanterior2);
        } else {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
            unlink($ruta . $nombreanterior2);
            $nombreimagen2 = $_FILES['id_imagen_extra']['name'];
            $nombreimagen2 = $iip . ".jpg";
            if (move_uploaded_file($_FILES['id_imagen_extra']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen2")) {
                $msg = "El archivo ha sido cargado correctamente.<br>";
            } else {
                die();
            }
        }
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_cupon = $_POST["id_cupon"];
        $titulo = $_POST['titulo'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $descripcion_larga = $_POST['descripcion_larga'];
        //Fecha actual
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fin = $_POST['vigencia_fin'];
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        $nombre = $nombreimagen;
        $nombre2 = $nombreimagen2;
        $limite_codigos = $_POST['limite_codigos'];
        $actulizacion1 = "update revision_objeto set fecha_actualizacion = " . $fecha_actual . "  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actulizacion2 = "update cupon set titulo = '$titulo', descripcion_corta = '$descripcion_corta', descripcion_larga = '$descripcion_larga', id_imagen_vista_previa = '$nombre' , id_imagen_extra = '$nombre2',vigencia_inicio = '$vigencia_inicio',vigencia_fin = '$vigencia_fin' , terminos_y_condiciones =  '$terminos_y_condiciones' , limite_codigos =  '$limite_codigos' where id_cupon = " . $id_cupon . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/crtCupones.php");
    }

}

?>