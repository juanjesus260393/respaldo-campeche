<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('functions.php');
require_once('../scripts/Validaciones.php');

//Modulo que se encarga de gestionar la informacion de inicio, cierre de sesion y actualizacion de la misma.
Class Turista {

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

//Funcion que actualiza la informacion de registro de un turista, aumenta su vigencia en un dia mas
    public static function update_register_turista($username, $di, $tokens) {
        $fecha = date('Y-m-d H:i:s');
        $dt = new DateTime($fecha);
        $dt->modify('+ 1 year');
        //a la fecha actual se aumenta un año la vigencia
        $cadena_fecha_vigencia = $dt->format("d/m/Y H:i:s");
        $cadena_fecha_vigenciadb = $dt->format("Y-m-d H:i:s");
        $conn = new Conectar();
        $pd = $conn->con();
        $token = $user_r['token'] = $tokens;
        $user_r['expire_at'] = $cadena_fecha_vigencia;
        $user_r['user_type'] = 'T';
        //Se actualiza en la base de datos el registro del tursita
        $sql = "UPDATE token SET vigencia='$cadena_fecha_vigenciadb' WHERE username = '$username' and id_dispositivo = '$di' and token = '$tokens';";
        if (!mysqli_query($pd, $sql)) {
            header("HTTP/1.0 409 Conflict");
            exit();
        }
        mysqli_close($pd);
        //Se regresa un array con la informaciona actualizada en la base de datos
        return $user_r;
    }

//Funcion que actualiza la informacion de registro de un turista, aumenta su vigencia en un dia mas
    public static function update_register_empleado($username, $di, $tokens) {
        $fecha = date('Y-m-d H:i:s');
        $dt = new DateTime($fecha);
        $dt->modify('+ 1 year');
        $cadena_fecha_vigencia = $dt->format("d/m/Y H:i:s");
        $cadena_fecha_vigenciadb = $dt->format("Y-m-d H:i:s");
        $conn = new Conectar();
        $pd = $conn->con();
        $token = $user_r['token'] = $tokens;
        $user_r['expire_at'] = $cadena_fecha_vigencia;
        $user_r['user_type'] = 'C';
        //Se actualiza en la base de datos el registro del empleado cajero
        $sql = "UPDATE token SET vigencia='$cadena_fecha_vigenciadb' WHERE username = '$username' and id_dispositivo = '$di' and token = '$tokens';";
        if (!mysqli_query($pd, $sql)) {
            header("HTTP/1.0 409 Conflict");
            exit();
        }
        mysqli_close($pd);
        //Se regresa un array con la informaciona actualizada en la base de datos
        return $user_r;
    }

//Funcion que se encarga de generar el registro de un turista
    public static function getTourist($username, $di) {
        $register = Turista::search_register($username, $di);
        if (empty($register)) {
            $fecha_vigencia = new DateTime();
            $fecha_vigencia->modify('+ 1 year');
            $cadena_fecha_vigencia = $fecha_vigencia->format("d/m/Y H:i:s");
            $cadena_fecha_vigenciadb = $fecha_vigencia->format("Y-m-d H:i:s");
            //A la fecha actual se le aumenta un año, esto solo aplica con nuevos usuarios
            //Funcion que se encarga de generar el token que se va a registrar
            $token = $user_r['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            $user_r['expire_at'] = $cadena_fecha_vigencia;
            $user_r['user_type'] = 'T';
            $conn = new Conectar();
            $pd = $conn->con();
            //registro de un nuevo usuario en la tabla token
            $sql = "INSERT INTO token (token,username,id_dispositivo,vigencia)
        VALUES('$token','$username','$di','$cadena_fecha_vigenciadb')";
            if (!mysqli_query($pd, $sql)) {
                header("HTTP/1.0 409 Conflict");
                exit();
            }
            mysqli_close($pd);
        } else {
            //Se regresa la informacion codificada al dispositivo movil y se envia a la funcion actualziar registro del turista
            $fecha = $register [0]["vigencia"];
            $tokens = $register [0]["token"];
            $user_r = Turista::update_register_turista($username, $di, $tokens);
        }
        return json_encode($user_r);
    }

//Funcion buscar reigstro de un usuario en base al username y al identificador del dispositivo
    public static function search_register($username, $di) {
        $datos = array();
        $dbh = Conectar::con();
        //Consulta que busca la informacion de un registro en base a los datos previamente mencionados
        $cs = "select vigencia,token from token where username = '$username' and id_dispositivo = '$di';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $datos[] = $res;
        }
        //Areglo con los datos de la consulta
        return $datos;
    }

//Funcion que se encarga de generar o actualizar el registro de un usuario cajero
    public static function getEnterprise($username, $di) {
        $register = Turista::search_register($username, $di);
        if (empty($register)) {
            $fecha_vigencia = new DateTime();
            $fecha_vigencia->modify('+ 1 year');
            $cadena_fecha_vigencia = $fecha_vigencia->format("d/m/Y H:i:s");
            $cadena_fecha_vigenciadb = $fecha_vigencia->format("Y-m-d H:i:s");
            $token = $user_r['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            $user_r['expire_at'] = $cadena_fecha_vigencia;
            $user_r['user_type'] = 'C';
            $conn = new Conectar();
            $pd = $conn->con();
            //Registro de un usuario cajero en la tabla token
            $sql = "INSERT INTO token (token,username,id_dispositivo,vigencia)
        VALUES('$token','$username','$di','$cadena_fecha_vigenciadb')";
            if (!mysqli_query($pd, $sql)) {
                header("HTTP/1.0 410 Conflict");
            }
            mysqli_close($pd);
        } else {
            //En caso de que el usuario ya se encuentre registrado y coincida el token y el identificador del dispositivo solo se actualiza la fecha de vencimiento
            $fecha = $register [0]["vigencia"];
            $tokens = $register [0]["token"];
            $user_r = Turista::update_register_empleado($username, $di, $tokens);
        }
        return json_encode($user_r);
    }

//Funcion que se encarga de obtener la contraseña de un usuario en base al nomre de usuario
    public static function searchpass($user, $pass, $di) {
        $conn = new Conectar();
        $pd = $conn->con();
        //Primero se obtiene la contraseña que sera comparada
        $cpass = "SELECT password from users WHERE username = '" . $user . "'";
        $rcpass = mysqli_query($pd, $cpass) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($rcpass);
        //Si no se encuentra un reigstro asociado se envia un encabezado 401
        if (!$fila1[0]) {
            header("HTTP/1.0 401 Unauthorized");
        } else {
            //Si existe un registro asociado y coincide se busca nuevamente la contraseña
            $passw = $fila1['password'];
            if (password_verify($pass, $passw)) {
                $cuser = "SELECT username FROM users WHERE username = '" . $user . "'";
                $rcuser = mysqli_query($pd, $cuser) or die(mysqli_error());
                $fila = mysqli_fetch_array($rcuser);
                //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
                if (!$fila[0]) {
                    header("HTTP/1.0 401 Unauthorized");
                } else {
                    $users = $fila['username'];
                    echo Turista::defineUser($users, $di);
                }
            } else {
                header("HTTP/1.0 401 Not Found");
            }
        }
    }

//Funcion que se encarga de eliminar un registro en base al token
    public static function deleteregister($token) {
        $data = array();
        $conn = new Conectar();
        $pd = $conn->con();
        //Se elimina el registro en base al token
        $dtoken = "delete from token where token = '" . $token . "'";
        $rdtoken = mysqli_query($pd, $dtoken) or die(mysqli_error());
        //si la eliminacion no se realiza se envia un encabezado 404
        if ($rdtoken == FALSE) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //Si la eliminacion se realiza satisfactoriamente se envia un encabezado 202
            header("HTTP/1.0 202 ACCEPTED");
        }
        return $data;
    }

//Funcion que se encarga de definir a un usuario en base a su nombre de usuario e identificador del dispositivo 
    public static function defineUser($user, $di) {
        $conn = new Conectar();
        $pd = $conn->con();
        //Consulta del nombre de usuario en base a un nombre de usuario previamente obtenido
        $consultatoken = "SELECT u.username from turista u  where u.username = '" . $user . "'";
        $resultadoconsultatoken = mysqli_query($pd, $consultatoken) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultadoconsultatoken);
        //Si el nombre de usuario no existe en la tabla turista
        if (!$fila1[0]) {
            //Se busca en la tabla usuario_usuarios
            $cuempresa = "SELECT u.username from users u inner join usuario_empresa e on u.username = e.username where e.username = '" . $user . "';";
            $rcempresa = mysqli_query($pd, $cuempresa) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($rcempresa);
            //Si no se encuentra en la tabla usuarios ni en la tabla turista se envia un encabezado 401
            if (!$fila2[0]) {
                header("HTTP/1.0 401 Unauthorized");
            } else {
                //Si la informacion proporcionada concincude con el registro de usuario empresa se envia el nombre de usuario a la funcion getenterprise
                $usernmc = $fila2['username'];
                echo Turista::getEnterprise($usernmc, $di);
                exit();
            }
        } else {
            //Si la informacion proporcionada concincude con el registro de usuario empresa se envia el nombre de usuario a la funcion gettourist
            $usernmt = $fila1['username'];
            echo Turista::getTourist($usernmt, $di);
            exit();
        }
    }
