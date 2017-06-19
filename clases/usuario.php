<?php

class Usuario 
{
  private $nombre;
  private $apellido;
  private $tipoDto;
  private $numero;
  private $genero;
  private $estadoCivil;
  private $ocupacion;
  private $cuit;
  private $mail;
  private $usuario;
  private $pass;
  private $id;


  public function __construct($nombre, $apellido, $tipoDto, $numero, $genero, $estadoCivil, $ocupacion, $cuit, $mail, $usuario, $pass, $id) {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->tipoDto = $tipoDto;
    $this->numero = $numero;
    $this->genero = $genero;
    $this->estadoCivil = $estadoCivil;
    $this->ocupacion = $ocupacion;
    $this->cuit = $cuit;
    $this->mail = $mail;
    $this->usuario = $usuario;
    $this->pass = $pass;
    $this->id = $id;
  }


  /**
   * [setNombre Seters y getters]
   */
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setApellido($apellido) {
    $this->apellido = $apellido;
  }

  public function getApellido() {
    return $this->apellido;
  }

  public function setTipoDocumento($tipo) {
    $this->tipoDto = $tipoDto;
  }

  public function getTipoDocumento() {
    return $this->tipoDto;
  }

  public function setNumero($numero) {
    $this->numero = $numero;
  }

  public function getNumero() {
    return $this->numero;
  }

  public function setGenero($genero) {
    $this->genero = $genero;
  }

  public function getGenero() {
    return $this->genero;
  }

  public function setEstadoCivil($estadoCivil) {
    $this->estadoCivil = $estadoCivil;
  }

  public function getEstadoCivil() {
    return $this->estadoCivil;
  }

  public function setOcupacion($ocupacion) {
    $this->ocupacion = $ocupacion;
  }

  public function getOcupacion() {
    return $this->ocupacion;
  }

  public function setCuit($cuit) {
    $this->cuit = $cuit;
  }

  public function getCuit() {
    return $this->cuit;
  }

  public function setMail($mail) {
    $this->mail = $mail;
  }

  public function getMail() {
    return $this->mail;
  }

  public function setUsuario($usuario) {
    $this->usuario = $usuario;
  }

  public function getUsuario() {
    return $this->usuario;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getPassword() {
    return $this->pass;
  }

  public function getFoto() {
    $file = glob('upload/'. self::getUsuario() .'.*');

    $file = $file[0];

    return $file;
  }

  /**
   * [hashPassword Funcion de hasheo de pass]
   * @param  [string] $password [recibe el pass]
   * @return [string]           [devuelve el pass hasheado]
   */
  public static function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }


  /**
   * [crearDesdeArray Funcion que crea un objeto de usuario desde un array]
   * @param  Array  $datos [Recibe un array del usuario]
   * @return [usuario]        [devuelve un objeto]
   */
  public static function crearDesdeArray(Array $datos) {

    if (!isset($datos["id"])) {
      $datos["id"] = NULL;
    }

    if (!isset($datos["usuario"])) {
      $datos["usuario"] = $datos["usuario"];      
    }
    return new Usuario(
      $datos["nombre"],
      $datos["apellido"],
      $datos["document"],
      $datos["numero"],
      $datos["sex"],
      $datos["social"],
      $datos["occupation"],
      $datos["cuit"],
      $datos["mail"],
      $datos["usuario"],
      $datos["pass"],
      $datos["id"]
    );
  }


  /**
   * [crearDesdeArrayJSON crea un ojeto desde un array con los indices del archivo json]
   * @param  Array  $datos [array de usuario]
   * @return [usuario]        [devuelve un objeto de usuario]
   */
  public static function crearDesdeArrayJSON(Array $datos) {

    return new Usuario(
      $datos["nombre"],
      $datos["apellido"],
      $datos["tipoDto"],
      $datos["number"],
      $datos["genero"],
      $datos["estadoCivil"],
      $datos["ocupacion"],
      $datos["cuit"],
      $datos["mail"],
      $datos["usuario"],
      $datos["pass"],
      $datos["id_usuario"]
    );
  }


  /**
   * [crearDesdeArrayBase crea un ojeto desde un array. Se utiliza unicamente para el borrado de un usuario]
   * @param  Array  $datos [array de usuario]
   * @return [usuario]        [devuelve un objeto de usuario]
   */
  public static function crearDesdeArrayBase(Array $datos) {

    return new Usuario(
      $datos["nombre"],
      $datos["apellido"],
      $datos["fk_tipo_documento_id"],
      $datos["numero"],
      $datos["fk_genero_id"],
      $datos["fk_estado_civil_id"],
      $datos["fk_ocupacion_id"],
      $datos["cuit"],
      $datos["mail"],
      $datos["usuario"],
      $datos["pass"],
      $datos["id_usuario"]
    );
  }


