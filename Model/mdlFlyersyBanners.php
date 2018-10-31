<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');
include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

//Modulo encargado de gestionar la informacion de la publicidad que se mostrara en la aplicacion movil
class FlyeryBanner {

    private $platillo;
    private $dbh;

//Funcion que obtiene la lista de los flyers y banner que han sido autorizados
    public function lista_flyersybanners() {
        $this->dbh = Conectar::con();
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;";
        if (empty($this->dbh->query($sql))) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        //En caso de no tener ningun registro asociado a los parametros de la consulta se envia un arreglo vacio
        return $this->platillo;
    }

//Funcion encargada de registrar la publicidad de una empresa
    public function registrar_publicidad() {
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        //Se generan los identificadores de registro y de la publicidad
        $idro = $na->generar_aleatorio();
        $iie = $na->generar_alfanumerico();
        $fa = $na->fecha_actual();
        $status = 'C';
        //Recibir el tipo de publicidad que se subira
        $tipo = $_POST['tipo'];
        //Se verfica el tipo de publicidad para determinar la validacion que se aplicara a cada imagen
        if ($tipo == 'F') {
            $nombreimagenf = $_FILES['flyer']['name'];
            $nombreimagenf = $iie . ".jpg";
            if (move_uploaded_file($_FILES['flyer']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenf")) {
                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenf";
                $getID3 = new getID3;
                $file = $getID3->analyze($filename);
                //Una ves que se ha subido la imagen se comprueba la resolucion de la misma
                if ($file['video']['resolution_x'] > 338 && $file['video']['resolution_y'] > 600) {
                    //Si la resolucion no es la indicada se elimina la imagen que se acaba de subir
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
                    unlink($ruta . $nombreimagenf);
                    echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                    //Se regresa a la pagina de registro de la publicidad
                    echo "<html><head></head>" .
                    "<body onload=\"javascript:history.back()\">" .
                    "</body></html>";
                    exit;
                }
            }
        }
        if ($tipo == 'B') {
            $nombreimagenb = $_FILES['banner']['name'];
            $nombreimagenb = $iie . ".jpg";
            if (move_uploaded_file($_FILES['banner']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenb")) {
                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenb";
                $getID3 = new getID3;
                $file = $getID3->analyze($filename);
                //Una ves que se ha subido la imagen se comprueba la resolucion de la misma
                if ($file['video']['resolution_x'] > 728 && $file['video']['resolution_y'] > 90) {
                    //Si la resolucion no es la indicada se elimina la imagen que se acaba de subir
                    $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
                    unlink($ruta . $nombreimagenb);
                    echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                    //Se regresa a la pagina de registro de la publicidad
                    echo "<html><head></head>" .
                    "<body onload=\"javascript:history.back()\">" .
                    "</body></html>";
                    exit;
                }
            }
        }
        //Funcion para quitar apostrofe
        addslashes($id_url);
        $id_url = $_POST['url_sitio'];
        $newurl = addslashes($id_url);
        $this->visualizaciones = '0.0';
        $sql = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_actualizacion,fecha_creacion,status)
        VALUES('$idro'," . $_SESSION['idemp'] . ",'0000-00-00','$fa','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        $idad = $na->generar_aleatorio();
        $sql2 = "INSERT INTO ad (id_ad,id_revision_objeto,tipo,id_img,url_sitio,visualizaciones)
        VALUES('$idad','$idro','$tipo','$iie','$newurl','$this->visualizaciones')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:../Controller/crtcFlyers.php");
    }

//Funcion que se encarga de eliminar la publicidad de una empresa
    public function eliminar_publicidad() {
        $conn = new Conectar();
        $pd = $conn->con();
        //Se obtienen los parametros de la vista de la publicidad
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_ad = $_GET["id_ad"];
        //se verfica que el identificador de registro no venga vacios 
        if ($id_revision_objeto == NULL && $id_ad == NULL) {
            //Si se encuentran vacios arroja una alerta y se regresa a la vista de publicidad
            echo '<script language = javascript> alert("No es un elemento valido de la publicidad") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
        }
        $ext = '.jpg';
        $imagen = $_GET["id_img"] . $ext;
        //Se eleminan los registros de la base de datos 
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
            header("Location:/campeche-web2/principal.php");
        } else {
            //Se elimina la imagen asociada a la publicidad
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
            unlink($ruta . $imagen);
            mysqli_close($pd);
            header("Location:/campeche-web2/principal.php");
        }
    }

//Funcion que busca la informacion de la publicidad que se quiere eliminar 
    public function buscar_publicidad() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_ad = $_POST['id_ad'];
        //Consulta que obtiene la informacion de un cupon en especifico
        $consulta = "SELECT * FROM ad c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto WHERE c.id_ad = ' $id_ad' and r.status = 'R'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            //Si la pulicidad no ha sido aprobada no se puede modificar
            echo '<script language = javascript>
	alert("Esta publicidad no puede ser Modificado")
           self.location = "../Controller/crtcFlyers.php"
	</script>';
        } else {
            //En caso de que este aprobada se envia la informacion del registro
            $id_ad = $fila['id_ad'];
            $id_revision_objeto = $fila['id_revision_objeto'];
            $tipo = $fila['tipo'];
            $id_img = $fila['id_img'];
            $url_sitio = $fila['url_sitio'];
        }
        return array($id_ad, $id_revision_objeto, $tipo, $id_img, $url_sitio);
    }

