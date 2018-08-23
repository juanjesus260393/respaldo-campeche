<?php
/*
  utf8ize es una función usada para sanitizar cadenas UTF8 recursivamente.

  Puede probocar errores en php7 pues el paquete xml encode no está preinstalado para ubuntu.
  Para solucionarlo, se debe instalar instalar php-xml:
    ~$Ejemplo en ubuntu 16.04: sudo apt-get install php-xml
  Y posteriormente reiniciar apache con el comando graceful
  sudo apache2ctl graceful
*/
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}


class arr{

  static function ObtenerColumnaMuliArray(&$arr, $i){
    $rtn = [];
    foreach ($arr as $key => $file) {
      $rtn[]=$file[$i];
    }
    return $rtn;
  }
  static function CruzarArray2D(&$arr){
    $rtn = [];
    $llaves = array_keys(current($arr));
    foreach( $llaves as $i ){
      $rtn[] = self::ObtenerColumnaMuliArray($arr,$i);
    }
    return $rtn;
  }
  static function MezclarConLlaves( $arr1, &$arr2 ){
    foreach ($arr1 as $key => $value) {
      $arr2[$key] = $value;
    }
    return $arr2;
  }

  static function RECArr(&$arr, $current, $next ){
    if( $next === count($arr)-1 )
      return [$arr[$current]=>$arr[$next]];
    return [$arr[$current]=>self::RECArr($arr, $next, $next+1)];
  }

  static function RECMezclarRecursivamenteArrayCuadrado(&$arr1, $arr2 ){
    if( !is_array($arr1) || !is_array($arr2) )
      return $arr2;
    foreach( $arr2 as $key => $value ){
      if(!isset($arr1[$key])){
        $arr1[$key]=[];
      }
      $arr1[$key] = self::RECMezclarRecursivamenteArrayCuadrado( $arr1[$key], $value );
    }
    return $arr1;
  }

  static function CruzarArrayPorHash( &$arr ){
    $ctn = count(current( $arr ));
    $llaves = array_keys(current($arr));
    $auxArr = self::ObtenerColumnaMuliArray($arr,$llaves[0]);
    if( count($auxArr) == 0 ){
      return [];
    }
    $rtn = self::RECArr($auxArr, 0, 1 );
    for( $i = 1; $i < $ctn ; $i++ ){
      $auxArr = self::ObtenerColumnaMuliArray($arr,$i);
      $rtn = self::RECMezclarRecursivamenteArrayCuadrado($rtn, self::RECArr($auxArr, 0, 1 ) );
    }
    return $rtn;
  }
}

?>
