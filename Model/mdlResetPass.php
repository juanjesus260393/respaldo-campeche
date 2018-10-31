<?php

/**
 * Description of mdlResetPass
 *
 * @author Pablo
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('Conexion.php');
require '../vendor/autoload.php';
require '../vendor/auxx.php';

class ResetPass {

    private $db;
    private $email;

    public function __construct() {
        $this->db = Conectar::con();
        $this->email = array();
    }

    function reset() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            if ($this->validarEmail($email)) {
                $newpass = ResetPass::generar_password(8);
                if (ResetPass::cambiarPassword($newpass, $email)) {
                    $enviado = ResetPass::sendmail($email, $newpass);
                    if ($enviado) {
                        header("HTTP/1.1 200 Ok");
                        exit();
                        // echo json_encode( array("error"=>"false", "msg"=>"Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña "));    
                    } else {
                        header("HTTP/1.1 401 Unauthorized");
                        exit();
                        //      echo json_encode(array("error"=>"true", "msg"=>"Ocurrio algo con el envio del correo. Correo no enviado"));    
                    }
                } else {
                    header("HTTP/1.1 410 Conflict");
                    exit();
                }
            } else {
                header("HTTP/1.1 401 Unauthorized");
                exit();
                //  echo json_encode(array("error"=>"true", "msg"=>"No existe una cuenta asociada a ese correo."));   
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
            exit();
            //return array("error"=>"true", "msg"=>"Debes introducir el email de la cuenta");
        }
    }

    private static function sendmail($user, $newpass) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'SoporteCampeche360@gmail.com';                 // SMTP username
            $mail->Password = EMAIL_PASS;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;

            $mail->setFrom('SoporteCampeche360@gmail.com', 'Soporte Campeche360');

            $mail->addAddress($user);               // Name is optional



            $mail->isHTML(TRUE);                                  // Set email format to HTML
            $mail->Subject = 'CUENTA';
            $mail->Body = '<h3>Esta es la nueva información de tu cuenta</h3>'
                    . '<br><br>'
                    . 'Usuario: <h3>' . $user . '</h3>'
                    . 'Contraseña : <h3>' . $newpass . '</h3>'
                    . '<br><h3>Tu contraseña se cambio con exito</h3>'
                    . '<br><h3>Le sugerimos que para su próximo inicio de sesión cambie su contraseña</h3>';

            $mail->SMTPDebug = false;
            $mail->CharSet = 'UTF-8';
            if (!$mail->Send()) {
                return FALSE;
            } else {
                return TRUE; //echo 'Message has been sent';
            }
        } catch (Exception $e) {
            return FALSE; // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function generar_password($largo) {
        $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $cadena_base .= '0123456789';
        $cadena_base .= '!@()/<>[]{}\=';

        $password = '';
        $limite = strlen($cadena_base) - 1;

        for ($i = 0; $i < $largo; $i++) {
            $password .= $cadena_base[rand(0, $limite)];
        }

        return $password;
    }

    private function cambiarPassword($password, $username) {
        $newpass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users set password='" . $newpass . "' where username='" . $username . "'";
        $con = $this->db;
        $resultado = $con->query($sql);
        if ($resultado) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function validarEmail($email) {
        $sql = "SELECT u.enabled FROM users u where u.username = '$email';";
        $con = $this->db;
        $resultado = $con->query($sql);
        if ($resultado) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
