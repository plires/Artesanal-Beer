<?php
/* Include Funciones */
include_once('includes/funciones.php');

if ($_SESSION) {
	header('Location: account.php');
}

// Pregunto si el usuario hizoclick en "recordame" para reactivar session
if (isset($_COOKIE["id"])) {
	actualizarSession($_COOKIE["id"]);
	header('Location: account.php');
}

$user = "";
$pass = "";
$errores = [];

$mensajeError ="";
$sucess ="";

if ($_POST) {
	$errores = verificaLogeo($_POST);

	if (count($errores) == 0) {
		$usuario = logeoDeUsuario($_POST);

		// Grabo la coockie con el id del usuario
		if (isset($_POST["recordame"])) {
			setcookie("id", $usuario["id"], time() + 60 * 60 * 24 * 30);
		}

		// Redirijo al listado del usuario en modo lectura
		$_SESSION['modo'] = 'lectura';
        header("Location:account.php");
	}

	if (!isset($errores['user'])) {
		$user = $_POST['user'];
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

			<h1 class="text_center titulo_h1">Login de usuario</h1>

			<!-- Notificaciones Form Start -->
			<div class="errores animated fadeInDown">

				<h5><?=$mensajeError?></h5>

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
				<h5><?=$sucess?></h5>
			</div>		
			<!-- Notificaciones Form End -->

			<!-- section resister start -->
			<section id="login" class="main-content">

			    <div class="register">

					<!-- formulario start -->
				    <form action="" method="post">
				    
						<fieldset>
							<legend>Login de Usuario</legend>

							<label for="user">Usuario</label>
							<input type="text" name="user" value="<?=$user?>">

							<label for="pass">Contraseña</label>
							<input type="password" name="pass" value="">

							<a href="register.php">Aún no sos usuario?</a><br>
							<a href="recovery.php">Olvidaste tu contraseña?</a><br>
							&nbsp;<br>

							<input type="checkbox" name="recordame" value="RP">Recordar Usuario<br> 

							<div class="contenedores_button">
								<button id="enviar" type="submit" name="enviar">Enviar</button>
								<button id="reset" type="reset" name="reset">Borrar</button>							
							</div>

						</fieldset>
				    </form>
					<!-- formulario end -->

			    </div>
		  	</section>
			<!-- section resister end -->

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