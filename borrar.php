<?php

require_once("soporte.php");

$usuario = $auth->usuarioLogueado($db->getRepositorioUsuarios());

if ($soporte == 'sql') {
	$usuario = Usuario::crearDesdeArrayBase($usuario);
	$usuario->borrar($db->getRepositorioUsuarios());

}
$usuario->borrar($db->getRepositorioUsuarios());

$auth->logout();

header("location: register.php");exit;

?>
