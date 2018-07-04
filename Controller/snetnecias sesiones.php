<?php

echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";

$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo '¡La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
}


session_start();

$_SESSION['loggedin'] = true;
   
    $_SESSION['start'] = time();

    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    session_start();

unset ($SESSION['username']);

session_destroy();

 
