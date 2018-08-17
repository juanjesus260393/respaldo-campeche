<?php 
require_once '../includes/header.php';
?>

        




        <table style='border: 1px solid black' align='center'>

            <tr align='center'>
                <th width='120' align='center'>Titulo</th>
                <th width='220' align='center'>Descripcion</th>
               
              <th width='500' align='center'>Imagen Previa</th>
                <th width='220' align='center'>Status</th>
                 <th width='500' align='center'>Precio</th>
                  </tr>


            <?php
            foreach ($viddatos as $cupdato) {
                ?>

                <tr class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal' data-whatever='<?php printf($cupdato[0]); ?>'
                    data-0='<?php printf($cupdato[0]); ?>' data-1='<?php printf($cupdato[1]); ?>' data-2='<?php printf('%s',$cupdato[2]); ?>' data-3='<?php printf('%s',$cupdato[3]); ?>'
                    data-4='<?php printf($cupdato[4]); ?>' data-5='<?php printf($cupdato[5]); ?>' data-6='<?php printf($cupdato[6]); ?>' data-7='<?php printf($cupdato[7]); ?>' 
                    data-8='<?php printf($cupdato[8]); ?>' data-9='<?php printf($cupdato[9]); ?>' data-10='<?php printf($cupdato[10]); ?>' data-11='<?php printf($cupdato[11]); ?>'>

                    <?php
                         printf("<td height='80' align='center'>%s", $cupdato[1]);
                    printf("</td>");
                        
                      printf("<td height='80' align='center'>%s", $cupdato[2]);
                    printf("</td>");
                    
                    printf("<td align='center'><img src='../Imagenes/Videos/" . $cupdato[5] . "' alt='" . $cupdato[5] . " imagen no disponible' height='80' width='60' ></td>");
                        
                    if($cupdato[10]=='C'){
  
                        printf("<td height='80' align='center'>Sin Revisar </td>");
                    }else if($cupdato[10]=='P'){
                        printf("<td height='80' align='center' style='color: red ;'>Pendiente de corrección </td>");
                        
                    }
               
                    
                    printf("<td height='80' align='center'>". $cupdato[3]);
                    printf("</td>");
 
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
                                                <label>Titulo del Video:</label>                    
                                                <input type="text" id="titulo" name="titulo" placeholder="Titulo del Video" readonly> 
                                                </span></div>
                                            <div class="row">
                                                <video id="videoo" style="width: 400px; height: 400px;" controls class="embed-responsive embed-responsive-16by9 z-depth-1-half"></video>                                               
                                                
                                            </div>
                                            </div>

                                        <div class="col-5 ">
                                            <div class="row"><span>
                                                    <label class="col-4">Precio:</label>
                                                    <input type="text" id="price" name="price" size="22" readonly>
                                                </span></div>
                                            <div class="row">
                                                <label class="col-3" for="Descripcion">Descripcion:</label><span>
                                                <textarea  id="Descripcion" name="Descripcion" rows="5" cols="40"  maxlength="490"  readonly></textarea>
                                                </span></div>

                                            <div class="row"><span>
                                                    <label class="col-4">Imagen Vista Previa:</label><span>
                                                        <img id='ImgVp' style="width: 190px; height: auto;"></span>
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
                    var dat11 = button.data('11');
                    // Extract info from data-* attributes
                    document.getElementById('titulo').value = dat1;
                    document.getElementById('Descripcion').value = dat2;
                    
                    document.getElementById('price').value = dat3;
                    document.getElementById('ImgVp').src = "../Imagenes/Videos/" + dat5;
                    document.getElementById('videoo').src ="../Videos/"+dat6;
                     document.getElementById('videoo').poster = "../Imagenes/Videos/" + dat5;
                 




                    $('#aprobar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarVideo_controller.php?opc=A&video=" + dat0 + "&coment=" + msgtxt+"&name="+dat1;

                    });
                     $('#rechazar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarVideo_controller.php?opc=R&video=" + dat0 + "&coment=" + msgtxt+"&name="+dat1+"&rev="+dat11;

                    });

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this);
                    modal.find('.modal-title').text('Video:  ' + dat1);
                    //modal.find('.modal-body input').val(recipient);
                });
            </script>
            <br>
           <?php 
       require_once '../includes/footer.php';
           ?>