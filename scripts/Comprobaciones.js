
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
