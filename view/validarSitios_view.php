<?php


include '../includes/header.php';


?>
      
       


        <div id="tablesitios" class="">

        <table  style='border: 3px solid black' align='center'>

            <tr align='center'>
                <th width='120' align='center'>Logo</th>
                <th width='220' align='center'>Nombre</th>
                <th width='500' align='center'>Direccion</th>
              <th width='500' align='center'>Status</th>
                <th width='220' align='center'>Url Sitio</th>
                <th width='220' align='center'>Horario</th>

            </tr>


            <?php
            foreach ($sitios as $sitdato) {
                ?>

            <tr onclick=hidetable() class='btn-outline-primary'  id='trsitios'  data-whatever='<?php printf($sitdato[0]); ?>'
                    data-0='<?php printf($sitdato[0]); ?>' data-1='<?php printf($sitdato[1]); ?>' data-2='<?php printf('%s',$sitdato[2]); ?>' data-3='<?php printf('%s',$sitdato[3]); ?>'
                    data-4='<?php printf($sitdato[4]); ?>' data-5='<?php printf($sitdato[5]); ?>' data-6='<?php printf($sitdato[6]); ?>' data-7='<?php printf($sitdato[7]); ?>' 
                    data-8='<?php printf($sitdato[8]); ?>' data-9='<?php printf($sitdato[9]); ?>' data-10='<?php printf($sitdato[10]); ?>' data-11='<?php printf($sitdato[11]); ?>'
                    data-12='<?php printf($sitdato[12]); ?>' data-13='<?php printf($sitdato[13]); ?>' data-14='<?php printf($sitdato[14]); ?>' data-15='<?php printf($sitdato[15]); ?>'>

                    <?php
                    
                    printf("<td align='center'><img src='../Imagenes/Sitios/logo/" . $sitdato[0] . "' alt='" . $sitdato[0] . " imagen no disponible' height='80' width='60' ></td>");
                         printf("<td height='80' align='center'>%s", $sitdato[2]);
                    printf("</td>");
                        
                      printf("<td height='80' align='center'>%s", $sitdato[3]);
                    printf("</td>");
                    
                        
                    if($sitdato[6]=='C'){
  
                        printf("<td height='80' align='center'>Sin Revisar </td>");
                    }else if($sitdato[6]=='P'){
                        printf("<td height='80' align='center' style='color: red ;'>Pendiente de corrección </td>");
                        
                    }
               
                    
                    printf("<td height='80' align='center'>". $sitdato[5]);
                    printf("</td>");
                    printf("<td height='80' align='center'>" . $sitdato[4] . "</td>");
                    printf("</tr>");
                }
               ?>
               </table>
                

                    </div>       
            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="aprobar">Aprobar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar">Rechazar</button>
                       
            <script>
                
                    function hidetable(){
                    document.getElementById('tablesitios').classList.add('d-none');
        var recipient = button.data('whatever');
                                      }
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





                    $('aprobar').click(function () {
                        
                        document.location.href = "../Controller/validarCupon_controller.php?opc=A&cupon=" + dat0 +"&revision=" + dat1;

                    });
                     $('#rechazar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarCupon_controller.php?opc=R&cupon=" + dat0 + "&coment=" + msgtxt + "&revision=" + dat1;

                    });

              
            </script>
            <br>
<?php


include '../includes/footer.php';


?>
