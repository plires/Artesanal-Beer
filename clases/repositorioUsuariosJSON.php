<?php

require_once("repositorioUsuarios.php");
require_once("usuario.php");

class RepositorioUsuariosJSON extends RepositorioUsuarios {


  /**
   * [guardarUsuario Guarda el usuario en el repositorio]
   *
   * @param Usuario $usuario [recibe el usuario]
   *
   * @return [string]  [guarda el string en JSON en el archivo usuarios.json]
   */
  public function guardarUsuario(Usuario $usuario) {
    if ($usuario->getId() == null) {
      $usuario->setId($this->traerNuevoId());

      $json = json_encode($usuario->toArray());

      $json = $json . PHP_EOL;

      file_put_contents("usuarios.json", $json, FILE_APPEND);
    } else {
      $todos = $this->traerTodos();

      file_put_contents("usuarios.json", "");

      foreach ($todos as $usuarioJSON) {
        if ($usuarioJSON->getId() != $usuario->getId()) {
          $json = json_encode($usuarioJSON->toArray());

          $json = $json . PHP_EOL;

          file_put_contents("usuarios.json", $json, FILE_APPEND);
        } else {
          $json = json_encode($usuario->toArray());

          $json = $json . PHP_EOL;

          file_put_contents("usuarios.json", $json, FILE_APPEND);
        }

      }
    }
  }

  /**
   * [traerTodos devuelve todos los usuarios del archivo en objeto]
   *
   * @return [array] [devuelve un array de objetos de usuario]
   */
  public function traerTodos() {
    // Leo el archivo
    $archivo = file_get_contents("usuarios.json");

    // Lo divido por enters
    $usuariosJSON = explode(PHP_EOL, $archivo);

    // Quito el enter del final
    array_pop($usuariosJSON);

    $usuariosFinal = [];

    // Y CADA LINEA LA CONVIERTO DE JSON A ARRAY
    foreach($usuariosJSON as $json) {
      $usuariosFinal[] = Usuario::crearDesdeArrayJSON(json_decode($json, true));
    }

    return $usuariosFinal;

  }

  /**
   * [buscarPorId devuelve el usuario con el id recibido]
   *
   * @param [int] $id [id del usuario]
   *
   * @return [usuario] [devuelve el objeto del usuario encontrado]
   */
  public function buscarPorId($id) {
    $todos = $this->traerTodos();

    foreach ($todos as $usuario) {
      if ($usuario->getId() == $id) {
        return $usuario;
      }
    }

    return false;
  }


  /**
   * [buscarPorMail devuelve el usuario con el mail recibido]
   *
   * @param [string] $mail [recibe el mail del usuario]
   *
   * @return [usuario] [devuelve el objeto del usuario encontrado]
   */
  public function buscarPorMail($mail) {
    $todos = $this->traerTodos();
    
    foreach ($todos as $usuario) {
      if ($usuario->getMail() == $mail) {
        return $usuario;
      }
    }

    return false;
  }


  /**
   * [buscarPorUsuario devuelve el usuario con el usuario recibido]
   *
   * @param [string] $user [recibe el usuario del usuario]
   *
   * @return [usuario] [devuelve el objeto del usuario encontrado]
   */
  public function buscarPorUsuario($user) {
    $todos = $this->traerTodos();
    
    foreach ($todos as $usuario) {
    if ($usuario->getUsuario() == $user) {
        $UsuarioFinal = $usuario->toArray();
        return $UsuarioFinal;
      }
    }

    return false;
  }


  /**
   * [traerNuevoId devuelve el id con el cual se va a guardar el usuario]
   *
   * @return [int] [devuelve el id a utilizar]
   */
  private function traerNuevoId() {
    $usuarios = $this->traerTodos();

    if (count($usuarios) == 0) {
      return 1;
    }

    $elUltimo = array_pop($usuarios);


    $id = $elUltimo->getId();

    return $id + 1;
  }


  /**
   * [borrarUsuario borra el usuario indicado]
   *
   * @param Usuario $usuario [recibe el objeto del usuario]
   *
   * @return [string]  [devuelve el srting en formato json a guardar en el archivo usuarios.json]
   */
  public function borrarUsuario(Usuario $usuario) {
    $todos = $this->traerTodos();
    

    file_put_contents("usuarios.json", "");

    foreach ($todos as $usuarioJSON) {
      if ($usuarioJSON->getId() != $usuario->getId()) {

        $json = json_encode($usuarioJSON->toArray());


        $json = $json . PHP_EOL;

        file_put_contents("usuarios.json", $json, FILE_APPEND);
      }

    }
  }


  /**
   * [traerTodosTiposDocumento funcion para rellenar los options del select "tipo de documento"]
   *
   * @return [array] [devuelve el array de la tabla tipo de docuemnto]
   */
  public function traerTodosTiposDocumento() {
    // Leo el archivo
    $archivo = file_get_contents("tipoDocumento.json");

    // Lo divido por enters
    $tiposDocumentoJSON = explode(PHP_EOL, $archivo);

    $tiposDocumentoFinal = [];

    // Y CADA LINEA LA CONVIERTO DE JSON A ARRAY
    foreach($tiposDocumentoJSON as $documento) {
      $tiposDocumentoFinal[] = json_decode($documento, true);
    }

    return $tiposDocumentoFinal;
  }

  /**
   * [traerTodosGenero funcion para rellenar los options del select "Genero"]
   *
   * @return [array] [devuelve el array de la tabla genero]
   */
  public function traerTodosGenero() {
    // Leo el archivo
    $archivo = file_get_contents("genero.json");

    // Lo divido por enters
    $generoJSON = explode(PHP_EOL, $archivo);

    $generoFinal = [];

    // Y CADA LINEA LA CONVIERTO DE JSON A ARRAY
    foreach($generoJSON as $genero) {
      $generoFinal[] = json_decode($genero, true);
    }

    return $generoFinal;
  }

  /**
   * [traerTodosOcupacion funcion para rellenar los options del select "ocupacion"]
   *
   * @return [array] [devuelve el array de la tabla genero]
   */
  public function traerTodosOcupacion() {
    // Leo el archivo
    $archivo = file_get_contents("ocupacion.json");

    // Lo divido por enters
    $ocupacionJSON = explode(PHP_EOL, $archivo);

    $ocupacionFinal = [];

    // Y CADA LINEA LA CONVIERTO DE JSON A ARRAY
    foreach($ocupacionJSON as $ocupacion) {
      $ocupacionFinal[] = json_decode($ocupacion, true);
    }

    return $ocupacionFinal;
  }


  /**
   * [traerTodosEstadoCivil funcion para rellenar los options del select "estado civil"]
   *
   * @return [array] [devuelve el array de la tabla estado civil]
   */
  public function traerTodosEstadoCivil() {
    // Leo el archivo
    $archivo = file_get_contents("estadoCivil.json");

    // Lo divido por enters
    $estadoCivilJSON = explode(PHP_EOL, $archivo);

    $estadoCivilFinal = [];

    // Y CADA LINEA LA CONVIERTO DE JSON A ARRAY
    foreach($estadoCivilJSON as $estadoCivil) {
      $estadoCivilFinal[] = json_decode($estadoCivil, true);
    }

    return $estadoCivilFinal;
  }
}

?>
