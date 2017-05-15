<?php

session_start();

/**
 * [Funcion para capturar errores de formularios]
 * @param  [Array] $informacion [Recibe los datos del POST del formulario]
 * @return [Array] $errores [Devuelve un array con los errores]
 */
function validarInformacion($informacion){

	$errores = [];

	/* Asignamos a la variable el valor traido del POST */
	$nombre = trim($informacion['nombre']);

	/* Chequeamos que el campo nombre no este vacio */
	if (strlen($nombre) == 0) {
		$errores['nombre'] = "Ingresa tu nombre...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$apellido = trim($informacion['surname']);

	/* Chequeamos que el campo apellido no este vacio */
	if (strlen($apellido) == 0) {
		$errores['surname'] = "Ingresa tu apellido...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$tipo = trim($informacion['document']);
	$numero = trim($informacion['numero']);

	/* Chequeamos que el campo documento sea numerico, no este repetido y no este vacio */
	if (!is_numeric($numero)) {
		$errores['numero'] = "El campo del documento debe ser un número...(ej: 30xxx5555)";
	} elseif (strlen($numero) == 0) {
		$errores['numero'] ="Ingresa tu numero de documento...";
	} elseif (buscarPorDocumento($tipo, $numero) != false) {
      $errores['numero'] = "El tipo y numero de documento ya existe";
    }

	/* Asignamos a la variable el valor traido del POST */
	$cuit = trim($informacion['cuit']);
	
	/* Chequeamos que el campo edad sea numerico y no este vacio */
	if (!is_numeric($cuit)) {
		$errores['cuit'] = "El campo del cuit debe ser un número...(ej: 2030xxx5555)";
	} elseif (strlen($cuit) == 0) {
		$errores['cuit'] ="Ingresa tu cuit...";
	} elseif (strlen($cuit) != 11) {
		$errores['cuit'] ="Para tu cuit, ingresa 11 numeros sin guiones ni puntos (ej: 2030xxx5555)";
	} elseif (buscarPorCuit($cuit) != false) {
      $errores['cuit'] = "El numero de cuit ya existe";
    }

    /* Asignamos a la variable el valor traido del POST */
	$correo = trim($informacion["correo"]);

    if (strlen($correo) == 0) {
      $errores["correo"] = "Ingresa tu email...";
    } elseif (! filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $errores["correo"] = "El email debe ser una dirección válida...";
    } elseif (buscarPorMail($correo) != false) {
      $errores["correo"] = "El email ya existe";
    }

	/* Asignamos a la variable el valor traido del POST */
	$user = trim($informacion['user']);
	
	/* Chequeamos que el usuario nombre no este vacio, que no exista y que contenga mas de 6 caracteres */
	if (strlen($user) == 0 ) {
		$errores['user'] = "Ingresa tu usuario...";
	} elseif (strlen($user) < 6 ) {
		$errores['user'] = "El usuario debe tener más de 6 caracteres";
	} elseif (buscarPorUsuario($user) != false) {
    	$errores['user'] = "El usuario ya existe";
    }

	/* Asignamos a la variable el valor traido del POST */
	$pass = trim($informacion['pass']);

	/* Chequeamos que el campo pass no este vacio */
	if (strlen($pass) == 0) {
		$errores['pass'] = "Ingresa tu contraseña...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$cpass = trim($informacion['cpass']);

	/* Chequeamos que el campo cpass no este vacio */
	if (strlen($cpass) == 0) {
		$errores['cpass'] = "Confirma tu contraseña...";
	}

	/* Chequeamos que el ambos campos de contraseña coincidan */
	if ($pass != "" && $cpass != "" && $pass != $cpass) {
		$errores['pass'] = "Las contraseñas no coinciden...";
	}

	/* Chequeamos la subida del archivo */
	if ($_FILES['archivo']['error'] == UPLOAD_ERR_OK) {

		$nombre_archivo = $_FILES['archivo'] ['name']; /* capturamos el nombre del archivo */
		$archivo = $_FILES['archivo'] ['tmp_name']; /* capturamos el archivo en si */

		$ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION); /* capturamos la extencion del archivo */

		/* Nos aseguramos que se suban archivos compatibles con las extenciones dadas */
		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			$miArchivo = dirname(__FILE__); /* asignamos a la variable el nombre del archivo */
			$miArchivo = $miArchivo . "/../upload/"; /* Le agregamos a la misma variable un nombre de directorio donde guardar los archivos */
			$miArchivo = $miArchivo . $_POST["user"] . "." . $ext; /* Le colocamos de nombre al archivo el nombre de usuario y le sumamos la extencion */

			move_uploaded_file($archivo, $miArchivo); /* Procedemos a colocar el archivo en el destino */
		}
		else {
			$errores['archivo'] = "Formatos admitidos de imágenes: JPG y PNG...";
		}
	} else {

		$errores['archivo'] = "Hubo un error en la carga de tu archivo...";

	}
	return $errores;
}


/**
 * [Funcion para capturar errores de formularios de edicion]
 * @param  [Array] $informacion [Recibe los datos del POST del formulario]
 * @return [Array] $errores [Devuelve un array con los errores]
 */
function validarInformacionEditada($informacion){

	$errores = [];

	/* Asignamos a la variable el valor traido del POST */
	$nombre = trim($informacion['nombre']);

	/* Chequeamos que el campo nombre no este vacio */
	if (strlen($nombre) == 0) {
		$errores['nombre'] = "Ingresa tu nombre...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$apellido = trim($informacion['surname']);

	/* Chequeamos que el campo apellido no este vacio */
	if (strlen($apellido) == 0) {
		$errores['surname'] = "Ingresa tu apellido...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$tipo = trim($informacion['document']);
	$numero = trim($informacion['numero']);

	/* Chequeamos que el campo documento sea numerico, no este repetido y no este vacio */
	if (!is_numeric($numero)) {
		$errores['numero'] = "El campo del documento debe ser un número...(ej: 30xxx5555)";
	} elseif (strlen($numero) == 0) {
		$errores['numero'] ="Ingresa tu numero de documento...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$cuit = trim($informacion['cuit']);
	
	/* Chequeamos que el campo edad sea numerico y no este vacio */
	if (!is_numeric($cuit)) {
		$errores['cuit'] = "El campo del cuit debe ser un número...(ej: 2030xxx5555)";
	} elseif (strlen($cuit) == 0) {
		$errores['cuit'] ="Ingresa tu cuit...";
	} elseif (strlen($cuit) != 11) {
		$errores['cuit'] ="Para tu cuit, ingresa 11 numeros sin guiones ni puntos (ej: 2030xxx5555)";
	}

    /* Asignamos a la variable el valor traido del POST */
	$correo = trim($informacion["correo"]);

    if (strlen($correo) == 0) {
      $errores["correo"] = "Ingresa tu email...";
    } elseif (! filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $errores["correo"] = "El email debe ser una dirección válida...";
    }

	/* Asignamos a la variable el valor traido del POST */
	$user = trim($informacion['user']);
	
	/* Chequeamos que el usuario nombre no este vacio, que no exista y que contenga mas de 6 caracteres */
	if (strlen($user) == 0 ) {
		$errores['user'] = "Ingresa tu usuario...";
	} elseif (strlen($user) < 6 ) {
		$errores['user'] = "El usuario debe tener más de 6 caracteres";
	}

	/* Asignamos a la variable el valor traido del POST */
	$pass = trim($informacion['pass']);

	/* Chequeamos que el campo pass no este vacio */
	if (strlen($pass) == 0) {
		$errores['pass'] = "Ingresa tu contraseña...";
	}

	/* Asignamos a la variable el valor traido del POST */
	$cpass = trim($informacion['cpass']);

	/* Chequeamos que el campo cpass no este vacio */
	if (strlen($cpass) == 0) {
		$errores['cpass'] = "Confirma tu contraseña...";
	}

	/* Chequeamos que el ambos campos de contraseña coincidan */
	if ($pass != "" && $cpass != "" && $pass != $cpass) {
		$errores['pass'] = "Las contraseñas no coinciden...";
	}

	/* Chequeamos la subida del archivo */
	if ($_FILES['archivo']['name'] != "") {

		$nombre_archivo = $_FILES['archivo'] ['name']; /* capturamos el nombre del archivo */
		$archivo = $_FILES['archivo'] ['tmp_name']; /* capturamos el archivo en si */

		$ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION); /* capturamos la extencion del archivo */

		/* Nos aseguramos que se suban archivos compatibles con las extenciones dadas */
		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			$miArchivo = dirname(__FILE__); /* asignamos a la variable el nombre del archivo */
			$miArchivo = $miArchivo . "/../upload/"; /* Le agregamos a la misma variable un nombre de directorio donde guardar los archivos */
			$miArchivo = $miArchivo . $_POST["user"] . "." . $ext; /* Le colocamos de nombre al archivo el nombre de usuario y le sumamos la extencion */

			move_uploaded_file($archivo, $miArchivo); /* Procedemos a colocar el archivo en el destino */
		}
		else {
			$errores['archivo'] = "Formatos admitidos de imágenes: JPG y PNG...";
		}
	}

	return $errores;
}


/**
 * [Funcion que valida informacion del formulario de login]
 * @param  [Array] $informacion [Recibe el array del POST]
 * @return [Array] $errores [Devuelve los errores en caso de existir]
 */
function verificaLogeo($informacion){

	$errores = [];

	/* Asignamos a la variable el valor traido del POST */
	$user = trim($informacion['user']);

	/* Chequeamos que el usuario nombre no este vacio y que el mismo exista */
	if (strlen($user) == 0 ) {
		$errores['user'] = "Ingresa tu usuario...";
	} elseif (buscarPorUsuario($user) != true) {
		$errores['user'] = "El usuario no existe";		
	}

	$pass = $informacion["pass"];

	/* Chequeamos que el pass nombre no este vacio y que coincida con el guardado */
	$usuario = buscarPorUsuario($user);
	if (strlen($pass) == 0) {
		$errores['pass'] = "Ingresa tu contraseña...";
	} elseif (!password_verify($pass, $usuario['pass'])) {
	    $errores['pass'] = "La contraseña no es valida";
	}

	return $errores;
}


/**
 * [Funcion para el extravio de la contraseña]
 * @param  [Array] $informacion [Recibe los datos del POST del formulario]
 * @return [Array] $errores [Devuelve un array con los errores]
 */
function validarInformacionRecovery($informacion){

	$errores = [];

	/* Asignamos a la variable el valor traido del POST */
	$correo = trim($informacion["correo"]);

    if (strlen($correo) == 0) {
      $errores["correo"] = "Ingresa tu email...";
    } elseif (! filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $errores["correo"] = "El email debe ser una dirección válida...";
    } elseif (buscarPorMail($correo) == false) {
      $errores["correo"] = "El email nunca fue registrado";
    }

    return $errores;
}


/**
 * [Funcion para asignar el valor de id a un usuario nuevo]
 * @return [Integer] $id [Devuelve una variable con el valor del ultimo id + 1]
 */
function traerNuevoId(){
	$usuarios = traerTodos();

	// si no existe ningun registro inicializamos los id con el numero 1
	if (count($usuarios) == 0) {
      return 1;
    }

	$id =1;

    foreach ($usuarios as $usuario) {
    	if ($usuario['id'] > $id) {
    		$id = $usuario['id'];
    	}
    }

    // Le sumamos uno y lo devolvemos
    return $id + 1;

}


/**
 * [Funcion para traer a todos los usuarios registrados]
 * @return [Array] $usuariosFinal [Devuelve un array con todos los usuarios]
 */
function traerTodos(){
	// Obtengo el contenido del archivo usuarios.json
	$archivo = file_get_contents("usuarios.json");
	
	// divido el archivo con cada ENTER
	$usuarios_json = explode(PHP_EOL, $archivo);

	// extraigo el ultimo enter de la linea
	array_pop($usuarios_json);

	//creo el array que voy a devolver finalmente
	$usuariosFinal = [];

    // y cada linea la convierto de JSON a Array asociativo
    foreach ($usuarios_json as $json) {
    	$usuariosFinal[] = json_decode($json, TRUE);
    }

    return $usuariosFinal;
}



/**
 * [Funcion que Trae todos los usuarios menos el que se esta editando. Devuelve array asociativo]
 * @param  [Integer] $id [Recibe un id]
 * @return [Array] $usuariosFinal [Devuelve un array con todos los usuarios excepto el que tiene el id del parametro]
 */
function traerTodosMenosUno($id){
	// Obtengo el contenido del archivo usuarios.json
	$archivo = file_get_contents("usuarios.json");

	// divido el archivo con cada ENTER
	$usuarios_json = explode(PHP_EOL, $archivo);

	// extraigo el ultimo enter de la linea
	array_pop($usuarios_json);

	//creo el array que voy a devolver finalmente
	$usuariosFinal = [];

	//creo el array transitorio para comparar
	$usuarioTransitorio = [];

    // y cada linea la convierto de JSON a Array asociativo (menos el id citado)
    foreach ($usuarios_json as $json) {
    	$usuarioTransitorio = json_decode($json, TRUE);
    	if ($usuarioTransitorio['id'] != $id) {
    		$usuariosFinal[] = json_decode($json, TRUE);
    	}
    }

    return $usuariosFinal;

}


/**
 * [Funcion que puede buscar por cualquier campo]
 * @param  [String] $term  [Recibe usuario, mail, dni, etc]
 * @param  [String] $value [Recibe el valor]
 * @return [Array]  $usuario [Devuelve un array con los datos del usuario encontrado]
 */
function searchByTerm($term, $value){
	$usuarios = traerTodos();
	foreach($usuarios as $usuario){
		if($usuario[$term] == $value){
			return $usuario;
		}
	}
	return false;
}

/**
 * [Funcion que busca al usuario por email]
 * @param  [String] $email [Recibe un email]
 * @return [Array] $usuario [Devuelve un array con los datos del usuario encontrado]
 */
function buscarPorMail($email) {
	$todos = traerTodos();

	foreach ($todos as $usuario) {
	  if ($usuario["email"] == $email) {
	    return $usuario;
	  }
	}

	return false;
}

/**
 * [Funcion que busca al usuario por user]
 * @param  [String] $user [Recibe un user]
 * @return [Array] $usuario [Devuelve un array con los datos del usuario encontrado]
 */
function buscarPorUsuario($user) {
	$todos = traerTodos();

	foreach ($todos as $usuario) {
	  if ($usuario['user'] == $user) {
	    return $usuario;
	  }
	}

	return false;
}


/**
 * [Funcion que busca al usuario por cuit]
 * @param  [String] $cuit [Recibe un cuit]
 * @return [Array] $usuario [Devuelve un array con los datos del usuario encontrado]
 */
function buscarPorCuit($cuit) {
	$todos = traerTodos();

	foreach ($todos as $usuario) {
	  if ($usuario['cuit'] == $cuit) {
	    return $usuario;
	  }
	}

	return false;
}


/**
 * [Funcion que busca al usuario por tipo y numero de documento]
 * @param  [String] $tipo [Recibe un tipo de documento]
 * @param  [Integer] $numero [Recibe un numero de documento]
 * @return [Array] $usuario [Devuelve un array con los datos del usuario encontrado]
 */
function buscarPorDocumento($tipo, $numero) {
	$todos = traerTodos();

	foreach ($todos as $usuario) {
	  if ($usuario['tipo_documento'] == $tipo && $usuario['numero'] == $numero) {

	    return $usuario;
	  }
	}

	return false;
}


/**
 * [Funcion que busca al usuario por id]
 * @param  [Integer] $id [Recibe un id]
 * @return [Array] $usuario [Devuelve un array con los datos del usuario encontrado]
 */
function buscarPorId($id) {
$todos = traerTodos();

foreach ($todos as $usuario) {
  if ($usuario["id"] == $id) {
    return $usuario;
  }
}

return false;
}


/**
 * [Funcion que crea un usuario nuevo en un array asociativo para poder grabarlo posteriormente]
 * @param  [Array] $Post [Recibe el array del post]
 * @return [Array] $usuario [Devuelve un array con todos los datos a grabar]
 */
function crearUsuario($post){

	$archivo = $post["user"];
	$nombre_archivo = $_FILES['archivo'] ['name']; /* capturamos el nombre del archivo */	
	$ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION); /* capturamos la extencion del archivo */

	$archivo = $archivo . "." . $ext;

	$usuario = [
		"nombre" => $post["nombre"],
		"apellido" => $post["surname"],
		"tipo_documento" => $post["document"],
		"numero" => $post["numero"],
		"genero" => $post["sex"],
		"estado_civil" => $post["social"],
		"ocupacion" => $post["occupation"],
		"cuit" => $post["cuit"],
		"email" => $post["correo"],
		"user" => $post["user"],
		"pass" => password_hash($post["pass"], PASSWORD_DEFAULT),
		"archivo" => $archivo
	];
    $usuario["id"] = traerNuevoId();

	return $usuario;
}

/**
 * [Funcion que crea un usuario en un array asociativo para poder grabarlo posteriormente. esta funcion se usa solo para editar usuarios]
 * @param  [Array] $Post [Recibe el array del post]
 * @param  [Integer] $id [Recibe el id del usuario a editar para mantener el mismo]
 * @param  [String] $archivo_cargado [Recibe el nombre del archivo de imagen para reutilizarlo si no se cargo uno nuevo]
 * @return [Array] $usuario [Devuelve un array con todos los datos a grabar]
 */
function crearUsuarioEditado($post, $session, $files, $id, $archivo_cargado){
	
	if ($_FILES['archivo'] ['name']) {
		$nombre_archivo = $_FILES['archivo'] ['name']; /* capturamos el nombre del archivo */		
		$ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION); /* capturamos la extencion del archivo */
		$archivo_cargado = $_POST["user"] . "." . $ext; /* Le colocamos de nombre al archivo el nombre de usuario y le sumamos la extencion */
	} else {
		$archivo_cargado = $archivo_cargado;
	}


	$usuario = [
		"nombre" => $post["nombre"],
		"apellido" => $post["surname"],
		"tipo_documento" => $post["document"],
		"numero" => $post["numero"],
		"genero" => $post["sex"],
		"estado_civil" => $post["social"],
		"ocupacion" => $post["occupation"],
		"cuit" => $post["cuit"],
		"email" => $post["correo"],
		"user" => $post["user"],
		"pass" => password_hash($post["pass"], PASSWORD_DEFAULT),
		"archivo" => $archivo_cargado,
		"id" => (int)$id
	];
	return $usuario;
}


