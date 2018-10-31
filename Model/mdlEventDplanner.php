<?php
/**
 * Description of mdlAddDplanner
 *
 * @author Pablo
 */
require_once('conexion.php');
require_once('../scripts/Validaciones.php');
class eventDplanner {
    private $db;
    public function __construct() {
        $this->db = Conectar::con(); 
    }    
    public function agregarEvento(){
        include 'mdlSeguridad.php';
        $_POST = json_decode(file_get_contents("php://input"), true);
       if (isset($_POST['name']) && isset($_POST['date_init']) && isset($_POST['hour']) && isset($_POST['date_end']) && isset($_POST['place']) && isset($_POST['description']))
          {           
           $nombre=$_POST['name'];
           $fecha_init=$_POST['date_init'];
           $hora = $_POST['hour'];
           $fecha_fin = $_POST['date_end'];
           $lugar = $_POST['place'];
           $descripcion = $_POST['description'];                  
           $user=$usernamebd;      
           eventDplanner::InsertEvento($user, $nombre, $fecha_init, $hora, $fecha_fin, $lugar, $descripcion);
          }  else{
                 header("HTTP/1.0 400 Bad Request");
          }   
    }    
    public function actualizarEvento(){
       include 'mdlSeguridad.php';
        $_POST = json_decode(file_get_contents("php://input"), true);
       if (isset($_POST['id_event'])&& isset($_POST['name']) && isset($_POST['date_init']) && isset($_POST['hour']) && isset($_POST['date_end']) && isset($_POST['place']) && isset($_POST['description']))
          {  
           $idevento=$_POST['id_event'];
           $nombre=$_POST['name'];
           $fecha_init=$_POST['date_init'];
           $hora = $_POST['hour'];
           $fecha_fin = $_POST['date_end'];
           $lugar = $_POST['place'];
           $descripcion = $_POST['description'];
           $user=$usernamebd;      
           eventDplanner::updatetEvento($idevento, $user, $nombre, $fecha_init, $hora, $fecha_fin, $lugar, $descripcion);
          }  else{
                 header("HTTP/1.0 400 Bad Request");
          }   
    }     
    public function eliminarEvento(){
       include 'mdlSeguridad.php';
       $_POST = json_decode(file_get_contents("php://input"), true);
      if (isset($_POST['id_event'])){  
          $idevento=$_POST['id_event'];           
          $user=$usernamebd;      
          eventDplanner::deletetEvento($idevento, $user);
         }  else{
                header("HTTP/1.0 400 Bad Request");
         }   
   } 
     public function eliminarEventoCartelera(){
       include 'mdlSeguridad.php';
       $_POST = json_decode(file_get_contents("php://input"), true);
      if (isset($_POST['id_event'])){  
          $idevento=$_POST['id_event'];           
          $user=$usernamebd;      
          eventDplanner::deletetEvento($idevento, $user);
         }  else{
                header("HTTP/1.0 400 Bad Request");
         }   
   } 

    private static function InsertEvento($username, $nombre, $fecha_init,$hora, $fecha_fin, $lugar, $descripcion){
        include 'mdlSeguridad.php';
        $newfecha=$fecha_init .' '.$hora;
        $valid = new validacion;
        $newid= $valid->generar_aleatorio();
           $conn = new Conectar();
           $pd = $conn->con();     
           $sql = "INSERT INTO actividad (id, username, nombre, fecha_inicio, fecha_fin, lugar, descripcion)VALUES($newid, '$username', '$nombre', '$newfecha', '$fecha_fin', '$lugar', '$descripcion' )";
           if (!mysqli_query($pd, $sql)) {
               header("HTTP/1.0 409 Conflict");
               exit();
           } else {
                header("HTTP/1.0 200 Ok");
           }
           mysqli_close($pd);        
   }
    
    private static function updatetEvento($idactividad, $username, $nombre, $fecha_init,$hora, $fecha_fin, $lugar, $descripcion){   
        include 'mdlSeguridad.php';
         $newfecha=$fecha_init .' '.$hora;
            $conn = new Conectar();
            $pd = $conn->con();     
            $sql = "UPDATE actividad  SET nombre='$nombre', fecha_inicio='$newfecha', fecha_fin='$fecha_fin', lugar='$lugar', descripcion='$descripcion' WHERE id=$idactividad and username='$username'";
            if (!mysqli_query($pd, $sql)) {
                header("HTTP/1.0 409 Conflict");
                exit();
            } else {
                 header("HTTP/1.0 200 Ok");
            }
            mysqli_close($pd);        
    }
    private static function deletetEvento($idactividad, $username){
        include 'mdlSeguridad.php';
            $conn = new Conectar();
            $pd = $conn->con();     
            $sql = "DELETE FROM actividad WHERE id=$idactividad and username='$username'";
            if (!mysqli_query($pd, $sql)) {
                header("HTTP/1.0 409 Conflict");
                exit();
            } else {
                 header("HTTP/1.0 200 Ok");
            }
            mysqli_close($pd);        
    }
    private static function deletetEventoCartelera($idactividad, $username){
        include 'mdlSeguridad.php';
            $conn = new Conectar();
            $pd = $conn->con();     
            $sql = "DELETE FROM actividad_cartelera WHERE id_actividad=$idactividad and username='$username'";
            if (!mysqli_query($pd, $sql)) {
                header("HTTP/1.0 409 Conflict");
                exit();
            } else {
                 header("HTTP/1.0 200 Ok");
            }
            mysqli_close($pd);        
    }
    
    private static function get_user($Stoken) {
        include 'mdlSeguridad.php';
        $data = array();
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select username from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            header("HTTP/1.0 401 Unauthorized");
            exit();
        } else {
            $data ['username'] = $username = $filas['username'];            
        }
        mysqli_close($dbh);
        return $data;
    }   
}
