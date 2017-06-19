<?php

abstract class RepositorioUsuarios {
  public abstract function guardarUsuario(Usuario $usuario);
  public abstract function traerTodos();
  public abstract function buscarPorId($id);
  public abstract function buscarPorMail($mail);
  public abstract function borrarUsuario(Usuario $usuario);
  public abstract function traerTodosTiposDocumento();
  public abstract function traerTodosGenero();
  public abstract function traerTodosOcupacion();
  public abstract function traerTodosEstadoCivil();
}

?>
