<?php

require_once("repositorioUsuarios.php");
require_once("usuario.php");

class RepositorioUsuariosSQL extends RepositorioUsuarios {
  protected $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }


  /**
   * [crearBaseDeDatos Funcion que crea la base de datos en sql en caso que no exista]
   *
   * @return [string] [sentencia sql]
   */
  public function crearBaseDeDatos() {
    
    $sql = "CREATE DATABASE  IF NOT EXISTS artesanal_beer;
USE artesanal_beer;

DROP TABLE IF EXISTS estado_civil;


CREATE TABLE estado_civil (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES estado_civil WRITE;
INSERT INTO estado_civil VALUES (0,'Otro'),(1,'Soltera/o'),(2,'Casada/o'),(3,'Divorciada/o');
UNLOCK TABLES;

DROP TABLE IF EXISTS genero;

CREATE TABLE genero (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) NOT NULL,
  PRIMARY KEY (id)
  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

  LOCK TABLES genero WRITE;
  INSERT INTO genero VALUES (1,'Femenino'),(2,'Masculino');
  UNLOCK TABLES;

  DROP TABLE IF EXISTS ocupacion;

  CREATE TABLE ocupacion (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

  LOCK TABLES ocupacion WRITE;
  INSERT INTO ocupacion VALUES (1,'Monotributista'),(2,'Empleado'),(3,'Autónomo'),(4,'Desocupado'),(5,'Ama de Casa');
  UNLOCK TABLES;

  DROP TABLE IF EXISTS tipo_documento;
  CREATE TABLE tipo_documento (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(25) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

  LOCK TABLES tipo_documento WRITE;
  INSERT INTO tipo_documento VALUES (1,'DNI'),(2,'Libreta de Enrrolamiento'),(3,'Pasaporte'),(4,'Libreta Cívica');
  UNLOCK TABLES;

  DROP TABLE IF EXISTS usuario;
  CREATE TABLE usuario (
    id_usuario int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(100) DEFAULT NULL,
    apellido varchar(100) DEFAULT NULL,
    numero int(11) DEFAULT NULL,
    cuit int(11) DEFAULT NULL,
    mail varchar(100) DEFAULT NULL,
    usuario varchar(50) DEFAULT NULL,
    pass varchar(100) DEFAULT NULL,
    fk_genero_id int(11) DEFAULT NULL,
    fk_estado_civil_id int(11) DEFAULT NULL,
    fk_tipo_documento_id int(11) DEFAULT NULL,
    fk_ocupacion_id int(11) DEFAULT NULL,
    PRIMARY KEY (id_usuario),
    KEY fk_genero_id_idx (fk_genero_id),
    KEY fk_estado_civil_id_idx (fk_estado_civil_id),
    KEY fk_tipo_documento_id_idx (fk_tipo_documento_id),
    KEY fk_ocupacion_id_idx (fk_ocupacion_id),
    CONSTRAINT fk_estado_civil_id FOREIGN KEY (fk_estado_civil_id) REFERENCES estado_civil (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_genero_id FOREIGN KEY (fk_genero_id) REFERENCES genero (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_ocupacion_id FOREIGN KEY (fk_ocupacion_id) REFERENCES ocupacion (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_tipo_documento_id FOREIGN KEY (fk_tipo_documento_id) REFERENCES tipo_documento (id) ON DELETE NO ACTION ON UPDATE NO ACTION
  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

  LOCK TABLES usuario WRITE;

  UNLOCK TABLES;";


  $stmt = $this->conexion->prepare($sql);

  $stmt->execute();
 }


  /**
   * [guardarUsuario guarda el usuario en la bdd]
   *
   * @param Usuario $usuario [objeto del usuario]
   *
   * @return [sql]  [sentencia en sql]
   */
  public function guardarUsuario(Usuario $usuario) {
    
   if ($usuario->getId() == NULL) {
    
      $sql = "INSERT INTO usuario values (default, :nombre, :apellido, :numero, :cuit, :mail, :usuario, :pass, :sex, :social, :document, :occupation)";

      $stmt = $this->conexion->prepare($sql);
   }
   else {

    $sql = "
    UPDATE usuario SET 
    nombre = :nombre, apellido = :apellido, numero = :numero, cuit = :cuit, 
    mail = :mail, usuario = :usuario, pass = :pass, fk_genero_id = :sex, 
    fk_estado_civil_id = :social, fk_tipo_documento_id = :document, fk_ocupacion_id = :occupation 
    WHERE id_usuario = :id";
      $stmt = $this->conexion->prepare($sql);
      $stmt->bindValue(":id", $usuario->getId(), PDO::PARAM_INT);
   }

   $stmt->bindValue(":nombre", $usuario->getNombre(), PDO::PARAM_STR);
   $stmt->bindValue(":apellido", $usuario->getApellido(), PDO::PARAM_STR);
   $stmt->bindValue(":numero", $usuario->getNumero(), PDO::PARAM_INT);
   $stmt->bindValue(":cuit", $usuario->getCuit(), PDO::PARAM_INT);
   $stmt->bindValue(":mail", $usuario->getMail(), PDO::PARAM_STR);
   $stmt->bindValue(":usuario", $usuario->getUsuario(), PDO::PARAM_STR);
   $stmt->bindValue(":pass", $usuario->getPassword(), PDO::PARAM_STR);
   $stmt->bindValue(":sex", $usuario->getGenero(), PDO::PARAM_INT);
   $stmt->bindValue(":social", $usuario->getEstadoCivil(), PDO::PARAM_INT);
   $stmt->bindValue(":document", $usuario->getTipoDocumento(), PDO::PARAM_INT);
   $stmt->bindValue(":occupation", $usuario->getOcupacion(), PDO::PARAM_INT);

   $stmt->execute();
 }


 /**
  * [traerTodos trae todos los usuarios de la tabla usuarios]
  *
  * @return [array] [devuelve un array de objetos de usuario]
  */
 public function traerTodos() {
    $sql = "Select * from usuario";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    return Usuario::crearDesdeArrays($stmt->fetchAll(PDO::FETCH_ASSOC));
  }


  /**
   * [buscarPorMail busca a un usuario por su email]
   *
   * @param [string] $mail [nombre del mail]
   *
   * @return [bool] [true o false]
   */
  public function buscarPorMail($mail) {
    $sql = "SELECT * FROM usuario WHERE mail = :mail";

    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result != false) {
        return $result;
    }
    else {
      return NULL;
    }

  }


  /**
   * [buscarPorUsuario busca a un usuario por su usuario]
   *
   * @param [string] $usuario [nombre del usuario]
   *
   * @return [bool] [devuelve true o false]
   */
  public function buscarPorUsuario($usuario) {
    $sql = "SELECT * FROM usuario WHERE usuario = :usuario";

    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(":usuario", $usuario, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result != false) {
        return $result;
    }
    else {
      return NULL;
    }

  }


  /**
   * [buscarPorId busca un usuario por su id]
   *
   * @param [int] $id [numero de id]
   *
   * @return [bool] [true o false]
   */
  public function buscarPorId($id) {
    $sql = "SELECT * FROM usuario WHERE id_usuario = :id";

    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result != false) {
        return $result;
    }
    else {
      return NULL;
    }
  }


  /**
   * [borrarUsuario borra a un usuario de la tabla usuario]
   *
   * @param Usuario $usuario [nombre del usuario]
   *
   * @return [sql]  [sentencia de sql]
   */
  public function borrarUsuario(Usuario $usuario) {
    
    $sql = "DELETE FROM usuario where id_usuario = :id";
    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(":id", $usuario->getId(), PDO::PARAM_INT);

    $stmt->execute();
  }


  /**
   * [traerTodosTiposDocumento funcion que rellena los options de el select tipo de dto]
   *
   * @return [array] [array con los datos de la tabla]
   */
  public function traerTodosTiposDocumento() {
    $sql = "SELECT * FROM tipo_documento ORDER BY nombre";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   * [traerTodosGenero funcion que rellena los options de el select genero]
   *
   * @return [array] [array con los datos de la tabla]
   */
  public function traerTodosGenero() {
    $sql = "SELECT * FROM genero ORDER BY nombre";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    return $final = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   * [traerTodosOcupacion funcion que rellena los options de el select tipo de ocupacion]
   *
   * @return [array] [array con los datos de la tabla]
   */
  public function traerTodosOcupacion() {
    $sql = "SELECT * FROM ocupacion ORDER BY nombre";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    return $final = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   * [traerTodosEstadoCivil funcion que rellena los options de el select tipo de e.civil]
   *
   * @return [array] [array con los datos de la tabla]
   */
  public function traerTodosEstadoCivil() {
    $sql = "SELECT * FROM estado_civil ORDER BY nombre";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    return $final = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   * [borrarTablaUsuarios borra la tabla de usuarios de la bdd]
   *
   * @return [sql] [sentencia sql]
   */
  public function borrarTablaUsuarios() {

    $sql = "USE artesanal_beer";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    $sql = "TRUNCATE usuario";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

  }


  /**
   * [cargarTablaUsuarios carga la tabla usuarios sql con los datos del archivo usuarios.json]
   *
   * @param [array] $usuarios [array con los objetos de usuario]
   *
   * @return [sql] [sentencia sql]
   */
  public function cargarTablaUsuarios($usuarios) {

    foreach ($usuarios as $usuario) {
      $sql = "INSERT INTO usuario values (default, :nombre, :apellido, :numero, :cuit, :mail, :usuario, :pass, :sex, :social, :document, :occupation)";

      $stmt = $this->conexion->prepare($sql);

      $stmt->bindValue(":nombre", $usuario->getNombre(), PDO::PARAM_STR);
      $stmt->bindValue(":apellido", $usuario->getApellido(), PDO::PARAM_STR);
      $stmt->bindValue(":numero", $usuario->getNumero(), PDO::PARAM_INT);
      $stmt->bindValue(":cuit", $usuario->getCuit(), PDO::PARAM_INT);
      $stmt->bindValue(":mail", $usuario->getMail(), PDO::PARAM_STR);
      $stmt->bindValue(":usuario", $usuario->getUsuario(), PDO::PARAM_STR);
      $stmt->bindValue(":pass", $usuario->getPassword(), PDO::PARAM_STR);
      $stmt->bindValue(":sex", $usuario->getGenero(), PDO::PARAM_INT);
      $stmt->bindValue(":social", $usuario->getEstadoCivil(), PDO::PARAM_INT);
      $stmt->bindValue(":document", $usuario->getTipoDocumento(), PDO::PARAM_INT);
      $stmt->bindValue(":occupation", $usuario->getOcupacion(), PDO::PARAM_INT);

      $stmt->execute();
     
    }

  }


  /**
   * [cambiarSistemaASql cambia el soporte del sistema a sql]
   *
   * @return [string] [texto a guardar]
   */
  public function cambiarSistemaASql() {

    $fp = fopen('sistema.php', 'w');
    fwrite($fp, '<?php $soporte = "sql"; ?>');
    fclose($fp);

  }


  /**
   * [cambiarSistemaAJson cambia el soporte del sistema a json]
   *
   * @return [string] [texto a guardar]
   */
  public function cambiarSistemaAJson() {

    $fp = fopen('sistema.php', 'w');
    fwrite($fp, '<?php $soporte = "json"; ?>');
    fclose($fp);

  }


}

?>
