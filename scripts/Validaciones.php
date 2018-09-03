<?php
require_once ("../Model/conexion.php");

class validacion {
    /* public function habilitado($estado) {
      //Si tu cuenta no se encuentra habilitada
      if ($_SESSION['enabled'] == NULL) {
      echo '<script language = javascript>
      alert("Tu cuenta todavia no se encuentra habilitada.")
      </script>';
      }
      } */

// creamos la función
    private $platillo;

    public function lista_cupones_caducados() {
        $this->dbh = Conectar::con();
        $fa = date('Y-m-d');
        $ftma = strtotime('+5 day', strtotime($fa));
        $ftma = date('Y-m-d', $ftma);
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "SELECT c.titulo, c.vigencia_fin, c.limite_codigos FROM cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
inner join empresa e on r.id_empresa = e.id_empresa inner join usuario_empresa u on e.id_membresia = u.id_empresa where
c.vigencia_fin <= '$ftma' and e.id_empresa = " . $_SESSION['idemp'] . " group by c.titulo";
        foreach ($this->dbh->query($sql) as $res) {
            $this->platillo[] = $res;
        }
        return $this->platillo;
    }

    function mostrar_ocultar() {
        if ($_SESSION['enabled'] == 1) {
            if ($_SESSION['tipo'] == "administrador") {
                echo '<script language = javascript>self.location ="../Controller/Emp_Activas_controller.php";
		</script>';
            } else if ($_SESSION['tipo'] == "empresa") {


                require_once '../view/modals.php';
                ?>

                <?php
include '../includes/header2.php';
?>
<div> 
        <div> 
            <div class="content">
                <div class="main">
                    <div class="grids">
                        <ul class="list">
                            <div class="grid_info">
                                <ul class="menu">
                                    <li> <center><a><strong>Bienvenidos</strong></a></center>
                                    <ul>
                                        <li><p align="justify">La aplicación Campeche 360 fue creada por el Consejo Coordinador Empresarial especialmente para los visitantes a nuestra identidad y desarrollada para la interacción de las empresas prestadoras de servicios turísticos y complementarias de la ciudad con el fin de ofertar de manera competitiva, eficiente y en tiempo real sus productos al turista. 
                                                Es una valiosa herramienta tecnológica que le da un gran poder al usuario para disfrutar a plenitud de todos los atractivos turísticos durante su estadía, para su goce y satisfacción. 
                                                Le invito a disfrutar de la experiencia del App Campeche 360 y vivir campechanamente un tiempo excepcional en nuestra ciudad de San Francisco de Campeche, Patrimonio Cultural de la Humanidad. <br>
                                            <br></li>    
                                    </ul>
                                    </li> 
                                    <li><center><a><strong>NOSOTROS</strong></a></center>
                                    <ul>
                                        <li>
                                            <p align="justify">Campeche 360 es una aplicación creada para ayudar al turista a planear la mejor ruta dentro de San Francisco de Campeche con la finalidad de tener la mejor experiencia dentro de la ciudad amurallada disfrutando de las atracciones turísticas, de entretenimiento, así como fuera de la ciudad en la zona arqueológica; de igual manera los usuarios de Campeche 360 podrá contar con información, descuentos y ofertas de los mejores prestadores de servicios Campechanos tanto en restaurantes, hoteles como en comercios. No olvide checar el área de “cupones” seguro hay uno para sus necesidades.<br><br></li>
                                    </ul>
                                    <li>  <center><a><strong>Membresias</strong></a></center>
                                    <ul>
                                        <li> <br><span class="Estilo5">Membresia 360</span>
                                            <p align="justify">Al contratar este paquete de servicio de forma anual, usted contará con la afiliación por un año en la Camara del Consejo Empresarial de Campeche, así como de la cámara a la cual pertenezca su giro de servicio. Adicionalmente la ubicación de su negocio dentro de los atractivos turísticos de la aplicación con la alta descripción del giro de su empresa, posibilidades de hacer campañas de Marketing personalizadas, tener reportes de visitantes a su negocio, la evaluación de sus servicios de manera inmediata, dinamismo de manejo de publicidad de su negocio. Con la adición de soporte técnico para el mantenimiento de su negocio en la aplicación de Campeche 360. Para cualquier pregunta el cuanto al costo, por favor contáctenos a través de esta página web, correo electrónico o teléfono.<br><br>
                                                <span class="Estilo5">Membresia premium</span>
                                            <p align="justify">El plan oro le permite a su negocio tener acceso a la aplicación a través de las ubicaciones en forma de un pin dentro del mapa de la ciudad, Ud. podrá tener hasta cinco imágenes para publicidad de la aplicación, hacer la descripción corta y una larga de su tipo de servicio, así como la especialidad de su negocio, podrá hacer publicidad de eventos, llevar un registro de la evaluación de sus servicios de forma inmediata, crear cupones de descuentos, creación de campañas de Marketing especializadas, haremos las traducciones a los otros idiomas disponibles dentro de la App de Campeche360, contará con soporte técnico para el manejo de su negocio dentro de Campeche360. Para cualquier pregunta el cuanto al costo, por favor contáctenos a través de esta página web, correo electrónico o teléfono<br></li>
                                    </ul>
                                    </li>
                                </ul>
                            </div>	
                            <div class="clear"> </div> <br>
                        </ul>
              
                    </div>
                </div>
                <div class="clear"></div>	
            </div>
            <div class="clear"></div>	
            <!-- end main_content -->
        </div>





                                <?php
                            }
                        } else if ($_SESSION['enabled'] == NULL) {
                            echo '<script language = javascript>
	alert("Tu cuenta todavia no se encuentra habilitada.")
		</script>';
                        }
                    }

// creamos la función
                    public function generar_aleatorio() {
//Se declara la longitud del numero aleatorio que se generara
                        $rango = 9;
                        $longitud = $rango;
                        $key = '';
//Se establece el numero de patrones que se utilizara
                        $pattern = '1234567890';
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < $longitud; $i++)
                            $key .= $pattern{mt_rand(0, $max)};
//Se genera el numero aleatorio
                        return $key;
                    }

