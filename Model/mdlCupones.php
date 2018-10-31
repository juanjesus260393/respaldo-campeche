<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');
include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

//Modelo que se encarga de gestionar los cupones de una empresa
class obtener_cupon {

    private $platillo;
    private $dbh;
    private $platillo2;
    private $platillo3;

    public function __construct() {
        $this->dbh = Conectar::con();
    }

//Funcion que obtiene los cupones que todavia se encuentran activos
    public function lista_cupones() {
        $fa = date('Y-m-d');
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

//Funcion que obtiene los cupones que ya han caducado
    public function lista_cupones2() {
        $fa = date('Y-m-d');
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

//Funcion que obtiene los cupones que caducaran en 5 dias
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

//Funcion que obtiene los codigos de los objetos creados
    public function obtener_codigos() {
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

//Funcion que se encarga de registrar los cupones de una empresa
    public function registrar_cupon() {
        $conn = new Conectar();
        $pd = $conn->con();
        //Se generan los identificadores de los cupones y la revision de objeto
        $na = new validacion();
        $idro = $na->generar_aleatorio();
        $iive = $na->generar_alfanumerico();
        $fa = $na->fecha_actual();
        //Se obtien los elementos de la vista registrar cupon
        $titulo = $_POST['titulo'];
        $newtitulo = addslashes($titulo);
        $limite_codigos = $_POST['limite_codigos'];
        //Validacion en caso que los codigos sean iguales a cero
        if ($limite_codigos == 0) {
            echo '<script language = javascript> alert("El limite de codigos no puede ser cero tiene que ser mayor a uno") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        }
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fin = $_POST['vigencia_fin'];
        //Validacion para que las vigencias de inicio y fin no coincidan
        if ($vigencia_inicio > $vigencia_fin) {
            echo '<script language = javascript> alert("La vigencia de inicio no puede ser mayor a la vigencia final") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        }
        //Validacion para que las vigencias de inicio y fin no coincidan
        if ($vigencia_fin < $vigencia_inicio) {
            echo '<script language = javascript> alert("La vigencia final no puede ser menor a la vigencia de inicio") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        }
        //Validacion para que las vigencias final no sea igual a la fecha actual
        if ($vigencia_fin < $fa) {
            echo '<script language = javascript> alert("La vigencia final no puede ser menor a la fecha actual") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        }
        $descripcion_corta = $_POST['descripcion_corta'];
        $newdc = addslashes($descripcion_corta);
        $descripcion_larga = $_POST['descripcion_larga'];
        $newdl = addslashes($descripcion_larga);
        $nombreimagen2 = $_FILES['id_imagen_vista_previa']['name'];
        $nombreimagen2 = $iive . ".jpg";
        //Validacion para la resolucion de las imagenes del cupon
        if (move_uploaded_file($_FILES['id_imagen_vista_previa']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen2")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen2";
            //Libreria utilizada para la validacion de la resolucion de la imagen
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 120 && $file['video']['resolution_y'] > 120) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                unlink($ruta . $nombreimagen2);
                echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
        }
        $nombres2 = $nombreimagen2;
        $nombreimagen = $_FILES['id_imagen_extra']['name'];
        if ($nombreimagen == null) {
            $iie = '';
        } else {
            $iie = $na->generar_alfanumerico();
            $nombreimagen = $iie . ".jpg";
            //Validacion para la resolucion de las imagenes del cupon
            if (move_uploaded_file($_FILES['id_imagen_extra']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen")) {
                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen";
                //Libreria utilizada para la validacion de la resolucion de la imagen
                $getID3 = new getID3;
                $file = $getID3->analyze($filename);
                //Una ves que se yha subido se comprueba la resolucion del mismo
                if ($file['video']['resolution_x'] > 1280 && $file['video']['resolution_y'] > 720) {
                    //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                    unlink($ruta . $nombreimagen);
                    $ruta2 = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                    unlink($ruta2 . $nombreimagen2);
                    echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                    //Regresamos a la pagina anterior
                    echo "<html><head></head>" .
                    "<body onload=\"javascript:history.back()\">" .
                    "</body></html>";
                    exit;
                }
            }
        }
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        $newtyc = addslashes($terminos_y_condiciones);
        $status = 'C';
        //Si todos los parametros recibidos cumplen con las validaciones preavimente establecidas se registra un objeto
        $sql = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,fecha_actualizacion,status)
        VALUES('$idro'," . $_SESSION['idemp'] . ",'$fa','0000-00-00','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        $idcu = $na->generar_aleatorio();
        //Si todos los parametros recibidos cumplen con las validaciones preavimente establecidas se registra el cupon
        $sql2 = "INSERT INTO cupon (id_cupon,id_revision_objeto,titulo,descripcion_corta,descripcion_larga,id_imagen_vista_previa,id_imagen_extra,vigencia_inicio,vigencia_fin,terminos_y_condiciones,limite_codigos)
        VALUES('$idcu','$idro','$newtitulo','$newdc','$newdl','$iive','$iie','$vigencia_inicio','$vigencia_fin','$newtyc','$limite_codigos')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        //Se envia a la lista de los cupones registrados
        header("Location:../Controller/crtCupones.php");
    }

//Funcion que se encarga de buscar el limite de los cupones en base a al indentificador del cupon recibido
    public function buscarcodigoqr($idcupon) {
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
        $conn = new Conectar();
        $pd = $conn->con();
//Se reciben los parametros de la vista de la lista de cupones
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_cupon = $_GET["id_cupon"];
        //Si no se tiene un registro del cupon se envia una alert de elemento no valido
        if ($id_revision_objeto == NULL && $id_cupon == NULL) {
            echo '<script language = javascript> alert("No es un elemento valido de los cupones") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
        }
        $ext = '.jpg';
        $imagen = $_GET["id_imagen_extra"] . $ext;
        $imagen2 = $_GET["id_imagen_vista_previa"] . $ext;
        //primero buscar en la tabla codigo qr
        $c = new obtener_cupon();
        $cqr = $c->buscarcodigoqr($id_cupon);
        if ($cqr == NULL) {
            //Si no se tienen codigo qr se elimina el cupon
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
                header("Location:/campeche-web2/principal.php");
            } else {
                //Se elimina la imagen 
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                unlink($ruta . $imagen);
                mysqli_close($pd);
                header("Location:/campeche-web2/principal.php");
            }
            if ($imagen2 == "") {
                mysqli_close($pd);
                header("Location:/campeche-web2/principal.php");
            } else {
                //Se elimina la imagen 
                $ruta2 = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                unlink($ruta2 . $imagen2);
                mysqli_close($pd);
                header("Location:/campeche-web2/principal.php");
            }
        } else {
            //Si ya se tienen codigos registrados en envia una alerta de codigos qr generados
            echo '<script language = javascript> alert("Este cupon ya tiene codigos Qr generados, no se puede eliminar") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            exit;
        }
    }

//Funcion encargada de buscar los cupones  que han sido aprobados para actualizarlos o eliminarlos
    public function buscar_cupon() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_cupon = $_POST['id_cupon'];
        $consulta = "SELECT * FROM cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto WHERE c.id_cupon = '$id_cupon' and r.status = 'R';";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            //Si el cupon ya se encuentra ya sea validado o en reviison arroja la alerta de que no puede ser modificado
            echo '<script language = javascript>
	alert("Este cupon no puede ser Modificado")
           self.location = "../Controller/crtCupones.php"
	</script>';
        } else {
            //Si el estado es rechazado se envia la informacion asociada a ese cupon
            $id_cupon = $fila['id_cupon'];
            $id_revision_objeto = $fila['id_revision_objeto'];
            $titulo = $fila['titulo'];
            $descripcion_corta = $fila['descripcion_corta'];
            $descripcion_larga = $fila['descripcion_larga'];
            $id_imagen_extra = $fila['id_imagen_extra'];
            $id_imagen_vista_previa = $fila['id_imagen_vista_previa'];
            $vigencia_inicio = $fila['vigencia_inicio'];
            $vigencia_fin = $fila['vigencia_fin'];
            $terminos_y_condiciones = $fila['terminos_y_condiciones'];
            $limite_codigos = $fila['limite_codigos'];
        }
        return array($id_cupon, $id_revision_objeto, $titulo, $descripcion_corta, $descripcion_larga, $id_imagen_extra, $id_imagen_vista_previa, $vigencia_inicio, $vigencia_fin, $terminos_y_condiciones, $limite_codigos);
    }

//Funcion actualizar cupon 
    public function actualizar_cupon() {
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        $fecha_actual = date('Y-m-d H:i:s');
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fin = $_POST['vigencia_fin'];
        //Validacion para evitar que la vigencia no final no sea menor a la vigencia de inicio o igual a al fecha actual
        if ($vigencia_fin < $vigencia_inicio or $vigencia_fin <= $fecha_actual) {
            echo "<script>
                alert('La fecha de vigencia final no puede ser menor a la vigencia de inicio o a la fecha actual');
                window.location= '../Controller/crtCupones.php'
    </script>";
            exit();
        }
        $ext = '.jpg';
        $nombreimagen = $_FILES['id_imagen_vista_previa']['name'];
        if (empty($nombreimagen)) {
            $ni = $nombreanterior = $_POST["id_imagen_anterior"];
        } else {
            $nombreanterior = $_POST["id_imagen_anterior"] . $ext;
            $ni = $iie = $na->generar_alfanumerico();
            $nombreimagen = $iie . ".jpg";
            if (move_uploaded_file($_FILES['id_imagen_vista_previa']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen")) {
                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/$nombreimagen";
                //Libreria que analiza la resolucion de la imagen
                $getID3 = new getID3;
                $file = $getID3->analyze($filename);
                //Validacion para la resolucion de la imagen
                if ($file['video']['resolution_x'] > 120 && $file['video']['resolution_y'] > 120) {
                    //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                    unlink($ruta . $nombreimagen);
                    //Si la resolucion no coincide se arroja una alerta indicando la resolucion que tiene que poseer la imagen
                    echo "<script>
                alert('La resolucion de la imagen tiene que ser menor a 1280 x 720');
                window.location= '../Controller/crtCupones.php'
    </script>";
                    exit();
                } else {
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                    unlink($ruta . $nombreanterior);
                }
            }
        }
        $nombreimagen2 = $_FILES['id_imagen_extra']['name'];
        if (empty($nombreimagen2)) {
            $ni2 = $nombreanterior2 = $_POST["id_imagen_anterior2"];
        } else {
            $nombreanterior2 = $_POST["id_imagen_anterior2"] . $ext;
            $ni2 = $iip = $na->generar_alfanumerico();
            $nombreimagen2 = $iip . ".jpg";
            if (move_uploaded_file($_FILES['id_imagen_extra']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen2")) {
                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen2";
                //Libreria que analiza la resolucion de la imagen
                $getID3 = new getID3;
                $file = $getID3->analyze($filename);
                //Validacion para la resolucion de la imagen
                if ($file['video']['resolution_x'] > 1280 && $file['video']['resolution_y'] > 720) {
                    //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                    $ruta2 = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                    unlink($ruta2 . $nombreimagen2);
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/VistaPrevia/";
                    unlink($ruta . $nombreimagen);
                    //Si la resolucion no coincide se arroja una alerta indicando la resolucion que tiene que poseer la imagen
                    echo "<script>
                alert('La resolucion de la imagen tiene que ser menor a 1280 x 720');
                window.location= '../Controller/crtCupones.php'
    </script>";
                    exit();
                } else {
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
                    unlink($ruta . $nombreanterior2);
                }
            }
        }
        //se reciben los nuevos parametros yque se utilizaran para actualizar el registro del cupon
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_cupon = $_POST["id_cupon"];
        $titulo = $_POST['titulo'];
        $newtitulo = addslashes($titulo);
        $descripcion_corta = $_POST['descripcion_corta'];
        $newdc = addslashes($descripcion_corta);
        $descripcion_larga = $_POST['descripcion_larga'];
        $newdl = addslashes($descripcion_larga);
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        $newtyc = addslashes($terminos_y_condiciones);
        $nombre = $ni;
        $nombre2 = $ni2;
        $limite_codigos = $_POST['limite_codigos'];
        $actulizacion1 = "update revision_objeto set fecha_actualizacion = '$fecha_actual', status='C'  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actulizacion2 = "update cupon set titulo = '$newtitulo', descripcion_corta = '$newdc', descripcion_larga = '$newdl', id_imagen_vista_previa = '$nombre' , id_imagen_extra = '$nombre2',vigencia_inicio = '$vigencia_inicio',vigencia_fin = '$vigencia_fin' , terminos_y_condiciones =  '$newtyc' , limite_codigos =  '$limite_codigos' where id_cupon = " . $id_cupon . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:../Controller/crtCupones.php");
    }

}

?>