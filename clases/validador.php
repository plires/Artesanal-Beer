<?php

class Validador {
  public function validarInformacion($informacion, RepositorioUsuarios $repo) {
    $errores = [];

    $nombre = trim($informacion["nombre"]);

    if (strlen($nombre) == 0) {
      $errores["nombre"] = "Ingresa tu nombre :(";
    }

    $apellido = trim($informacion["apellido"]);

    if (strlen($apellido) == 0) {
      $errores["apellido"] = "Ingresa tu apellido :(";
    }

    $numero = trim($informacion["numero"]);

    if (strlen($numero) == 0) {
      $errores["numero"] = "Ingresa tu numero de documento :(";
    }

    $cuit = trim($informacion["cuit"]);

    if (strlen($cuit) == 0) {
      $errores["cuit"] = "Ingresa tu numero de cuit :(";
    }

    $usuario = trim($informacion["usuario"]);

    if (strlen($usuario) < 6) {
      $errores["usuario"] = "El usuario debe tener más de 6 caracteres";
    } else if ($repo->buscarPorUsuario($usuario) != false) {
      $errores["usuario"] = "El usuario ya existe";
    }

    $mail = trim($informacion["mail"]);

    if (strlen($mail) == 0) {
      $errores["mail"] = "No pusiste el mail :(";
    } else if (! filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $errores["mail"] = "El mail debe ser un mail";
    } else if ($repo->buscarPorMail($mail) != false) {
      $errores["mail"] = "El mail ya existe";
    }

    if ($informacion["pass"] == "") {
      $errores["pass"] = "Llena la contraseña";
    }
    if ($informacion["cpass"] == "") {
      $errores["cpass"] = "Confirmá tu contraseña";
    }
    if ($informacion["pass"] != "" && $informacion["cpass"] != "" && $informacion["pass"] != $informacion["cpass"]) {
      $errores["pass"] = "Las dos contraseñas deben ser iguales";
    }

    return $errores;
  }

  function validarLogin($datos, RepositorioUSuarios $repo) {
    $errores = [];

    $usuario = trim($datos["usuario"]);
    
    if (strlen($usuario) == 0) {
      $errores["mail"] = "Ingresa tu usuario";
    } elseif ($repo->buscarPorUsuario($usuario) == false) {
      $errores["mail"] = "El usuario no existe";
    } 

    $pass = trim($datos["pass"]);
    $usuarioALoguear = $repo->buscarPorUsuario($usuario);


    if (strlen($pass) == 0) {
      $errores["pass"] = "Ingresa tu pass";
    } elseif (password_verify($datos["pass"], $usuarioALoguear['pass']) == false) {
      $errores["pass"] = "Error de login";
    }

    return $errores;

  }


  public function validarEdicion($informacion, RepositorioUsuarios $repo, Usuario $usuario) {
    $errores = [];
    $usuarioBaseDatos = "";

    $nombre = trim($informacion["nombre"]);

    if (strlen($nombre) == 0) {
      $errores["nombre"] = "Che, no pusiste el nombre :(";
    }

    $apellido = trim($informacion["apellido"]);

    if (strlen($apellido) == 0) {
      $errores["apellido"] = "Che, no pusiste el apellido :(";
    }

    $numero = trim($informacion["numero"]);

    if (strlen($numero) == 0) {
      $errores["numero"] = "Ingresa tu numero de documento :(";
    }

    $cuit = trim($informacion["cuit"]);

    if (strlen($cuit) == 0) {
      $errores["cuit"] = "Ingresa tu numero de cuit :(";
    }

    $usuario = trim($informacion["usuario"]);

    if (strlen($usuario) < 6) {
      $errores["usuario"] = "El usuario debe tener más de 6 caracteres";
    }

    $mail = trim($informacion["mail"]);
    $usuarioBaseDatos = $repo->buscarPorMail($mail);

    if (strlen($mail) == 0) {
      $errores["mail"] = "Che, no pusiste el mail :(";
    } else if (! filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $errores["mail"] = "El mail debe ser un mail";
    } 

    if ($informacion["pass"] == "") {
      $errores["pass"] = "Llena la contraseña";
    }
    if ($informacion["cpass"] == "") {
      $errores["cpass"] = "Confirmá tu contraseña";
    }
    if ($informacion["pass"] != "" && $informacion["cpass"] != "" && $informacion["pass"] != $informacion["cpass"]) {
      $errores["pass"] = "Las dos contraseñas deben ser iguales";
    }

    return $errores;
  }

  public function validarInformacionRecovery($informacion, RepositorioUsuarios $repo) {
    $errores = [];
    $usuarioBaseDatos = "";

    $mail = trim($informacion["mail"]);
    $usuarioBaseDatos = $repo->buscarPorMail($mail);

    if (strlen($mail) == 0) {
      $errores["mail"] = "Che, no pusiste el mail :(";
    } else if (! filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $errores["mail"] = "El mail debe ser un mail";
    } else if (!$repo->buscarPorMail($mail)) {
      $errores["mail"] = "Este mail nunca fue registrado!";
    }

    return $errores;
  }


}

?>
