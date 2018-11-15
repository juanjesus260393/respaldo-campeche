<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Vista donde se encuentra toda la parte visual necesaria
 *   para  la validacion de un Sitio
 * 
 * por Fabrica de Software, CIC-IPN
 */

include '../includes/header.php';


?>


    <body>


        <table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
                  <th scope="col" width='120' align='center'>Logo</th>
                <th scope="col" width='220' align='center'>Nombre</th>
                <th scope="col" width='500' align='center'>Direccion</th>
                <th scope="col" width='500' align='center'>Status</th>
                <th scope="col" width='220' align='center'>Url Sitio</th>
                <th scope="col" width='220' align='center'>Horario</th>

            </tr>


            <?php
            foreach ($sitios as $cupdato) {
                ?>

                <tr  class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal' data-whatever='<?php printf($cupdato[2]); ?>'
                     data-0='<?php printf($cupdato[0]); ?>' data-1='<?php printf($cupdato[1]); ?>' data-2='<?php printf('%s', $cupdato[2]); ?>' data-3='<?php printf('%s', $cupdato[3]); ?>'
                     data-4='<?php printf($cupdato[4]); ?>' data-5='<?php printf($cupdato[5]); ?>' data-6='<?php printf($cupdato[6]); ?>' data-7='<?php printf($cupdato[7]); ?>' 
                     data-8='<?php printf($cupdato[8]); ?>' data-9='<?php printf($cupdato[9]); ?>' data-10='<?php printf($cupdato[10]); ?>' data-11='<?php printf($cupdato[11]); ?>'
                     data-13='<?php printf($cupdato[13]); ?>' data-14='<?php printf($cupdato[14]); ?>' data-15='<?php printf($cupdato[15]); ?>' data-16='<?php printf($cupdato[16]); ?>'
                      data-17='<?php printf($cupdato[17]); ?>' data-18='<?php printf($cupdato[18]); ?>' data-19='<?php printf($cupdato[19]); ?>' data-20='<?php printf($cupdato[20]); ?>'
                     data-21='<?php printf($cupdato[21]); ?>' data-22='<?php printf($cupdato[22]); ?>' data-23='<?php printf($cupdato[23]); ?>' data-24='<?php printf($cupdato[24]); ?>'
                     data-25='<?php printf($cupdato[25]); ?>' data-26='<?php printf($cupdato[26]); ?>' data-27='<?php printf($cupdato[27]); ?>'
                     data-28='<?php printf($cupdato[28]); ?>' data-29='<?php printf($cupdato[29]); ?>'>

                    <?php
                    printf("<td align='center'><img src='../Imagenes/Sitios/img/" . $cupdato[13] . ".jpg' alt='" . $cupdato[13] . " imagen no disponible' height='80' width='60' ></td>");

                    printf("<td height='80' align='center'>%s", $cupdato[2]);
                    printf("</td>");

                    printf("<td height='80' align='center'>%s", $cupdato[3]);
                    printf("</td>");


                    if ($cupdato[6] == 'R') {
                        printf("<td height='80' align='center' style='color: #EA1515 ;'><h4><b>Pendiente de corrección</b></h4></td>");
                    }else  if ($cupdato[6] == 'C') {
                        printf("<td height='80' align='center' style='color: blue ;'><h4><b>En Revisión</b></h4></td>");
                    } 

                    printf("<td height='80' align='center'>" . $cupdato[5]);
                    printf("</td>");
                    printf("<td height='80' align='center'>" . $cupdato[4] . "</td>");
                    printf("</tr>");
                }

                printf("</table>");
                ?>


            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sitio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">


                                <div class="row">
                                    <div class="col-12">
                                        <div class='row'>


                                            <label class="col-2" style="background-color:#f1f1f1;" >Nombre del Sitio</label>
                                            <input class="col-2" type="text" size="30" id="nombresitio" name="nombreSitio" readonly>


                                            <label class="col-2" style="background-color:#f1f1f1;" >Url del Sitio</label>
                                            <input class="col-2" type="text" size="30" id="urlsitio" name="urlsitio" readonly>

                                            <label class="col-2" style="background-color:#f1f1f1;" >Horario</label>
                                            <input class="col-2" type="text" id="horario" readonly>

                                        </div>
                                        <div class="row">

                                            <label class="col-2" style="background-color:#f1f1f1;" >Telefono 1</label>
                                            <input class="col-2" type="text" size="20" id="tel1" name="tel1" readonly>


                                            <label class="col-2" style="background-color:#f1f1f1;" >Telefono 2</label>
                                            <input class="col-2" type="text" size="20" name="tel2" id="tel2" readonly>


                                            <label class="col-2" style="background-color:#f1f1f1;" >Capacidad</label>
                                            <input class="col-2" type="text" size="20" name="tam" id="capacidad" readonly>
                                        </div>


                                        <div class="row justify-content-center align-items-center">

                                            <label for="dir" class="col-2" style="background-color:#f1f1f1;" >Direccion</label>
                                            <textarea class="col-4" name="dir" rows="3" cols="35" id="dir" readonly></textarea>


                                            <div class="col-2">
                                                <label>Imagen Perfil:</label><br>
                                                <img id="idperfil" class="img-fluid img-thumbnail" style="width: 190px; height: auto;">

                                            </div> 
                                            <div class="col-2">
                                                <label>Carta:</label><br>
                                                <input class="btn" type="button" data-toggle='modal' id='carta' data-target='#modalPDF' data-14='<?php printf($cupdato[14]); ?>'>
                                            </div>
                                            <div class="col-2 text-center  h-100 justify-content-center align-items-center">
                                                    <input class="btn" type="button"  data-toggle='modal' id='gal' name="gal" data-target='#ValidarmodalGalery'  value='Galeria'>
                                                </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-2" style="background-color:#f1f1f1;" >Descripcion Corta ESPAÑOL:</label>
                                            <input class="col-4" type="text" id="descripcion_cortaES"  size="25" name="descripcion_corta"  readonly>
                                            <label class="col-2" style="background-color:#f1f1f1;" >Descripcion Larga ESPAÑOL:</label>
                                            <textarea class="col-4" id="descripcion_largaES" name="descripcion_larga" rows="5" cols="78"  readonly></textarea>
                                        </div>

                                        <div class="row">
                                            <label class="col-2"style="background-color:#f1f1f1;" >Descripcion Corta INGLES:</label>
                                            <input class="col-4" type="text" id="descripcion_cortaEN"  size="25" name="descripcion_corta"  readonly>
                                            <label class="col-2" style="background-color:#f1f1f1;" >Descripcion Larga INGLES:</label>
                                            <textarea class="col-4" id="descripcion_largaEN" name="descripcion_larga" rows="5" cols="78"  readonly></textarea>
                                        </div>
                                        <div class="row">
                                            <label class="col-2"style="background-color:#f1f1f1;" >Descripcion Corta FRANCES:</label>
                                            <input class="col-4" type="text" id="descripcion_cortaFR"  size="25" name="descripcion_corta"  readonly>
                                            <label class="col-2" style="background-color:#f1f1f1;" >Descripcion Larga FRANCES:</label>
                                            <textarea class="col-4" id="descripcion_largaFR" name="descripcion_larga" rows="5" cols="78"   readonly></textarea>
                                        </div>





