<?php
/* Include Funciones */
include_once('soporte.php');


if (!$auth->estaLogueado()) {
	header("location:login.php");exit;
} else {
	$inputs = "disabled";
	$inputs = "disabled";
}

if (isset($_GET['inputs'])) {
	echo "entro";
	$inputs = "enabled";
}

$errores = [];
$sucess = "";

/* Si se presiono "Editar" */
if (isset($_POST["editar"])) {

	// habilito todos los inputs
	$inputs = "enabled";

}

/* Si se presiono "guardar" */
if (isset($_POST["guardar"])) {

	$errores = $validador->validarEdicion($_POST, $db->getRepositorioUsuarios(), $objetoUsuarioLogueado);

	// No hay errores
	$usuario = $_POST;

	$usuario["pass"] = Usuario::hashPassword($usuario["pass"]);
	$usuario = Usuario::crearDesdeArray($usuario);
	
	if (count($errores) == 0) { // No hubo errores
		$sucess = 'Datos guardados satisfactoriamente';
		$mensajeError ="";
		

		// Guardo en BDD
		$usuario->guardar($db->getRepositorioUsuarios());

		// Si hay imagen nueva la subimos
		if ($_FILES['archivo']['name'] != '') {
			$usuario->guardarImagenNueva("archivo");
		}

		if ($soporte == 'sql') {
			$arrayUsuarioLogueado = $db->getRepositorioUsuarios()->buscarPorId($_SESSION["idUser"]);
	    	$objetoUsuarioLogueado = Usuario::crearDesdeBaseDatosArray($arrayUsuarioLogueado);
		} else {
			$usuario->guardar($db->getRepositorioUsuarios());

			// Logueo al usuario
			$usuarioALoguear = $db->getRepositorioUsuarios()->buscarPorMail($usuario->getMail());
			$auth->loguear($usuarioALoguear->getId());
			$objetoUsuarioLogueado = $auth->usuarioLogueado($db->getRepositorioUsuarios());	
		}
		

		//Redirijo a la seccion de cuenta de usuario con la variable que indica el registro
		$inputs = "disabled";
	} else { // Hubo errores.
		$mensajeError = 'Sabemos que pedimos son muchos datos...pero lo hacemos por tu bien :)';
		$inputs = "disabled";

		if (!isset($errores['nombre'])) {
			$nombre = $_POST['nombre'];
		}

		if (!isset($errores['apellido'])) {
			$apellido = $_POST['apellido'];
		}

		if (!isset($errores['numero'])) {
			$numero = $_POST['numero'];
		}

		if (!isset($errores['cuit'])) {
			$cuit = $_POST['cuit'];
		}

		if (!isset($errores['mail'])) {
			$mail = $_POST['mail'];
		}

		if (!isset($errores['usuario'])) {
			$usuario = $_POST['usuario'];
		}

		if (!isset($errores['archivo'])) {
			$archivo_cargado = $_FILES['archivo']['name'];
		}

		$inputs = "enabled";

	}

}



/* Creo los array para formar los select */

