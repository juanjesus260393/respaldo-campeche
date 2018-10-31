//funcion en javascript que se encerga de medir el tamaño de un video y regresar una alerta cuando se ha superado dicho limite envia una alerta
function confirmar() {
    var input = document.getElementById('id_video_archivo');
    var file = input.files[0];
    if (file.size > 200000000) {
        alert('El archivo supera el tamaño permitido selecciona otro');
    }
}

function habilitar(e) {
    // los deshabilitamos todos
    var inputs = document.querySelectorAll("input[type=file]");
    for (var i = 0; i < inputs.length; i++)
    {
        inputs[i].disabled = true;
    }
    document.getElementsByName(e.id)[0].disabled = false;
}
//funcion que se encarga de validar la estructura de un correo que se esta escribiendo en el cuadro de texto username
function validarcorreo() {
    document.getElementById('username').addEventListener('input', function () {
        campo = event.target;
        valido = document.getElementById('emailOK');
        emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        if (emailRegex.test(campo.value)) {
            //si el correo ingresado coincide con el patron establecido no se muestra nada
            valido.innerText = "";
        } else {
            //si el correo ingresado no  coincide con el patron establecido se muestra el siguiente mensaje
            valido.innerText = "Correo inválido";
        }
    });
}

function ValidURL() {
    var url = document.getElementById("url_sitio").value;
    var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if (pattern.test(url)) {
    }
    alert("Direccion electronica incorrecta");
    return false;

}

function Validemail() {
    var url = document.getElementById("usernamep").value;
    var pattern = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (pattern.test(url)) {
    } else {
        alert("Correo electronico incorrecto");
    }
    return false;

}
//funcion que se encarga de validar que la contraseña no contenga espacios en blanco
function validarespaciosvacioscontraseña() {
    document.getElementById('password').addEventListener('input', function () {
        campo = event.target;
        valido = document.getElementById('passOK');
        emailRegex = /[ ]/;
        if (emailRegex.test(campo.value)) {
            valido.innerText = "Espacio Vacio";
        } else {
            valido.innerText = "";
        }
    });
}
//funcion que muestra la contraseña ingresada por una empresa
function showpassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function validateForm()
{
    var a = document.forms["Form"]["titulo"].value;
    var b = document.forms["Form"]["descripcion"].value;
    var c = document.forms["Form"]["precio"].value;
    var d = document.forms["Form"]["id_img_preview"].value;
    var e = document.forms["Form"]["id_video_archivo"].value;
    if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "" || e == "")
    {
        alert("Tienes que llenar todos los campos primero");
        return false;
    }
}

//Funcion que valida el tipo y dimension de la imagen del cupon que tiene que ser de 120 X 120 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenc(obj) {
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }
    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 121 && this.height.toFixed(0) >= 121) {
                alert('El tamaño de la imagen tiene que ser menor a 120 x 120 selecciona otra por favor');
            } else {

            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}
//Funcion que valida el tipo y dimension de la imagen  previa del cupon que tiene que ser de 1280 X 720 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenvp(obj) {
    var uploadFile = obj.files[0];
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }
    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 1280 && this.height.toFixed(0) >= 720) {
                alert('El tamaño de la imagen tiene que ser menor a 1280 x 720 selecciona otra por favor');
            } else {

            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}
//Funcion que valida el tipo y dimension de los flyers que tiene que ser de 338 x 600 o 728 x 90 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenf(obj) {
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 339 && this.height.toFixed(0) >= 601) {
                alert('El tamaño para los flyer tiene que ser menor a 338 x 600');
            } else {

            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}
//Funcion que valida el tipo y dimension de la publicidad que tiene que ser de 338 x 600 o 728 x 90 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenb(obj) {
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 729 && this.height.toFixed(0) >= 91) {
                alert('El tamaño para los banner tiene que ser menor a 728 x 90');
            } else {

            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}
//Funcion que valida el tipo y dimension de la vista previa de los videos que tiene que ser de 1280 X 400 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenvper(obj) {

    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {

            if (this.width.toFixed(0) >= 1280 && this.height.toFixed(0) >= 400) {
                alert('El tamaño de la imagen tiene que ser menor a 1280 x 400 selecciona otra por favor');
            } else {

            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}
//Funcion que valida el tipo y dimension de la imagen del logo que tiene que ser de 120 x 120 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenl(obj) {
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {

            if (this.width.toFixed(0) >= 120 && this.height.toFixed(0) >= 120) {
                alert('El tamaño de la imagen tiene que ser menor a 120 x 120 selecciona otra por favor');
            } else {
            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}
//Funcion que valida el tipo y dimension de las imagenes de la galeria que tiene que ser de 1280 X 720 pixeles
//En caso de no coincidir la resolucion con la establecida se muestra una alerta
function ValidarImagenG(obj) {
    var uploadFile = obj.files[0];

    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
        alert('El archivo a adjuntar no es una imagen');
    } else {
        var img = new Image();
        img.onload = function () {
            if (this.width.toFixed(0) >= 1281 && this.height.toFixed(0) >= 721) {
                alert('El tamaño de la imagen tiene que ser menor a 1280 x 720 selecciona otra por favor');
            } else {

            }
        };
        img.src = URL.createObjectURL(uploadFile);

    }
}