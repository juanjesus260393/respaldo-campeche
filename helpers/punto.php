<?php

/**
 * Punto-Coordenada
 */
class Punto {


  private $longitud;
  private $latitud;

  public function setLatitud( $lat ){
    $this->latitud = $lat;
    return $this;
  }

  public function setLongitud( $lon ){
    $this->longitud = $lon;
    return $this;
  }
  public function getLatitud() {
    return $this->latitud;
  }

  public function getLongitud() {
    return $this->longitud;
  }

  public function imprime(){
    echo ($this->latitud);
    echo (" ");
    echo ($this->longitud);

  }
}


 ?>
