$(document).ready(function(){
$('.main-menu').hide();
	$('.main-menu-button').click(function(){

	$('.main-menu').slideToggle('medium');

	})

});

function cambiarArchivoCss(archivo) {
	document.getElementById("cssArchivo").href = archivo;
}

function validacion() {

	var nombre = document.getElementById("nombre").value;
	var apellido = document.getElementById("apellido").value;
	var number = document.getElementById("number").value;
	var cuit = document.getElementById("cuit").value;
	var mail = document.getElementById("mail").value;
	var usuario = document.getElementById("usuario").value;
	var pass = document.getElementById("pass").value;
	var cpass = document.getElementById("cpass").value;
	var cpass = document.getElementById("cpass").value;
	var archivo = document.getElementById("archivo").value;


	if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
		alert('El campo Nombre no puede estar vacio');
	return false;

	} else if ( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) ) {
		alert('El campo apellido no puede estar vacio');
	return false;

	} else if ( number == null || number.length == 0 || /^\s+$/.test(number) ) {
		alert('El campo Numero de documento no puede estar vacio');
	return false;
	
	} else if ( cuit == null || cuit.length == 0 || /^\s+$/.test(cuit) ) {
		alert('El campo Numero de CUIT no puede estar vacio');
	return false;
	
	} else if ( !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(mail)) ) {
		alert('El campo email debe ser una direccion valida y no puede estar vacio');
	return false;

	} else if ( usuario == null || usuario.length == 0 || usuario.length < 6 || /^\s+$/.test(usuario) ) {
		alert('El campo usuario no puede estar vacio ni contener menos de 6 caracteres');
	return false;
	
	} else if ( usuario == null || usuario.length == 0 || usuario.length < 6 || /^\s+$/.test(usuario) ) {
		alert('El campo usuario no puede estar vacio ni contener menos de 6 caracteres');
	return false;
	} else if ( pass == null || pass.length == 0 || cpass == null || cpass.length == 0 || /^\s+$/.test(pass) || /^\s+$/.test(cpass) || pass != cpass ) {
		alert('Los campos de contraseñas no pueden estar vacios y deben ser identicos');
	return false;
	
	} else if ( archivo == null || archivo.length == 0 || /^\s+$/.test(archivo) ) {
		alert('Subi una foto');
	return false;
	}
 
  // Si el script ha llegado a este punto, todas las condiciones
  // se han cumplido, por lo que se devuelve el valor true
  return true;
}
