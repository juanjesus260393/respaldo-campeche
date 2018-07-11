<?php
require_once ('../vendor/autoload.php');
use \Statickidz\GoogleTranslate;
 
$source = 'es';
$target1 = 'en';
$target2 = 'fr';
$text = 'hola ¿como estas?';
 
$trans = new GoogleTranslate();
$result1 = $trans->translate($source, $target1, $text);
$result2 = $trans->translate($source, $target2, $text);
 
echo $result1;
echo $result2;