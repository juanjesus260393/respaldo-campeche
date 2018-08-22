<html>
    <body>
<?php
require_once ('../vendor/autoload.php');
use \Statickidz\GoogleTranslate;
 
$source = 'ES';
$target1 = 'EN';
$target2 = 'FR';
$text = 'Campeche es uno de los treinta y un estados que, junto con la Ciudad de Mexico, forman los Estados Unidos Mexicanos. Su capital y ciudad mas poblada es San Francisco de Campeche.';
 
$trans = new GoogleTranslate();
$result1 = $trans->translate($source, $target1, $text);
$result2 = $trans->translate($source, $target2, $text);

$idunico=0;
$a= str_split($text. uniqid());
$aux= count($a);
$i=0;
for($i; $i<$aux; $i++){
    $idunico+=ord($a[$i]); 
}
 date_default_timezone_set('America/Mexico_City');

        $hoy = date("d-m-Y H:i:s"); 
printf ("<p>".$idunico."\n\n</p>");

printf("<p>". $result1."\n\n</p>");
printf ("<p>". $result2."\n\n</p>");

?>
    </body>
</html>