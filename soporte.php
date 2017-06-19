<?php
  require_once("clases/auth.php");
  require_once("clases/repositorioSQL.php");
  require_once("clases/repositorioJSON.php");
  require_once("clases/validador.php");

  $auth = Auth::crearAuth();
  $validador = new Validador();

  /* Include Sistema */
  include_once('sistema.php');

  switch ($soporte) {
    case 'sql':
      $db = new RepositorioSQL();
      $db->getRepositorioUsuarios()->crearBaseDeDatos();
      break;

    case 'json':
      $db = new RepositorioJSON();
      break;
  }

  // Pregunto si esta logueado. Si esta logueado busco al usuario por ID y el array devuelto lo convierto a
  // una instancia de la clase usuario. El resultado es asignado a "$objetoUsuarioLogueado"
  if ($auth->estaLogueado()) {

    if ($soporte == 'sql') {
      $arrayUsuarioLogueado = $db->getRepositorioUsuarios()->buscarPorId($_SESSION["idUser"]);
      $objetoUsuarioLogueado = Usuario::crearDesdeBaseDatosArray($arrayUsuarioLogueado);
    } else {
      $arrayUsuarioLogueado = $db->getRepositorioUsuarios()->buscarPorId($_SESSION["idUser"]);
      $objetoUsuarioLogueado = $arrayUsuarioLogueado;      
    }

  }

?>
