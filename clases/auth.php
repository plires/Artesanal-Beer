<?php

class Auth
{

  public static $auth;
  

  private function __construct() {
    session_start();

    if (isset($_COOKIE["idUser"])) {
      $this->loguear($_COOKIE["idUser"]);
    }
  }

  /**
   * [crearAuth Crea la funcion de autenticacion]
   *
   * @return [Instancia] [Crea la instancia del objeto]
   */   
  public static function crearAuth() {
    if (self::$auth == null) {
      self::$auth = new Auth();
    }
    return self::$auth;
  }

  /**
   * [loguear Loguea al usuario]
   *
   * @param [int] $id [recibe id del usuario]
   *
   * @return [int] [Crea la variable de session y le asigna el id]
   */
  public function loguear($id) {
    $_SESSION["idUser"] = $id;
  }

  /**
   * [estaLogueado Coonsulta si el usuario esta logeado]
   *
   * @return [int] [Crea la variable de session y le asigna el id]
   */
  public function estaLogueado() {
    return isset($_SESSION["idUser"]);
  }


  /**
   * [usuarioLogueado Consulta si el usuario esta logueado ]
   *
   * @param RepositorioUsuarios $repo [Trae el repositorio]
   *
   * @return [usuario]              [Devuelve el objeto del usuario buscado]
   */
  public function usuarioLogueado(RepositorioUsuarios $repo) {
    return $repo->buscarPorId($_SESSION["idUser"]);
  }


  /**
   * [logout Realiza el logout del usuario]
   *
   * @return [int] [setea la variable de sesion en -1]
   */
  public function logout() {
    session_destroy();
    setcookie("idUser", "", -1);
  }

}

?>
