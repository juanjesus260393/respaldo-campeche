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


    var openfile1 = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('img1');
            output.src = dataURL;
            document.getElementById('imgp1').src = dataURL;
            document.getElementById('imgp1').name = 'img1';
        };
        reader.readAsDataURL(input.files[0]);
    };
 var openfile2 = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('img2');
            output.src = dataURL;
            document.getElementById('imgp1').src = dataURL;
            document.getElementById('imgp1').name = 'img2';
        };
        reader.readAsDataURL(input.files[0]);
    };
 var openfile3 = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('img3');
            output.src = dataURL;
            document.getElementById('imgp1').src = dataURL;
            document.getElementById('imgp1').name = 'img3';
        };
        reader.readAsDataURL(input.files[0]);
    };
 var openfile4 = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('img4');
            output.src = dataURL;
            document.getElementById('imgp1').src = dataURL;
            document.getElementById('imgp1').name = 'img4';
        };
        reader.readAsDataURL(input.files[0]);
    };
 var openfile5 = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('img5');
            output.src = dataURL;
            document.getElementById('imgp1').src = dataURL;
            document.getElementById('imgp1').name = 'img5';
        };
        reader.readAsDataURL(input.files[0]);
    };


                                                
/*$("#SetmodalGalery").on('shown.bs.modal', function () {
            $("#exampleModal").modal("hide");
           
        });*/

</script>


<div class="modal" id="SetmodalGalery">
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
                        <img id="izq" onclick="setizq()" onmouseout="this.style.backgroundColor = 'white';"
                             onmouseover="this.style.backgroundColor = '#f1f1f1';"
                             src="../Imagenes/web/izq.png"  width="152" height="118"></div>
                    <div class="col">
                        <img id="imgp1" name="img1"  src="../Imagenes/web/sin.jpg" style=" width: 350px; height:400px;"></div>
                    <div class="col">
                        <img id="der" onclick="setder()" onmouseout="this.style.backgroundColor = 'white';"
                             onmouseover="this.style.backgroundColor = '#f1f1f1';"   src="../Imagenes/web/der.png"  width="152" height="118">
                    </div>
                </div>
                <div class="d-inline">
                    <label for="file1" class="btn btn-light">
                        <img id="img1" name="img1" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30">
                    </label>
                    <input id="file1" name="file1" type="file" class="d-none" accept=".jpg" onchange="openfile1(event)" form="setsitiosform">
                    <label for="file2" class="btn btn-light">
                        <img id="img2" name="img2" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30">
                    </label>
                    <input id="file2" name="file2" type="file" class="d-none" accept=".jpg" onchange="openfile2(event)" form="setsitiosform">
                    <label for="file3" class="btn btn-light">
                        <img id="img3" name="img3" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30">
                    </label>
                    <input id="file3" name="file3" type="file" class="d-none" accept=".jpg" onchange="openfile3(event)" form="setsitiosform">
                    <label for="file4" class="btn btn-light">
                        <img id="img4" name="img4" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30">
                    </label>
                    <input id="file4" name="file4" type="file" class="d-none" accept=".jpg" onchange="openfile4(event)" form="setsitiosform">
                    <label for="file5" class="btn btn-light">
                        <img id="img5" name="img5" src="../Imagenes/web/sin.jpg" class="img-fluid" width="100" height="30">
                    </label>
                    <input id="file5" name="file5" type="file" class="d-none" accept=".jpg" onchange="openfile5(event)" form="setsitiosform">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