</div></div>
                                    </div>





                                    <div class="col-12" style="padding-top:25px;"> 
                                        <label>Municipio</label>
                                        <input type="text" size="30" id="municipio" name="municipio" readonly>


                                        <div class="row col-8" style="height: 415px; width: 730px;">
                                            <div id="map" style="height: 400px; width: 730px; z-index: 2; position: absolute;">
                                            </div>



                                            <script>
                                                var marker;
                                                var marker2;
                                                var map;
                                                function initMap() {
                                                    var myLatlng = {lat: 19.8301251, lng: -90.53490870000002};

                                                    map = new google.maps.Map(document.getElementById('map'), {
                                                        zoom: 13,
                                                        center: myLatlng,
                                                        streetViewControl: false
                                                    });

                                                    marker = new google.maps.Marker({
                                                        position: myLatlng,
                                                        map: map,
                                                        title: 'Click to zoom'
                                                    });

                                                }

                                            </script>
                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXVeZ4ei2IHiQ6xt-oV2Sq7Fx8bKqswd4&callback=initMap"
                                            async defer></script>

</div>

                                        <div class="col-12" style="padding-top:25px; background-color:#f1f1f1;" >
                                            <label class="col-12">Coordenadas</label>
	                                         <input class="col-5" id="posx" type="text" size="90" name="cordx" readonly>
	                                            <input class="col-5" id="posy" type="text" size="90" name="cordy" readonly>
                                                        <div class="form-group">
                                        <label for="messagetext" class="col-form-label">Comentario</label>
                                        <textarea id="messagetext" class="form-control" ></textarea>
                                    </div>
                                        <div class="col-12" style="padding-top:25px; padding-bottom: 25px;">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="aprobar">Aprobar</button>
                                            <button type="button" class="btn btn-danger" id="rechazar">Rechazar</button>
					</div>
                                            </div>
                                        </div>

                                    </div> 
                                </div>  





                                <div class="modal-footer">
                                    
                                </div>


                            </div>  </div>
                    </div>
                </div>
            </div>

