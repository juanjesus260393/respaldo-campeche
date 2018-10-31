<?php
//Modulo de seguridad
require_once('functions.php');
//Se llamana algunas funciones de la clase functions
//Se verifica el metodo de acceso al servidor en este caso no tiene que permitir que ningun  metodo sea accedido a no ser que sea por medio de un 
//Dispositivo movil
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.0 405 Method Not Allowed");
    exit();
}
$arr = apache_request_headers();
//Se recibe el encabezado authorizaton
if (isset($arr['Authorization'])){
    $CTOKEN = $arr['Authorization'];
    $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 3);
    //Se obtiene el token y el hash
    $Stoken = $Cseparada[1];
    $CAHASH = $Cseparada[2];
    //por medio de una consulta se verifica la identiddad de un turista, si coincida se obtiene el token
    $Stokens = Funcionnes::verify_identify($Stoken);
    $tokenbd = $Stokens ['token'];
    //En base al token obtenido se otiene el nombre del usuario
    $username = Funcionnes::get_user_dates($tokenbd);
    $usernamebd = $username ['username'];
} else {
    //En caso de que no se reciba el encabezado se envia un emcbezado 401
    header("HTTP/1.0 401 Unauthorized");
    exit();
}


