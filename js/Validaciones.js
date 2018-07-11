function validar_pass() {


var p1 = document.getElementById("password").value;
var p2 = document.getElementById("password2").value;
var espacios = false;
var cont = 0;
 
while (!espacios && (cont < p1.length)) {
  if (p1.charAt(cont) == " ")
    espacios = true;
  cont++;
}
 
if (espacios) {
  alert ("La contraseña no puede contener espacios en blanco");
  
  document.getElementById("setpas").reset();
  return false;
  }
else if (p1.length == 0 || p2.length == 0) {
  alert("Los campos de la password no pueden quedar vacios");
  document.getElementById("setpas").reset();
  return false;
  }
else if (p1 != p2) {
  alert("Las passwords deben de coincidir");

   document.getElementById("setpas").reset();
   return false;
  }
else {
  alert("Todo esta correcto");
  return true;
  }}

function soloNum(){
   
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}

function soloLetras() {
 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
  event.returnValue = false;
}