<?php include '../includes/Validar_modalGaleria.php'; ?>
            <div class="modal h-100" id="modalPDF">
                <div class="modal-dialog modal-lg h-100">
                    <div class="modal-content" style="height: 95%;">

                        <!-- Modal Header -->
                        <div class="modal-header">

                            <h4 class="modal-title">Carta</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center" style="height: 87%;">
                            <embed  type="application/pdf" id="srcpdf" style="width: 100%; height: 100%;">
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer2">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <script>
                                                $('#exampleModal').on('show.bs.modal', function (event) {
                                                    var button = $(event.relatedTarget); // Button that triggered the modal
                                                    var recipient = button.data('whatever');
                                                    var dat0 = button.data('0');
                                                    var dat1 = button.data('1');
                                                    var dat2 = button.data('2');
                                                    var dat3 = button.data('3');
                                                    var dat4 = button.data('4');
                                                    var dat5 = button.data('5');
                                                    var dat6 = button.data('6');
                                                        if(dat6==='R'){
                                                        alert('Debe esperar que el Usuario realice las correcciones');
                                                        $("#exampleModal").on('shown.bs.modal', function () {
                                                            $("#exampleModal").modal("hide");
                                                         });
                                                    }
                                                    var dat7 = button.data('7');
                                                    var dat8 = button.data('8');
                                                    var dat9 = button.data('9');
                                                    var dat10 = button.data('10');
                                                    var dat11 = button.data('11');
                                                    var dat13 = button.data('13');
                                                    var dat14 = button.data('14');
                                                    var dat15 = button.data('15');
                                                    var dat16 = button.data('16');
                                                    var dat17 = button.data('17');

                                                    var dat18 = button.data('18');
                                                    var dat19 = button.data('19');
                                                    var dat20 = button.data('20');
                                                    var dat21 = button.data('21');
                                                    var dat22 = button.data('22');
                                                    var dat23 = button.data('23');
                                                     var dat24 = button.data('24');
                                                    
                                                    var dat25 = button.data('25');
                                                    var dat26 = button.data('26');
                                                    var dat27 = button.data('27');
                                                    var dat28 = button.data('28');
                                                    var dat29 = button.data('29');

                                                    var posi = new google.maps.LatLng({lat: dat15, lng: dat16});

                                                    // Extract info from data-* attributes
                                                    document.getElementById('nombresitio').value = dat3;
                                                    document.getElementById('urlsitio').value = dat5;
                                                    document.getElementById('municipio').value = dat7;
                                                    document.getElementById('tel1').value = dat8;
                                                    document.getElementById('tel2').value = dat9;
                                                    document.getElementById('dir').value = dat3;
                                                 
                                                    document.getElementById('idperfil').src = "../Imagenes/Sitios/img/" + dat13+".jpg";
                                                    document.getElementById('srcpdf').src = "../Imagenes/Sitios/carta/" + dat14+".pdf";
                                                    document.getElementById('carta').value = dat14;
                                                    document.getElementById('capacidad').value = dat10;
                                                    document.getElementById('horario').value = dat4;
                                                    document.getElementById('posx').value = dat15;
                                                    document.getElementById('posy').value = dat16;

                                                    document.getElementById('descripcion_cortaEN').value = dat19;
                                                    document.getElementById('descripcion_cortaES').value = dat21;

                                                    document.getElementById('descripcion_cortaFR').value = dat23;

                                                    document.getElementById('descripcion_largaEN').value = dat20;
                                                    document.getElementById('descripcion_largaES').value = dat22;
                                                    document.getElementById('descripcion_largaFR').value = dat24;
                                                    
                                                    document.getElementById('img1').src = "../Imagenes/Galeria/" + dat25;
                                                    document.getElementById('img2').src = "../Imagenes/Galeria/" + dat26;
                                                    document.getElementById('img3').src = "../Imagenes/Galeria/" + dat27;
                                                    document.getElementById('img4').src = "../Imagenes/Galeria/" + dat28;
                                                    document.getElementById('img5').src = "../Imagenes/Galeria/" + dat29;
                                                    document.getElementById('imgp1').src = "../Imagenes/Galeria/" + dat25;


                                                    marker.setPosition(posi);
                                                    map.setCenter(posi);
                                                    map.setZoom(15);

                                                    $('#aprobar').click(function () {
                                                        var msgtxt = document.getElementById('messagetext').value;
                                                        document.location.href = "../Controller/validarSitios_controller.php?opc=A&sitio=" + dat1 + "&coment=" + msgtxt + "&revision=" + dat17;

                                                    });
                                                    $('#rechazar').click(function () {
                                                        var msgtxt = document.getElementById('messagetext').value;
                                                        document.location.href = "../Controller/validarSitios_controller.php?opc=R&sitio=" + dat1 + "&coment=" + msgtxt + "&revision=" + dat17;

                                                    });

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                                                    var modal = $(this);
                                                    modal.find('.modal-title').text('Sitio  :  ' + recipient);
                                                    //modal.find('.modal-body input').val(recipient);
                                                });
            </script>

            <br>
<?php
include '../includes/footer.php';
?>
  