/**
 * [Funcion que crea graba un usuario nuevo en un archivo JSON]
 * @param  [Array] $Usuario [Recibe el array del usuario creado]
 */
function guardarUsuario($usuario){

    // Guardo el usuario creado por la funcion "Crear usuario" en formato JSON
	$json = json_encode($usuario);

    // Agrego un enter al final de cada linea
	$json = $json . PHP_EOL;
    
    // Escribo el archivo usuarios.json
	file_put_contents("usuarios.json", $json, FILE_APPEND);
}

/**
 * [Funcion que crea graba en un archivo JSON, un usuario ya editado]
 * @param  [Array] $usuarios [Recibe el array del usuario a editar ya creado]
 */
function editarUsuario($usuarios){

	// reseteo el archivo
	file_put_contents("usuarios.json", '');

	foreach ($usuarios as $usuario) {
		// Guardo el usuario creado por la funcion "Crear usuario" en formato JSON
		$json = json_encode($usuario);

		// Agrego un enter al final de cada linea
		$json = $json . PHP_EOL;
	    
	    // Escribo el archivo usuarios.json
		file_put_contents("usuarios.json", $json, FILE_APPEND);
	}

}


/**
 * [Funcion que loguea al usuario registrado crando las variables de SESSION]
 * @param  [Array] $Post [Recibe el array del post]
 * @return [Array] $_SESSION [Devuelve un array las variables de SESSION]
 */
function logeoDeUsuario($informacion){

	$usuarioLogeado = buscarPorUsuario($informacion['user']);

	foreach ($usuarioLogeado as $clave => $valor) {
		$_SESSION[$clave] = $usuarioLogeado[$clave];
	}

	$_SESSION['recovery'] = 'off';
	
	return $_SESSION;
}

/**
 * [Funcion que actualiza la session de usuario si tiene grabada la coockie "recordar usuario"]
 * @param  [Integer] $id [Recibe el id del usuario]
 * @return [Array] $_SESSION [Devuelve un array las variables de SESSION]
 */
function actualizarSession($id){

	$usuarioConCookie = buscarPorId($id);

	foreach ($usuarioConCookie as $clave => $valor) {

		$_SESSION[$clave] = $usuarioConCookie[$clave];

	}

	$_SESSION['recovery'] = 'off';
	
	return $_SESSION;

}


?>