//Funcion que se encarga de generar el token que sera regisrado en la tabla token
    public static function generateStoken($user, $pass, $di) {
        //El token es generado con el nombre de usuario, contraseña, identificador de dispisitivo y la clae secreta
        $un = "user=" . $user;
        $ps = "pass=" . $pass;
        $i = "device_id=" . $di;
        $Ctoken = '391aa86cfb1bfadcb185476cd0f4b203174479c90090780528ffd4b55605f45c';
        //Se combina odos lo elementos
        $cadena = $un . "|" . $ps . "|" . $i . "|" . $Ctoken;
        //Se llama a la funcion sha256 
        $hashs = hash('sha256', $cadena);
        //Se codifica en base 54
        $Base64 = base64_encode(hex2bin($hashs));
        //Se regresa la cadena
        return $Stoken = "C-TOKEN " . $Base64;
    }
//Funcion que se encarga de realizar el inicio de sesionen la aplicacion
    public function login_movil() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        //Se obtiene el nombre de usuario y contraseña proprocionados de la aplicacion mocin
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            //se obtienen los emcbezados
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $di = $_POST['device_id'];
            //Se regenera el hashs del dispositivo
            $STOKEN = Turista::generateStoken($user, $pass, $di);
            //Se comparan ambos hashs
            if ($CTOKEN == $STOKEN) {
                if (Turista::searchpass($user, $pass, $di) == null) {
                    
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                exit();
            }
        } else {
            header("HTTP/1.0 400 Bad Request");
        }
    }
