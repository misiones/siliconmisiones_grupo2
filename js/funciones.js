function cambiarNombre() {
var nombreIngresado = document.getElementById('nombreIngresado').value;
 document.getElementById("tituloBienvenida").innerHTML = "Bienvenido " + nombreIngresado;
}