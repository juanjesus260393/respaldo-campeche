
function confirmar() {
    var input = document.getElementById('id_video_archivo');
    var file = input.files[0];
    if (file.size > 200000000) {
        alert('El archivo supera el tamaño permitido selecciona otro');
    }
}
function validateForm()
    {
        var a=document.forms["Form"]["titulo"].value;
        var b=document.forms["Form"]["descripcion"].value;
        var c=document.forms["Form"]["precio"].value;
        var d=document.forms["Form"]["id_img_preview"].value;
        var e=document.forms["Form"]["id_video_archivo"].value;
        if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d=="" || e=="")
        {
            alert("Tienes que llenar todos los campos primero");
            return false;
        }
    }


  
function ValidarImagenvp(obj){
    var uploadFile = obj.files[0];
    
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    }
    else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 1280 && this.height.toFixed(0) >= 720) {
                alert('El tamaño de la imagen tiene que ser menor a 1280 x 720 selecciona otra por favor');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}
function ValidarImagenf(obj){
    var uploadFile = obj.files[0];
    
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    }
    else {
        var img = new Image();
        img.onload = function () {
            if ((this.width.toFixed(0) >= 338 && this.height.toFixed(0) >= 600 )|| (this.width.toFixed(0) >= 728 && this.height.toFixed(0) >= 90)) {
                alert('Los tamaños para la publicidad pueden ser menor a 338 x 600 o 728 x 90');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}

function ValidarImagenvper(obj){
    var uploadFile = obj.files[0];
    
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    }
    else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 1280 && this.height.toFixed(0) >= 400) {
                alert('El tamaño de la imagen tiene que ser menor a 1280 x 400 selecciona otra por favor');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}

function ValidarImagenl(obj){
    var uploadFile = obj.files[0];
    
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    }
    else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 120 && this.height.toFixed(0) >= 120) {
                alert('El tamaño de la imagen tiene que ser menor a 120 x 120 selecciona otra por favor');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}

function ValidarImagenG(obj){
    var uploadFile = obj.files[0];
    
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    }
    else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 1280 && this.height.toFixed(0) >= 720) {
                alert('El tamaño de la imagen tiene que ser menor a 1280 x 720 selecciona otra por favor');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}