//Funcion que se encarga de buscar los parametros en base al token recibido
    public static function searchparams($tok) {
        $Claveprivada = '391aa86cfb1bfadcb185476cd0f4b203174479c90090780528ffd4b55605f45c';
        $conn = new Conectar();
        $pd = $conn->con();
        //se busca el nomre de usuario en base al token
        $cpass = "select u.username from users u inner join token t on u.username = t.username where t.token = '" . $tok . "';";
        $rcpass = mysqli_query($pd, $cpass) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($rcpass);
        //Si no existe un registro asociado a la consulta realziada se envia un encabezado 404
        if (!$fila1[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //se envian el encabezado regenrado
            $username = $fila1['username'];
            $cadena = $username . "|" . $tok . "|" . $Claveprivada;
            $hashs = hash('sha256', $cadena);
            $Base64 = base64_encode(hex2bin($hashs));
            header("HTTP/1.0 202 OK");
            return $Shash = $Base64;
        }
    }
//Funcion obtener hashs
    public static function gethash($HASH, $token) {
        $Claveprivada = '391aa86cfb1bfadcb185476cd0f4b203174479c90090780528ffd4b55605f45c';
        //Funcion que se encarga de regenerar el hashs proporcionado por el dispoisitivo para verificiar su identidad
        $cadena = $HASH . "|" . $token . "|" . $Claveprivada;
        $hashs = hash('sha256', $cadena);
        $Base64 = base64_encode(hex2bin($hashs));
        return $Shash = $Base64;
    }
//Funcion que se encarga de cerra sesion
    public function logout_movil() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        $_POST = json_decode(file_get_contents("php://input"), true);
        isset($_POST['hash']);
        $arr = apache_request_headers();
        if ($arr != NULL) {
            //Se obtiene el encabezado del dispostivo movil
            $CTOKEN = $arr['Authorization'];
            $CHASHCU = $_POST['hash'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $CAHASH = $Cseparada[2];
            $HASH = "hash=" . $CHASHCU;
            //Se verifica si el has del encabezado coincide
            $CHASHCA = Turista::gethash($HASH, $Stoken);
            if ($CAHASH == $CHASHCA) {
                //Se verifica que el hash enviado por el cuerpo coincida
                $SHASHCU = Turista::searchparams($Stoken);
                if ($CHASHCU == $SHASHCU) {
                    //Se elimina el registro en base al token
                    Turista::deleteregister($Stoken);
                    exit();
                } else {
                    header("HTTP/1.0 401 Unauthorized");
                    exit();
                }
            } else {
                header("HTTP/1.0 402 Unauthorized");
                exit();
            }
        } else {
            header("HTTP/1.0 400 Bad Request");
        }
    }
//Funcion que se encarga de actualizar la valides de una sesion
    public function keep_alive() {
        //Se manda a llamar el modulo de seguridad
        include 'mdlSeguridad.php';
        //Se otiene el token
        $tourist_token = $tokenbd;
        //En base al token se obtienela informacion del usuario
        $user_information = Funcionnes::get_user_dates($tourist_token);
        $user_name = $user_information ['username'];
        //Se define el tipo de usuario
        $type_of_user = Funcionnes::define_type_of_user($user_name);
        $user_tok = $user_information ['token'];
        $user_id = $user_information ['id_dispositivo'];
        //se aumenta la vigencia de la sesion
        $new_vigencia = Funcionnes::set_new_vigencia();
        $vigencia_json = $new_vigencia['date_user'];
        $vigencia_bd = $new_vigencia['date_bd'];
        $touris = "T";
        $cashier = "C";
        //Dependiendo del tipo de usuario se actualiza el registro
        if ($type_of_user == $touris) {
            $user_r = Funcionnes::update_tourist($user_name, $user_tok, $user_id, $vigencia_json, $vigencia_bd);
        } elseif ($type_of_user == $cashier) {
            $user_r = Funcionnes::update_cashier($user_name, $user_tok, $user_id, $vigencia_json, $vigencia_bd);
        }
        echo json_encode($user_r);
    }

}
