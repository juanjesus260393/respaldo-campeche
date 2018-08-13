<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Nueva Empresa</title>
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        
        
                               <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0px 0px 24px 0px;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navb">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../Controller/IniciodeSesion.php" >
                                    HOME
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Sitios
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/ControladorSitios.php">Ver Sitios</a>
                                    <a class="dropdown-item" href="../Controller/add_Sitios_controller.php">Agregar Sitios</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="../Controller/crtCupones.php" id="navbardrop" data-toggle="dropdown">
                                                    Cupones
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtCupones.php">Cupones  </a>
                                                    <a class="dropdown-item" href="../view/Addcupon.php">Agregar Cupon</a>

                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="../Controller/crtcVideos.php" id="navbardrop" data-toggle="dropdown">
                                                    Videos
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtcVideos.php">Videos  </a>
                                                    <a class="dropdown-item" href="../view/Addvideo.php">Agregar Cupon</a>

                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="../Controller/crtcFlyers.php" id="navbardrop" data-toggle="dropdown">
                                                    Flyers & Banners
                                                </a>
                                                <div class="dropdown-menu">
                                                   
                                                    <a class="dropdown-item" href="../Controller/crtcFlyers.php">Flyers & Banners  </a>
                                                    <a class="dropdown-item" href="../view/Addflyerybanner.php">Agregar Flyers & Banners</a>
                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                                    Graficas
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtEstadisticacupones.php">Estadisticas Cupones </a>
                                                    <a class="dropdown-item" href="#">  </a>
                                                </div>
                             </li>
                              <li class="nav-item dropdown">
                                 <a class="nav-link" href="../Controller/cambiaPass_controller.php">
                                                    Cambia Contraseña
                                                </a>       
                             </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                            <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </nav>
               
        <div class="container" id="formulario" >
            <form  enctype="multipart/form-data" action="../Controller/add_Sitios_controller.php" method="post">
                <br><br>
                <table class="table" style="width: 100%;">
                    <tr>
                        <td>     
                            <label>Nombre del Sitio</label>
                            <input type="text" size="30" name="nombreSitio">
                        </td>
                        <td><label>Url del Sitio</label>
                            <input type="text" size="30" name="urlsitio"></td>
                        <td >
                       
                            <label>Municipio</label>
                            <?php
                            printf("<select required name='municipios'>");
                            printf("<option value=''>Seleccionar...</option>");
                            foreach ($municipio as $mpio) {
                               
                                printf("<option value='" . $mpio[0] . "'>" . $mpio[1] . "</option>");
                            }
                            printf("</select>");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Telefono 1</label>
                            <input type="text" size="20" name="tel1" onkeypress="soloNum()">
                            <label>Telefono 2</label>
                            <input type="text" size="20" name="tel2" onkeypress="soloNum()">
                            <label>Direccion</label>

                            <textarea name="dir" rows="3" cols="35" placeholder="Escriba la direccion..."></textarea>

                            <div>
                                <label>Imagen Perfil:</label><br>
                                <input type="file" id="idperfil" accept=".jpg" name="idperfil">
                            </div>
                            <div>
                                <label>Logo:</label><br>
                                <input type="file" id="idlogo" accept=".jpg" name="idlogo">
                            </div>
                            <div>
                                <label>Carta:</label><br>
                                <input type="file" id="idcarta" accept=".pdf" name="idcarta">
                            </div>
                            <div>
                                <br>
                            <label>Capacidad</label>
                            <input type="text" size="20" name="tam">
                            </div>
                            <div class="col text-right">
                            <label>Coordenadas</label>
                            <input id="posx" type="text" size="33" name="cordx" readonly>
                            <input id="posy" type="text" size="33" name="cordy" readonly>
                            </div>



                        </td>


                        <td style="height: 415px; width: 570px;">
                            <div id="map" style="height: 400px; width: 570px; z-index: 2; position: absolute;">
                            </div>
                            <div id="floating-panel" style="position: relative;top: 1%;
                                 left:30%;
                                 z-index: 5;
                                 background-color: #fff;
                                 padding: 3px;
                                 border: 1px solid #999;
                                 width: 300px;
                                 font-family: 'Roboto','sans-serif';
                                 line-height: 25px;
                                 ">
                                <input id="address" type="text" >
                                <input id="submit" type="button" value="Buscar">
                            </div>


                            <script>
                                var marker;
                                var marker2;
                                function initMap() {
                                    var myLatlng = {lat: 19.8301251, lng: -90.53490870000002};

                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 13,
                                        center: myLatlng,
                                        streetViewControl: false
                                    });

                                    marker = new google.maps.Marker({
                                        position: myLatlng,
                                        map: map,
                                        title: 'Click to zoom'
                                    });

                                    /* map.addListener('center_changed', function () {
                                     // 3 seconds after the center of the map has changed, pan back to the
                                     // marker.
                                     window.setTimeout(function () {
                                     map.panTo(marker.getPosition());
                                     }, 3000);
                                     });*/

                                    map.addListener('click', function (event) {
                                        marker.setPosition(event.latLng);
                                        
                                    document.getElementById("posx").value = marker.getPosition().lat();
                                    document.getElementById("posy").value = marker.getPosition().lng();

                                    });
                                    
                                    document.getElementById("posx").value = marker.getPosition().lat();
                                    document.getElementById("posy").value = marker.getPosition().lng();

                                    var geocoder = new google.maps.Geocoder();

                                    document.getElementById('submit').addEventListener('click', function () {
                                        geocodeAddress(geocoder, map);
                                       
                                        
                                    });
                                }
                                function geocodeAddress(geocoder, resultsMap) {
                                    var address = document.getElementById('address').value;
                                    geocoder.geocode({'address': address}, function (results, status) {
                                        if (status === 'OK') {
                                            resultsMap.setCenter(results[0].geometry.location);
                                                marker.setPosition(results[0].geometry.location);
                                                resultsMap.setZoom(15);
                                            
                                        } else {
                                            alert('No se encontro' + status);
                                        }
                                    });
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX3zRx9Ccv62uYx_DU8ifXfhWh4t5uwp4&callback=initMap"
                            async defer></script>
                        </td>



                    </tr>
                    <tr>
                        <td>
                            <div>
                                <span><label>Descripcion Corta:</label></span>
                                <span><input type="text" id="descripcion_corta"  size="25" name="descripcion_corta" placeholder="Descripcion Corta"  maxlength="149" required></span>
                            </div> 
                            <br><br><br>
                            <input type="submit" name="submit" value="Agregar Sitio">
                        <td>
                            <label>Horario</label>
                            <br>
                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAbre-&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-Cierra</label>
                            <br>
                            <input type="time" name="horaAbre" value="07:00"  step="1">
                            <input type="time" name="horaCierra" value="07:00"  step="1">
                            <br><br>
                        </td>
                             
                        
                       
                        <td>

                            <label>Descripcion Larga:</label>
                            <textarea  id="descripcion_larga" name="descripcion_larga" rows="7" cols="78" placeholder="Descripcion Larga" maxlength="490" required></textarea>

                        </td>
                    </tr>
                </table>




            </form>

        </div>
        <?php
        ?>
    </body>
</html>