  /**
   * [crearDesdeBaseDatosArray crea un ojeto desde un array. Se utiliza unicamente para el borrado de un usuario]
   * @param  Array  $datos [recibe array de datos del usuario]
   * @return [usuario]        [devuelve un objeto de usuario]
   */
  public static function crearDesdeBaseDatosArray(Array $datos) {
    
    if (!isset($datos["id"])) {
      $datos["id"] = NULL;
    }

    if (!isset($datos["usuario"])) {
      $datos["usuario"] = $datos["usuario"];      
    }
    return new Usuario(
      $datos["nombre"],
      $datos["apellido"],
      $datos["fk_tipo_documento_id"],
      $datos["numero"],
      $datos["fk_genero_id"],
      $datos["fk_estado_civil_id"],
      $datos["fk_ocupacion_id"],
      $datos["cuit"],
      $datos["mail"],
      $datos["usuario"],
      $datos["pass"],
      $datos["id_usuario"]
    );
  }


  /**
   * [crearDesdeArrays devuelve array de los usuarios]
   * @param  Array  $usuarios [arrays de usuarios]
   * @return [array]           [devuelve un array de cada usuario]
   */
  public static function crearDesdeArrays(Array $usuarios) {
    $usuariosFinal = [];

    foreach ($usuarios as $usuario) {
      $usuariosFinal[] = self::crearDesdeArray($usuario);
    }

    return $usuariosFinal;
  }


  



  /**
   * [guardarImagen Guarda la imagen del usuario]
   * @param  [string] $imagen [imagen guardada]
   * @param  [aray] $errores [array con los errores hasta el momento]
   * @return [array]          [array con todos los errores]
   */
  public function guardarImagen($archivo, $errores) {
    if ($_FILES[$archivo]["error"] == UPLOAD_ERR_OK) {

      $nombre=$_FILES[$archivo]["name"];
      $archivo=$_FILES[$archivo]["tmp_name"];

      $ext = pathinfo($nombre, PATHINFO_EXTENSION);
      if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
        $miArchivo = dirname(__FILE__);
        $miArchivo = $miArchivo . "/../upload/";
        $miArchivo = $miArchivo . $this->usuario . "." . $ext;
        move_uploaded_file($archivo, $miArchivo);
      }
      else {
        $errores["archivo"] = "subi un formato de foto";
      }
    } else {
      //Acá hay error
      $errores["archivo"] = "No se pudo subir la foto :(";
    }
    return $errores;
  }


  /**
   * [guardarImagenNueva funcion que guarda la imagen editada del usuario]
   * @param  [string] $archivo [imagen]
   * @return [array]          [errores]
   */
  public function guardarImagenNueva($archivo) {
    $errores = [];
    if ($_FILES[$archivo]["error"] == UPLOAD_ERR_OK) {

      $nombre=$_FILES[$archivo]["name"];
      $archivo=$_FILES[$archivo]["tmp_name"];

      $ext = pathinfo($nombre, PATHINFO_EXTENSION);
      if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
        $miArchivo = dirname(__FILE__);
        $miArchivo = $miArchivo . "/../upload/";
        $miArchivo = $miArchivo . $this->usuario . "." . $ext;
        move_uploaded_file($archivo, $miArchivo);
      }
      else {
        $errores["archivo"] = "subi un formato de foto";
      }
    } else {
      exit;
    }
    return $errores;
  }


  /**
   * [guardar Guarda un usuario en el repositorio que corresponde]
   * @param  RepositorioUsuarios $repo [trae el repositorio en uso]
   */
  public function guardar(RepositorioUsuarios $repo) {
    $repo->guardarUsuario($this);
  }


  /**
   * [guardar borra un usuario del repositorio que corresponde]
   * @param  RepositorioUsuarios $repo [trae el repositorio en uso]
   */
  public function borrar(RepositorioUsuarios $repo) {
    $repo->borrarUsuario($this);
  }


  /**
   * [toArray convierte el objeto de usuario en array]
   * @return [array] [array de usuario]
   */
  public function toArray() {
    return [
      "nombre" => $this->getNombre(),
      "apellido" => $this->getApellido(),
      "tipoDto" => $this->getTipoDocumento(),
      "number" => $this->getNumero(),
      "genero" => $this->getGenero(),
      "estadoCivil" => $this->getEstadoCivil(),
      "ocupacion" => $this->getOcupacion(),
      "cuit" => $this->getCuit(),
      "mail" => $this->getMail(),
      "usuario" => $this->getUsuario(),
      "pass" => $this->getPassword(),
      "id_usuario" => $this->getId()
    ];
  } 

 
}

?>
