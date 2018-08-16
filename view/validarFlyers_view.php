<?php


include '../includes/header.php';

?>



 <table style='border: 1px solid black' align='center'>

            <tr align='center'>
                <th width='120' align='center'>Empresa</th>
                <th width='220' align='center'>Tipo</th>
                <th width='500' align='center'>Imagen</th>
              
            </tr>


            <?php
            foreach ($flyBan as $flyersBan) {
                ?>

                <tr class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal' 
                    data-0='<?php printf($flyersBan[0]); ?>' data-1='<?php printf($flyersBan[1]); ?>' data-2='<?php printf($flyersBan[1]); ?>' 
                     data-3='<?php printf($flyersBan[3]); ?>' data-4='<?php printf($flyersBan[4]); ?>'>

                    <?php
                         printf("<td height='80' align='center'>%s", $flyersBan[2]);
                    printf("</td>");
                     if($flyersBan[0]=='F'){
  
                        printf("<td height='80' align='center' style='color: blue ;'>Flyer</td>");
                    }else if($flyersBan[0]=='B'){
                        printf("<td height='80' align='center' style='color: red ;'> Banner</td>");
                        
                    }
                    
                    printf("<td style='cursor: pointer;' align='center'><img src='../Imagenes/galleria2.png' alt='" . $flyersBan[1] . " imagen no disponible' height='100' width='100' ></td>");

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
                                                <label>Empresa :</label>                    
                                                <input type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" readonly> 
                                                </span></div>
                                          
                                            <div class="row"><span>
                                                    <label class="col-4">Imagen</label><span>
                                                        <img id='ImgFB' style="width: 600px; height: auto;"></span>
                                                </span></div>
                                            <br>
                                            
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
                    // Extract info from data-* attributes
                    document.getElementById('titulo').value = dat2;
                    document.getElementById('ImgFB').src = "../Imagenes/Publicidad/" + dat1;

                    $('#aprobar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarFlyers_controller.php?opc=A&FoB=" + dat3 + "&coment=" + msgtxt;

                    });
                     $('#rechazar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarFlyers_controller.php?opc=R&FoB=" + dat3 + "&coment=" + msgtxt+"&revision="+dat4;

                    });

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this);
                    if(dat0==='F'){
                    modal.find('.modal-title').text('Flayer');}
                else if(dat0==='B'){
                    modal.find('.modal-title').text('Banner');}
                
                
                    //modal.find('.modal-body input').val(recipient);
                });
            </script>




<?php


include '../includes/footer.php';


?>