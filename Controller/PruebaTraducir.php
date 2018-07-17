<html>
    <body>
<?php
require_once ('../vendor/autoload.php');
use \Statickidz\GoogleTranslate;
 
$source = 'es';
$target1 = 'en';
$target2 = 'fr';
$text = 'hola ¿como estas? esto es una prueba de traducción de texto que se utilizara para las descripciones';
 
$trans = new GoogleTranslate();
$result1 = $trans->translate($source, $target1, $text);
$result2 = $trans->translate($source, $target2, $text);
 
printf ("<p>".$text."\n\n</p>");

printf("<p>". $result1."\n\n</p>");
printf ("<p>". $result2."\n\n</p>");

?>
    </body>
</html>