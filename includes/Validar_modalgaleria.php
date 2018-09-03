<?php ?>
<script>
    function defaultimg(){
       document.getElementById('imgp1').src = document.getElementById('img1').src;
        
    }
    
    
    
   // $('#izq').on('click', function () {
   function setizq(){
       
        switch (document.getElementById('imgp1').name) {
            case 'img1':
                document.getElementById('imgp1').src = document.getElementById('img5').src;
                document.getElementById('imgp1').name = document.getElementById('img5').name;
                break;
            case 'img2':
                document.getElementById('imgp1').src = document.getElementById('img1').src;
                document.getElementById('imgp1').name = document.getElementById('img1').name;
                break;
            case 'img3':
                document.getElementById('imgp1').src = document.getElementById('img2').src;
                document.getElementById('imgp1').name = document.getElementById('img2').name;
                break;
            case 'img4':
                document.getElementById('imgp1').src = document.getElementById('img3').src;
                document.getElementById('imgp1').name = document.getElementById('img3').name;
                break;
            case 'img5':
                document.getElementById('imgp1').src = document.getElementById('img4').src;
                document.getElementById('imgp1').name = document.getElementById('img4').name;
                break;

        }}
  //  });

    //$('#der').on('click', function () {
     function setder(){
        switch (document.getElementById('imgp1').name) {
            case 'img1':
                document.getElementById('imgp1').src = document.getElementById('img2').src;
                document.getElementById('imgp1').name = document.getElementById('img2').name;
                break;
            case 'img2':
                document.getElementById('imgp1').src = document.getElementById('img3').src;
                document.getElementById('imgp1').name = document.getElementById('img3').name;
                break;
            case 'img3':
                document.getElementById('imgp1').src = document.getElementById('img4').src;
                document.getElementById('imgp1').name = document.getElementById('img4').name;
                break;
            case 'img4':
                document.getElementById('imgp1').src = document.getElementById('img5').src;
                document.getElementById('imgp1').name = document.getElementById('img5').name;
                break;
            case 'img5':
                document.getElementById('imgp1').src = document.getElementById('img1').src;
                document.getElementById('imgp1').name = document.getElementById('img1').name;
                break;

        }}
  //  });


   function set1(){
     document.getElementById('imgp1').src = document.getElementById('img1').src;
      document.getElementById('imgp1').name = document.getElementById('img1').name;
        }
        function set2(){
    document.getElementById('imgp1').src = document.getElementById('img2').src;
                document.getElementById('imgp1').name = document.getElementById('img2').name;
        }
        function set3(){
     document.getElementById('imgp1').src = document.getElementById('img3').src;
                document.getElementById('imgp1').name = document.getElementById('img3').name;
        }
        function set4(){
   document.getElementById('imgp1').src = document.getElementById('img4').src;
                document.getElementById('imgp1').name = document.getElementById('img4').name;
        }
        function set5(){
      document.getElementById('imgp1').src = document.getElementById('img5').src;
                document.getElementById('imgp1').name = document.getElementById('img5').name;
        } 

                                                
/*$("#SetmodalGalery").on('shown.bs.modal', function () {
            $("#exampleModal").modal("hide");
           
        });*/

</script>


<div class="modal" id="ValidarmodalGalery">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title">Galeria </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">

                <div class="row justify-content-center align-items-center">
                    <div class="col">
                        <img id="izq" onclick="setizq()" onmouseout="this.src = '../Imagenes/web/izq.png';
                                this.style.height = '118px';"
                             onmouseover="this.src = '../Imagenes/web/izq-hover.png'; this.style.height = '400px';"
                             src="../Imagenes/web/izq.png"  width="152" height="118"></div>
                    <div class="col">
                        <img id="imgp1" name="img1"  src="../Imagenes/web/sin.jpg" style=" width: 350px; height:400px;"></div>
                    <div class="col">
                        <img id="der" onclick="setder()" onmouseout="this.src = '../Imagenes/web/der.png'; this.style.height = '118px';"
                             onmouseover="this.src = '../Imagenes/web/der-hover.png'; this.style.height = '400px';"   src="../Imagenes/web/der.png"  width="152" height="118">
                    </div>
                </div>
                <div class="d-inline">
                    <label  class="btn btn-light">
                        <img id="img1" name="img1" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30" onclick="set1()">
                    </label>
                    
                    <label  class="btn btn-light">
                        <img id="img2" name="img2" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30" onclick="set2()">
                    </label>
                    
                    <label  class="btn btn-light">
                        <img id="img3" name="img3" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30" onclick="set3()">
                    </label>
                    
                    <label  class="btn btn-light">
                        <img id="img4" name="img4" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30" onclick="set4()">
                    </label>
                    
                    <label  class="btn btn-light">
                        <img id="img5" name="img5" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30" onclick="set5()">
                    </label>
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
