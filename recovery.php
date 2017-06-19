<?php
/* Include Funciones */
include_once('soporte.php');


if ($auth->estaLogueado()) {
	header('Location:account.php?id=' . $objetoUsuarioLogueado->getId());exit;
}

$error = "";
$mail = "";
$sucess = "";

if ($_POST) {
	$errores = $validador->validarInformacionRecovery($_POST, $db->getRepositorioUsuarios());

	if (count($errores) == 0) {

		// Logueo al usuario
		$usuarioALoguear = $db->getRepositorioUsuarios()->buscarPorMail($_POST['mail']);
		if ($soporte == 'json') {
		$usuarioALoguear = $usuarioALoguear->toArray();
		}
  		$auth->loguear($usuarioALoguear['id_usuario']);

  		// creo el usuario
  		$objetoUsuarioLogueado = Usuario::crearDesdeBaseDatosArray($usuarioALoguear);
        header('Location:account.php?id=' . $objetoUsuarioLogueado->getId() . '?inputs=enabled');exit;
	} else {
		$error = $errores['mail'];
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Venta de cerveza Artesanal</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="css/ionicons.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	
	<!--Variable que activa la clase en NAV-->
	<?php $activo = "login"; ?>

	<!--Include HEADER-->
	<?php include_once('includes/header.php'); ?>

	<!-- container start -->
	<div class="container">

		<!--Sub - container Start-->
		<div class="sub_container">

			<h1 class="text_center titulo_h1">Recuperación de tu password</h1>

			<hr class="margin_bottom_30">

			<!-- Notificaciones Form Start -->
			<div class="errores animated fadeInDown">

				<?=$error?>

			</div>

			<div class="sucess animated fadeInDown">
				<?=$sucess?>
			</div>		
			<!-- Notificaciones Form End -->

			<!-- section recovery start -->
			<section id="recovery" class="main-content">

			    <div class="register">

					<!-- formulario start -->
				    <form action="recovery.php" method="post">
				    
						<fieldset>
							<legend>Recuperacion de tu password</legend>

							<label for="mail">Ingresa el email con el cual te registraste</label>
							<input type="email" name="mail" >

							<div class="text_center">
								<button id="enviar" type="submit" name="enviar">Enviar</button>						
							</div>

						</fieldset>
				    </form>
					<!-- formulario end -->

			    </div>

		  	</section>
			<!-- section recovery end -->

		</div>
		<!--Sub - container end-->

	</div>
	<!-- container end -->

	<?php include_once('includes/footer.php'); ?>

	<!--Scripts Menu-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/index.js"></script>
	
</body>
</html>