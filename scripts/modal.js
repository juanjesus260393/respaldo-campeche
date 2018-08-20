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