//Funcion que actualiza la informacion de un registro previo de la publicidad
    public function actualizar_publicidad() {
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        $tipo = $_POST['tipo'];
        //Si no se envia nueva informacion se respeta la que se tenia antetiormente
        if (empty($tipo)) {
            $newtype = $tipoanterior = $_POST["tipo_anterior"];
        } else {
            if ($tipo == 'F') {
                $nombreimagenflyer = $_FILES['flyer']['name'];
                if (empty($nombreimagenflyer)) {
                    $newimage = $nombreanterior = $_POST["idimagenanterior"];
                }
                $newtype = $tipo;
                $newimage = $iie = $na->generar_alfanumerico();
                $nombreimagenflyer = $iie . ".jpg";
                if (move_uploaded_file($_FILES['flyer']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenflyer")) {
                    $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenflyer";
                    $getID3 = new getID3;
                    $file = $getID3->analyze($filename);
                    //Validacion de la resolucion de la publicidad que se quiere cambiar por la previa
                    if ($file['video']['resolution_x'] > 338 && $file['video']['resolution_y'] > 600) {
                        //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                        $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
                        unlink($ruta . $nombreimagenflyer);
                        echo "<script>
                alert('La resolucion de la imagen tiene que ser menor a 338 x 600');
                window.location= '../Controller/crtcVideos.php'
    </script>";
                        exit();
                    } else {
                        //Si si cumple con el requisito se elimina la publicidad previa
                        $nombreanterior = $_POST["idimagenanterior"] . ".jpg";
                        $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
                        unlink($ruta . $nombreanterior);
                    }
                }
            }
            if ($tipo == 'B') {
                $nombreimagenbanner = $_FILES['banner']['name'];
                if (empty($nombreimagenbanner)) {
                    $newimage = $nombreanterior = $_POST["idimagenanterior"];
                }
                $newtype = $tipo;
                $newimage = $iie = $na->generar_alfanumerico();
                $nombreimagenbanner = $iie . ".jpg";
                if (move_uploaded_file($_FILES['banner']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenbanner")) {
                    $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/$nombreimagenbanner";
                    $getID3 = new getID3;
                    $file = $getID3->analyze($filename);
                    //Validacion de la resolucion de la publicidad que se quiere cambiar por la previa
                    if ($file['video']['resolution_x'] > 728 && $file['video']['resolution_y'] > 90) {
                        //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                        $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
                        unlink($ruta . $nombreimagenbanner);
                        echo "<script>
                alert('La resolucion de la imagen tiene que ser menor a 728 x 90');
                window.location= '../Controller/crtcVideos.php'
    </script>";
                        exit();
                    } else {
                        //Si si cumple con el requisito se elimina la publicidad previa
                        $nombreanterior = $_POST["idimagenanterior"] . ".jpg";
                        $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Publicidad/";
                        unlink($ruta . $nombreanterior);
                    }
                }
            }
        }
        if (empty($nombreimagenbanner) && empty($nombreimagenflyer)) {
            $newimage = $nombreanterior = $_POST["idimagenanterior"];
        }
        $url_sitio = $_POST["url_sitio"];
        if (empty($url_sitio)) {
            $urlanterior = $_POST["ur_previa"];
            $newurl = addslashes($urlanterior);
        } else {
            $newurl = addslashes($url_sitio);
        }
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_ad = $_POST["id_ad"];
        $fecha_actual = date('Y-m-d H:i:s');
        //Se actualizan los registro de la publicidad previa
        $actulizacion1 = "update revision_objeto set fecha_actualizacion = '$fecha_actual',status = 'C'  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        //Se actualiza la publicidad
        $actulizacion2 = "update ad set tipo = '$newtype', id_img = '$newimage', url_sitio = '$newurl' where id_ad = " . $id_ad . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:../Controller/crtcFlyers.php");
    }

}