// creamos la función generar alfa numerico
                    public function generar_alfanumerico() {
//Se declara la longitud del numero aleatorio que se generara
                        $rango = 9;
                        $longitud = $rango;
                        $key = '';
//Se establece el numero de patrones que se utilizara
                        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < $longitud; $i++)
                            $key .= $pattern{mt_rand(0, $max)};
//Se genera el numero aleatorio
                        return $key;
                    }

// creamos la función generar alfa numerico
                    public function identificador_token() {
//Se declara la longitud del numero aleatorio que se generara
                        $rango = 10;
                        $longitud = $rango;
                        $key = '';
//Se establece el numero de patrones que se utilizara
                        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzZBCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < $longitud; $i++)
                            $key .= $pattern{mt_rand(0, $max)};
//Se genera el numero aleatorio
                        return $key;
                    }

// creamos la función
                    public function fecha_actual() {
                        $año_actual = date("Y");
                        $mes_actual = date("m");
                        $dia_actual = date("d");
                        $hora_actual = date("h");
                        $minuto_actual = date("i");
                        $segundo_actual = date("s");
                        $fecha_actual = $año_actual . "-" . $mes_actual . "-" . $dia_actual . " " . $hora_actual . ":" . $minuto_actual . ":" . $segundo_actual;
//Se genera el numero aleatorio
                        return $fecha_actual;
                    }

                    public function registros_cupon() {
                        $empresas=array();
                        $mysqli = Conectar::con();
                        // $mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "3") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '4';
                            
                             date_default_timezone_set('America/Mexico_City');

        $hoy= date("Y-m-d H:i:s");
        $hoy2= DateTime::createFromFormat('Y-m-d H:i:s', $hoy);
      //  $Ndias = cal_days_in_month(CAL_GREGORIAN, $mactual, $aactual);
        
        $consultafechas = $mysqli->query("SELECT fecha_inicio_membresia, fecha_fin_membresia FROM empresa WHERE id_empresa = " . $_SESSION['idemp']." ");
                  $fechas = $consultafechas->fetch_row();
                 
                  $fechainicio=new DateTime($fechas[0]);
                  $fechafin=new DateTime( $fechas[1]);
                
                            if($hoy2<$fechafin){
                                
                               $Nmeses= $fechainicio->diff($hoy2); 
                               $NMeses=$Nmeses->format('%m');
                               $Ndias=$Nmeses->format('%d');
                               if($Ndias>=1){
                                   $NMeses=$NMeses+1;
                               }
                               $FI=new DateTime($fechas[0]);
                               $FT=new DateTime($fechas[0]);
                                
                               if ($NMeses>=1){   
                                   
                            $intervalo = new DateInterval('P'.($NMeses-1).'M');
                            $FI->add($intervalo);
                            $intervalo2 = new DateInterval('P'.($NMeses).'M');
                            $FT->add($intervalo2);                     
                               }else if($NMeses<1){

                                    
                                    
                                   $FT->add(new DateInterval('P1M'));
                                   
                               }
                            }
                           
                            
                            
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto)"
                                    . " inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " "
                                    . "AND r.fecha_creacion>='".$FI->format('Y-m-d H:i:s')."' AND r.fecha_creacion<='".$FT->format('Y-m-d H:i:s')."' group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            
                            
                            
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 4 Cupones, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "2") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '2';
   date_default_timezone_set('America/Mexico_City');

        $hoy= date("Y-m-d H:i:s");
        $hoy2= DateTime::createFromFormat('Y-m-d H:i:s', $hoy);
      //  $Ndias = cal_days_in_month(CAL_GREGORIAN, $mactual, $aactual);
        
        $consultafechas = $mysqli->query("SELECT fecha_inicio_membresia, fecha_fin_membresia FROM empresa WHERE id_empresa = " . $_SESSION['idemp']." ");
                  $fechas = $consultafechas->fetch_row();
                 
                  $fechainicio=new DateTime($fechas[0]);
                  $fechafin=new DateTime( $fechas[1]);
                
                            if($hoy2<$fechafin){
                                
                               $Nmeses= $fechainicio->diff($hoy2); 
                               $NMeses=$Nmeses->format('%m');
                               $Ndias=$Nmeses->format('%d');
                               if($Ndias>=1){
                                   $NMeses=$NMeses+1;
                               }
                               $FI=new DateTime($fechas[0]);
                               $FT=new DateTime($fechas[0]);
                                
                               if ($NMeses>=1){   
                                   
                            $intervalo = new DateInterval('P'.($NMeses-1).'M');
                            $FI->add($intervalo);
                            $intervalo2 = new DateInterval('P'.($NMeses).'M');
                            $FT->add($intervalo2);                     
                               }else if($NMeses<1){

                                    
                                    
                                   $FT->add(new DateInterval('P1M'));
                                   
                               }
                            }
                           
                            
                            
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto)"
                                    . " inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " "
                                    . "AND r.fecha_creacion>='".$FI->format('Y-m-d H:i:s')."' AND r.fecha_creacion<='".$FT->format('Y-m-d H:i:s')."' group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            
                            
                            
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 2 Cupones, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar cupones necesitas cambiar el tipo de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function registros_video() {
                        $mysqli = Conectar::con();
                        //$mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "3") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '3';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_video from (video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 3 Videos, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "2") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '1';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_video from (video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 2 Videos, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_video from (video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar Videos necesitas cambiar de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function registros_paquete() {
                        $mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select p.id_paquete, p.nombre, p.status, e.descripcion from paquete p inner join empresa_paquete e on p.id_paquete = e.idpaquete where e.idempresa = " . $_SESSION['idemp'] . " group by nombre;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar Paquetes necesitas cambiar de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function registros_publicidad() {
                        $mysqli = Conectar::con();
                        //$mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "3") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '4';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 4 flyers o Banners, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "2") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '2';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 2 flyers o Banners si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar Flyers o Banners necesitas cambiar el tipo de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function hora_computadora() {
                        $horaInicial = date("h");
                        $minutoAnadir = 60;
                        $segundos_horaInicial = strtotime($horaInicial);
                        $segundos_minutoAnadir = $horaInicial * 60;
                        $nuevaHora = date("h:i", $segundos_horaInicial + $segundos_minutoAnadir);
//Se genera el numero aleatorio, $segundos_horaInicial + $segundos_minutoAnadir
                        return $segundos_minutoAnadir;
                    }

                    public function campos_vacios($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10) {
//Se verfica si los elementos enviados atraves de la url se encuentran vacios
                        if ($p1 == NULL and $p2 == NULL and $p3 = NULL and $p4 == NULL and $p5 == NULL and $p6 = NULL and $p7 == NULL and $p8 == NULL and $p9 == NULL and $p10 == null) {
                            include 'error404.php';
                        } else {
                            
                        }
                    }

                    public function campo_vacio($parametro) {
                        if ($parametro == NULL) {
                            echo '<script language = javascript>
	alert("No tienes contenido registrado.")
    	</script>';
                            echo "<html><head></head>" .
                            "<body onload=\"javascript:history.back()\">" .
                            "</body></html>";
                            exit;
                        } else {
                            return $parametro;
                        }
                    }

                    public function campo_vaciocupon($parametro, $parametro2) {
                        if ($parametro == NULL && $parametro2 == NULL) {
                            echo '<script language = javascript>
	alert("No tienes contenido registrado.")
    	</script>';
                            echo "<html><head></head>" .
                            "<body onload=\"javascript:history.back()\">" .
                            "</body></html>";
                            exit;
                        } else {
                            return $parametro;
                        }
                    }

                }
                