$arrayTipoDocumento = $db->getRepositorioUsuarios()->traerTodosTiposDocumento();
$arrayGenero = $db->getRepositorioUsuarios()->traerTodosGenero();
$arrayEstadoCivil = $db->getRepositorioUsuarios()->traerTodosEstadoCivil();
$arrayOcupacion = $db->getRepositorioUsuarios()->traerTodosOcupacion();


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Account User- Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link id="cssArchivo" href="css/styles.css" rel="stylesheet">
</head>
<body>
	
	<!--Variable que activa la clase en NAV-->
	<?php $activo = "account"; ?>

	<!--Include HEADER-->
	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>


	<!-- section resister start -->
	<section id="account">

		<!-- container start -->
		<div class="container">

			<!--Sub - container Start-->
			<div class="sub_container">

				<h1 class="text_center titulo_h1">Cuenta de Usuario de <?=$objetoUsuarioLogueado->getNombre() .' '. $objetoUsuarioLogueado->getApellido()?></h1>
				<hr class="margin_bottom_30">


				<!-- Notificaciones Form Start -->
				<div class="errores animated fadeInDown">

					<?php

					if (count($errores) > 0) {
						foreach ($errores as $error) { ?>
							<ul>
								<li><?php echo $error; ?></li>
							</ul>		
						 <?php }
					}
					?>

				</div>

				<div class="sucess animated fadeInDown">
					<?=$sucess?>
				</div>		
				<!-- Notificaciones Form End -->		

				<form action="" method="post" enctype="multipart/form-data">

					<input name="id" class="no_visible" type="text" value="<?=$objetoUsuarioLogueado->getId()?>">

					<div class="form_mitad_izq cont_imagen">
						<img class="account_img_user" src="<?=$objetoUsuarioLogueado->getFoto()?>" alt="<?=$objetoUsuarioLogueado->getNombre()?>">
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> class="archivo" type="file" name="archivo" id="archivo">
					</div>

					<div class="form_mitad_der">
						<label for="nombre">Nombre</label>
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> type="text" name="nombre" 
						value="<?=$objetoUsuarioLogueado->getNombre()?>">

						<label for="apellido">Apellido</label>
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> type="text" name="apellido" value="<?=$objetoUsuarioLogueado->getApellido()?>">

						<label for="document">Tipo de Documento</label>
						<select <?php if ($inputs == "disabled") echo "disabled"; ?> name="document">

							<!-- Array dinamico para el select de Estado civil START -->
							<?php

							foreach ($arrayTipoDocumento as $valor) { ?>

								<?php if ($valor['id'] == $objetoUsuarioLogueado->getTipoDocumento()){ ?>
									<option value="<?=$valor['id']?>" selected><?=$valor['nombre']?></option>			
								<?php } else { ?>
									<option value="<?=$valor['id']?>"><?=$valor['nombre']?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de Estado civil END -->
							
						</select>

						<label for="numero">Numero</label><br>
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> type="number" name="numero" value="<?=$objetoUsuarioLogueado->getNumero()?>">

						<label for="sex">Genero</label>
						<select <?php if ($inputs == "disabled") echo "disabled"; ?> name="sex" <?php if ($inputs == "disabled") echo "disabled"; ?>>

							<!-- Array dinamico para el select de Estado civil START -->
							<?php

							foreach ($arrayGenero as $valor) { ?>

								<?php if ($valor['id'] == $objetoUsuarioLogueado->getGenero()){ ?>
									<option value="<?=$valor['id']?>" selected><?=$valor['nombre']?></option>			
								<?php } else { ?>
									<option value="<?=$valor['id']?>"><?=$valor['nombre']?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de Estado civil END -->

						</select>

					</div>

					<div class="form_total">

						<label for="social">Estado Civil</label>
						<select <?php if ($inputs == "disabled") echo "disabled"; ?> name="social">

							<!-- Array dinamico para el select de Estado civil START -->
							<?php

							foreach ($arrayEstadoCivil as $valor) { ?>

								<?php if ($valor['id'] == $objetoUsuarioLogueado->getEstadoCivil()){ ?>
									<option value="<?=$valor['id']?>" selected><?=$valor['nombre']?></option>			
								<?php } else { ?>
									<option value="<?=$valor['id']?>"><?=$valor['nombre']?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de Estado civil END -->

						</select>						

						<label for="occupation">Ocupación</label>
						<select <?php if ($inputs == "disabled") echo "disabled"; ?> name="occupation" <?php if ($inputs == "disabled") echo "disabled"; ?>>
							
							<!-- Array dinamico para el select de ocupacion START -->
							<?php

							foreach ($arrayOcupacion as $valor) { ?>

								<?php if ($valor['id'] == $objetoUsuarioLogueado->getOcupacion()){ ?>
									<option value="<?=$valor['id']?>" selected><?=$valor['nombre']?></option>			
								<?php } else { ?>
									<option value="<?=$valor['id']?>"><?=$valor['nombre']?></option>
								<?php } ?>

							<?php
							}

							?>
							<!-- Array dinamico para el select de ocupacion END -->

						</select>

						<label for="cuit">CUIT</label>
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> type="number" name="cuit" value="<?=$objetoUsuarioLogueado->getCuit()?>">
						<label for="mail">E-mail</label>
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> type="email" name="mail" value="<?=$objetoUsuarioLogueado->getMail()?>">

						<label for="usuario">Usuario</label>
						<input <?php if ($inputs == "disabled") echo "disabled"; ?> type="text" name="usuario" value="<?=$objetoUsuarioLogueado->getUsuario()?>">

						<label <?php if ($inputs == "disabled") echo "class=\"no_visible\""; ?> for="pass">Ingrese su contraseña</label>
						<input <?php if ($inputs == "disabled") echo "class=\"no_visible\""; ?> type="password" name="pass">

						<label <?php if ($inputs == "disabled") echo "class=\"no_visible\""; ?> for="cpass">Reingrese su contraseña</label>
						<input <?php if ($inputs == "disabled") echo "class=\"no_visible\""; ?> type="password" name="cpass">

						<div class="contenedor_auto">
							<input id="editar" type="submit" name="editar" value="Editar">
							<input <?php if ($inputs == "disabled") echo "disabled"; ?> id="guardar" type="submit" name="guardar" value="Guardar cambios">
							<input id="borrar" onclick="confirmacion('<?=$objetoUsuarioLogueado->getUsuario()?>')" type="submit" name="borrar" value="Borrar Usuario">
						</div>

					</div>

				</form>		  	

			</div>
			<!--Sub - container end-->

		</div>
		<!-- container end -->

	</section>
	<!-- section resister end -->

	<?php include_once('includes/footer.php'); ?>

	<!--Scripts Menu-->
	<script src="js/confirmaciones.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/contador.js"></script>

	<script>
		window.onload = contador;
	</script>
	
</body>
</html>