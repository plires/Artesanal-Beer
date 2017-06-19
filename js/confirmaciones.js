function confirmacion(usuario){

	var confirma = confirm('Esta por borrar al usuario: ' + usuario + ', esta seguro?');
	if (confirma == true) {
		location.href='borrar.php';
	}
}

