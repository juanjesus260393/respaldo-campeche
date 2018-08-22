

function ValidarImagen(obj){
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
                alert('Las medidas deben ser: 1280 * 720');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}
  function ValidarImagen2(obj){
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
                alert('Las medidas deben ser: 1280 * 720');
            }
           
            else {
                            
            }
        };
        img.src = URL.createObjectURL(uploadFile);
    
       }                 
}