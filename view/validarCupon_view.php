<?php


include '../includes/header.php';


?>
      




        <table style='border: 3px solid black' align='center'>

            <tr align='center'>
                <th width='120' align='center'>Titulo</th>
                <th width='220' align='center'>Descripcion corta</th>
                <th width='500' align='center'>Imagen</th>
              <th width='500' align='center'>Status</th>
                <th width='220' align='center'>Fecha Inicio</th>
                <th width='220' align='center'>Fecha vigencia</th>

            </tr>


            <?php
            foreach ($cupdatos as $cupdato) {
                ?>

                <tr class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal' data-whatever='<?php printf($cupdato[0]); ?>'
                    data-0='<?php printf($cupdato[0]); ?>' data-1='<?php printf($cupdato[1]); ?>' data-2='<?php printf('%s',$cupdato[2]); ?>' data-3='<?php printf('%s',$cupdato[3]); ?>'
                    data-4='<?php printf($cupdato[4]); ?>' data-5='<?php printf($cupdato[5]); ?>' data-6='<?php printf($cupdato[6]); ?>' data-7='<?php printf($cupdato[7]); ?>' 
                    data-8='<?php printf($cupdato[8]); ?>' data-9='<?php printf($cupdato[9]); ?>' data-10='<?php printf($cupdato[10]); ?>'>

                    <?php
                         printf("<td height='80' align='center'>%s", $cupdato[2]);
                    printf("</td>");
                        
                      printf("<td height='80' align='center'>%s", $cupdato[3]);
                    printf("</td>");
                    
                    printf("<td align='center'><img src='../Imagenes/Cupones/VistaPrevia/" . $cupdato[5] . "' alt='" . $cupdato[5] . " imagen no disponible' height='80' width='60' ></td>");
                        
                    if($cupdato[11]=='C'){
  
                        printf("<td height='80' align='center'>Sin Revisar </td>");
                    }else if($cupdato[11]=='P'){
                        printf("<td height='80' align='center' style='color: red ;'>Pendiente de corrección </td>");
                        
                    }
               
                    
                    printf("<td height='80' align='center'>". $cupdato[7]);
                    printf("</td>");
                    printf("<td height='80' align='center'>" . $cupdato[8] . "</td>");
                    printf("</tr>");
                }
                printf("</table>");
                ?>


            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form>
                                    <div class="row no-gutters">
                                        <div class="col-7 ">
                                            <div class='row no-gutters' ><span> 
                                                <label>Titulo del Cupon:</label>                    
                                                <input type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" readonly> 
                                                </span></div>
                                            <div class="row">
                                                <label class="col-3" for="descripcion_larga">Descripcion Larga:</label><span>
                                                <textarea  id="descripcion_larga" name="descripcion_larga" rows="10" cols="40"  maxlength="490"  readonly></textarea>
                                                </span></div> 
                                            <div class="row">
                                                <label class="col-3" for="descripcion_larga">Terminos y Condiciones</label>
                                                <textarea  id="terminos_y_condiciones" name="terminos_y_condiciones" rows="10" cols="40"  maxlength="490"  readonly></textarea>
                                            </div> </div>

                                        <div class="col-5 ">
                                            <div class="row"><span>
                                                    <label class="col-4">Descripcion Corta:</label>
                                                    <input type="text" id="descripcion_corta" name="descripcion_corta" size="22" readonly>
                                                </span></div>



                                            <div class="row"><span>
                                                    <label class="col-4">Vigencia fin:</label>
                                                    <input  type="text" id="vigencia_fin"  name="vigencia_fin" size="23" readonly>
                                                </span></div>
                                            <div class="row"><span>
                                                    <label class="col-4">Vigencia inicio:</label>
                                                    <input  type="text" id="vigencia_inicio"  name="vigencia_inicio" size="22" readonly>
                                                </span></div>
                                            <div class="row"><span>
                                                    <label class="col-4">Limite de cupones:</label>
                                                    <input id="limite_codigos" name="limite_codigos" size="22" readonly>
                                                </span></div>
                                            <div class="row"><span>
                                                    <label class="col-4">Imagen Vista Previa:</label><span>
                                                        <img id='ImgVp' style="width: 190px; height: auto;"></span>
                                                </span></div>
                                            <br>
                                            <div class="row"><span>
                                                    <label class="col-4">Imagen Del Cupon:</label><span>
                                                        <img id='ImgC' style="width: 190px; height: auto;" ></span>
                                                </span></div>
                                        </div></div>
                                    <div class="form-group">
                                        <label for="messagetext" class="col-form-label">Comentario de Rechazo</label>
                                        <textarea id="messagetext" class="form-control" ></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="aprobar">Aprobar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar">Rechazar</button>
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
                    var dat7 = button.data('7');
                    var dat8 = button.data('8');
                    var dat9 = button.data('9');
                    var dat10 = button.data('10');
                    // Extract info from data-* attributes
                    document.getElementById('titulo').value = dat2;
                    document.getElementById('descripcion_corta').value = dat3;
                    document.getElementById('descripcion_larga').value = dat4;
                    document.getElementById('vigencia_inicio').value = dat7;
                    document.getElementById('vigencia_fin').value = dat8;
                    document.getElementById('limite_codigos').value = dat10;
                    document.getElementById('ImgVp').src = "../Imagenes/Cupones/VistaPrevia/" + dat5;
                    document.getElementById('ImgC').src = "../Imagenes/Cupones/" + dat6;
                    document.getElementById('terminos_y_condiciones').value = dat9;





                    $('#aprobar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarCupon_controller.php?opc=A&cupon=" + dat0 +"&revision=" + dat1;

                    });
                     $('#rechazar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarCupon_controller.php?opc=R&cupon=" + dat0 + "&coment=" + msgtxt + "&revision=" + dat1;

                    });

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this);
                    modal.find('.modal-title').text('Cupon  ' + recipient);
                    //modal.find('.modal-body input').val(recipient);
                });
            </script>
            <br>
<?php


include '../includes/footer.php';


?>
