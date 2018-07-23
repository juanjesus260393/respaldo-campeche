<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class FlyeryBanner {

    private $platillo;
    private $dbh;

    public function lista_flyersybanners() {
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;";
        if (empty($this->dbh->query($sql))) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        return $this->platillo;
    }

    public function registrar_publicidad() {
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        $idro = $na->generar_aleatorio();
        $iie = $na->generar_alfanumerico();
        $fa = $na->fecha_actual();
        $status = 'C';
        $sql = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,status)
        VALUES('$idro'," . $_SESSION['idemp'] . ",'$fa','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        $tipo = $_POST['contact'];
        $nombreimagen = $_FILES['id_img']['name'];
        $nombreimagen = $iie . ".jpg";
        if (move_uploaded_file($_FILES['id_img']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagen")) {
            echo $msg = "El archivo ha sido cargado correctamente.<br>";
        } else {
            echo $msg = "El archivo no ha sido cargado correctamente.<br>";
            $nombreimagen = "";
        }
        $nombres = $nombreimagen;
        $this->visualizaciones = '0.0';
        $idad = $na->generar_aleatorio();
        $sql2 = "INSERT INTO ad (id_ad,id_revision_objeto,tipo,id_img,visualizaciones)
        VALUES('$idad','$idro','$tipo','$nombres','$this->visualizaciones')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
    }

    public function eliminar_publicidad() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_ad = $_GET["id_ad"];
        $imagen = $_GET["id_img"];
        $Eliminar = "Delete from revision_objeto where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = '" . $_SESSION['idemp'] . "'";
        $Eliminar2 = "Delete from ad where id_ad = " . $id_ad . " and id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $Eliminar2)) {
            die('Error: ' . mysqli_error($pd));
        }
        if (!mysqli_query($pd, $Eliminar)) {
            die('Error: ' . mysqli_error($pd));
        }
        if ($imagen == "") {
            mysqli_close($pd);
            header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
        } else {
            //Se elimina la imagen 
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
            unlink($ruta . $imagen);
            mysqli_close($pd);
            header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
        }
    }

    public function buscar_publicidad() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_ad = $_POST['id_ad'];
        $consulta = "SELECT * FROM ad WHERE id_ad = '$id_ad'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            echo '<script language = javascript>
	alert("Esta publicidad no se puede modificar")
           self.location = "https://localhost/campeche-web2/Controller/crtcFlyers.php"
	</script>';
        } else {
            $id_ad = $fila['id_ad'];
            $id_revision_objeto = $fila['id_revision_objeto'];
            $tipo = $fila['tipo'];
            $id_img = $fila['id_img'];
        }
        return array($id_ad, $id_revision_objeto, $tipo, $id_img);
    }

    public function actualizar_publicidad() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se reciben los parametros de la vista actualizar cupon
        //se compara si el parametro id_imagen_ extra esta regresando vacia
        $na = new validacion();
        $iie = $na->generar_alfanumerico();
        $tipo = $_POST['contact'];
        $nombreimagen = $_FILES['id_img']['name'];
        $nombreanterior = $_POST["idimagenanterior"];
        if ($nombreimagen == "") {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
            unlink($ruta . $nombreanterior);
        } else {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
            unlink($ruta . $nombreanterior);
            $nombreimagen = $_FILES['id_img']['name'];
            $nombreimagen = $iie . ".jpg";
            if (move_uploaded_file($_FILES['id_img']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagen")) {
                $msg = "El archivo ha sido cargado correctamente.<br>";
            } else {
                die();
            }
        }
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_ad = $_POST["id_ad"];
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;
        $actulizacion1 = "update revision_objeto set fecha_actualizacion = " . $fecha_actual . "  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actulizacion2 = "update ad set tipo = '$tipo', id_img = '$nombreimagen' where id_ad = " . $id_ad . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
    }

}
